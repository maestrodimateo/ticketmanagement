<?php
namespace App\Models;

use App\Models\traits\Relationship;
use Database\DbConnection;
use PDO;

abstract class Model
{
    use Relationship;
    
    protected $table;

    private static $pdo;
    
    private static $queryString;

    private static $values = [];

    public function __construct()
    {
        self::$pdo = DbConnection::getPdo();
    }

    /**
     * Get all the models
     *
     * @return array
     */
    public function all(): array
    {
        return $this->select()->get();
    }

    /**
     * All the rows without the deleted ones
     *
     * @return self
     */
    public function noTrashed(): self
    {
        return $this->select()->where('deleted_at', NULL, 'IS');
    }

    /**
     * Only the deleted rows
     *
     * @return self
     */
    public function onlyTrashed(): self
    {
        return $this->select()->where('deleted_at', NULL, 'IS NOT');
    }

    /**
     * Update a model
     *
     * @param array $data
     * @param integer $id
     * @return bool
     */
    public function update(array $data, int $id = null)
    {
        $current_id = $id ?? $this->id;

        $attributes_and_values = array_map(function ($index) { return "$index = ?"; },
        array_keys($data));

        $to_update = implode(',', $attributes_and_values);

        $query = "UPDATE {$this->table} SET $to_update WHERE id = ?";

        $statement = self::$pdo->prepare($query);

        return $statement->execute([...array_values($data) , $current_id]);
    }

    /**
     * construct a select query
     *
     * @param array $fields_list
     * @return self
     */
    public function select(array $fields_list = []): self
    {
        $fields = empty($fields_list) ? '*' : implode(', ', $fields_list);

        self::$queryString = "SELECT $fields FROM {$this->table}";

        return $this;
    }

    /**
     * Limit the number of rows
     *
     * @param integer $limit
     * @return self
     */
    public function limit(int $limit, int $start = NULL):self
    {
        self::$queryString .= " LIMIT $limit" . (is_null($start) ? '': " OFFSET $start");
        return $this;
    }

    /**
     * Construct a condition
     *
     * @param string $field
     * @param string $value
     * @param int|string $operator
     * @return self
     */
    public function where(string $field, $value, string $operator = "="): self
    {
        self::$values[] = $value;
        self::$queryString .= " WHERE $field $operator ?";

        return $this;
    }

    /**
     * Construct an And query
     *
     * @param string $field
     * @param int|string $value
     * @param string $sign
     * @return self
     */
    public function andWhere(string $field, $value, string $sign = "="): self
    {
        self::$values[] = $value;
        self::$queryString .= " AND $field $sign ?";
        return $this;
    }

    /**
     * Order the rows
     *
     * @param string $name
     * @param string $filter
     * @return self
     */
    public function orderBy(string $name, $filter = 'ASC'): self
    {
        self::$queryString .= " ORDER BY $name $filter";
        return $this;
    }

    /**
     * Fetch the data
     *
     * @return array
     */
    public function get(): array
    {
        $statement = self::$pdo->prepare(self::$queryString);
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this));

        $this->execute($statement);

        return $statement->fetchAll();
    }

    /**
     * execute de query
     *
     * @param [type] $statement
     * @return void
     */
    private function execute($statement)
    {
        if (!empty(self::$values)) {
            $statement->execute(self::$values);
        } else {
            $statement->execute();
        }

        // reset
        self::$values = [];
    }

    /**
     * Get the corresponding model according to an attribute
     *
     * @param integer $id
     * @return Model|bool
     */
    public function findBy(string $name, $value)
    {
        $query = "SELECT * FROM {$this->table} WHERE {$name} = ?";
        $statement = self::$pdo->prepare($query);
        $statement->setFetchMode(PDO::FETCH_CLASS, get_class($this));
        $statement->execute([$value]);
        return $statement->fetch();
    }

    /**
     * Delete a row in the database
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id):bool
    {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $statement = self::$pdo->prepare($query);

        return $statement->execute([$id]);
    }


    /**
     * create a new row in the database
     *
     * @param array $post
     * @return App\Models\Model|bool
     */
    public function create(array $post)
    {
        $question_marks = rtrim(str_repeat('?,', count($post)), ',');

        $names = implode(",", array_keys($post));

        $statement = self::$pdo
        ->prepare("INSERT INTO {$this->table} ($names) VALUES ($question_marks);");

        $post_values = array_values($post);

        return ($statement->execute($post_values)) ? 
        $this->findBy('id', self::$pdo->lastInsertId()): false;
    }


}