<?php
namespace App\Models;

class User extends Model
{
    /**
     * table name
     *
     * @var string
     */
    protected $table = 'users';


    /**
     * credentials keys
     *
     * @var array
     */
    public static $credentials = ['mail', 'password'];


    /**
     * A user belongs to a service
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Retrieve all the tickets declared by the current user
     *
     * @return array
     */
    public function my_declared_tickets(): array
    {
        return (new Ticket)->select()->where('user_id', auth()->id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Retrieve the tickets assigned to the current user
     *
     * @return array
     */
    public function assigned_tickets(): array
    {
        return (new Ticket)->noTrashed()
        ->andWhere('resolver_id', auth()->id)
        ->orderBy('created_at', 'desc')->get();
    }

    /**
     * Get user's role
     *
     * @return boolean
     */
    public function is_admin(): bool
    {
        return ! (bool) $this->is_agent;
    }
}