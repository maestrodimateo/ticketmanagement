<?php
namespace App\Models;

use Carbon\Carbon;
use App\Models\Model;

class Ticket extends Model
{
    public const OPEN = 1;
    public const PENDING = 2;
    public const CLOSED = 3;
    
    protected $table = 'tickets';

    /**
     * A ticket is created by a user
     * @return Model|null
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A ticket can be solved by a user
     *
     * @return Model|null
     */
    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolver_id');
    }

    /**
     * Retrieve the ticket emergency level
     *
     * @return array
     */
    public function getLevel(): array
    {
        switch ($this->emergency_level) {
            case 1:
                return ['title' => 'faible', 'color' => 'bg-success'];
                break;
            case 2:
                return ['title' => 'moyen', 'color' => 'bg-warning'];
                break;
            default:
                return ['title' => 'élevé', 'color' => 'bg-danger'];
                break;
        }
    }

    /**
     * Retrieve the ticket's state
     *
     * @return string
     */
    public function getState(): string
    {
        switch ($this->state) {
            case 1:
                return 'Ouvert';
                break;
            case 2:
                return 'En cours';
                break;
            default:
                return 'Clôturé';
                break;
        }
    }

    public function reference(): string
    {
        return 'Ticket_0' . $this->id;
    }

    /**
     * Format the created_at attribute
     *
     * @param string $format
     * @return string
     */
    public function created_at(string $format = 'd/m/Y à H:i:s'): string
    {
        return Carbon::createFromTimeString($this->created_at)->format($format);
    }

    /**
     * Format the closed_at attribute
     *
     * @param string $format
     * @return string|null
     */
    public function closed_at(string $format = 'd/m/Y à H:i:s')
    {
        if ($this->closed_at) {
            return Carbon::createFromTimeString($this->closed_at)->format($format);
        }
        return null;
    }

    /**
     * Get only the declared tickets
     *
     * @return array
     */
    protected function only_declared_tickets()
    {
        return $this->select()->where('resolver_id', NULL, 'IS')->get();
    }
}