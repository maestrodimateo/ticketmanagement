<?php
namespace App\Resources;

use App\Models\User;
use App\Models\Ticket;

class TicketResource
{
    private Ticket $ticket;
    private User $user;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
        $this->user = $ticket->user();
    }

    public function attributes()
    {
        return 
        [
            'reference' => $this->ticket->reference(),
            'description' => $this->ticket->description,
            'solution' => $this->ticket->solution,
            'label' => $this->ticket->bug,
            'created_at' => $this->ticket->created_at(),
            'closed_at' => $this->ticket->closed_at,
            'user' => [
                'name' => $this->user->nom,
                'firstname' => $this->user->prenom,
                'email' => $this->user->mail,
                'service' => $this->user->service()->nom,
                'department' => $this->user->service()->department()->nom,
            ]
        ];
    }
}