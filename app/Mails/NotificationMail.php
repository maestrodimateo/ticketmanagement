<?php
namespace App\Mails;

use App\Models\Ticket;
use Services\MailHandler\Mailer;

class NotificationMail extends Mailer
{

    private Ticket $ticket;

    /**
     * Add data the to mail to be sent
     *
     * @param array $data
     * @return void
     */
    public function with(Ticket $ticket): self
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * process some intermediate actions
     *
     * @return void
     */
    public function handle()
    {
        $this->setSubject('Ticket numéro '. $this->ticket->id . ' créé.')
        ->setBody('mails/new_ticket', ['ticket' => $this->ticket, 'creator' => auth()]);
    }
}