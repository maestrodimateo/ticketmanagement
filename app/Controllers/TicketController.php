<?php
namespace App\Controllers;

use Carbon\Carbon;
use Http\Response;
use App\Models\Ticket;
use App\Models\Category;
use App\Controllers\Controller;
use App\Mails\NotificationMail;
use App\Resources\TicketResource;

class TicketController extends Controller
{

    /**
     * @var string
     */
    public $layout = 'layout/master';

    private Ticket $ticket_model;
    private Category $category_model;

    public function __construct(Ticket $ticket, Category $category)
    {
        $this->ticket_model = $ticket;
        $this->category_model = $category;
    }

    /**
     * Page to declare a new ticket
     *
     * @return void
     */
    public function create()
    {
        $categories = $this->category_model->all();

        $bugs = $this->category_model->findBy('id', 1)->bugs();

        return Response::render_withLayout('new_ticket', compact('categories', 'bugs'));
    }

    /**
     * Post the form of ticket declaration
     *
     * @return void
     */
    public function post(NotificationMail $notificationMail)
    {        
        $bug_id = $this->request->getBody()['bug'] == "0" ? 'true' : 'false';

        // form validation
        $this->request->validate([
            'category' => ['required'],
            'bug' => ['required'],
            'description' => ["required_if:{$bug_id}", 'max:500'],
            'emergency_level' => ['required'],
        ]);

        $body = $this->request->getBody();

        $body['user_id'] = auth()->id;

        $new_ticket = $this->ticket_model->create($body);

        $new_ticket->update(['reference' => "ticket_0$new_ticket->id"]);

        $notificationMail->to(['noelmeb12@gmail.com'])->with($new_ticket)->send();

        flash('Ticket ajouté avec succès');

        return Response::redirect('/nouveau-ticket');
    }

    /**
     * List all the tickets
     *
     * @return void
     */
    public function all()
    {
        $declared_tickets = $this->ticket_model->noTrashed()->get();

        return Response::render_withLayout('all_tickets', compact('declared_tickets'));
    }

    /**
     * Delete a specific ticket according to its id
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $ticket = $this->ticket_model->findBy('id', $id);
        $ticket->update(['deleted_at' => Carbon::now()]);

        flash("Ticket numéro $id supprimé");

        return Response::back();
    }

    /**
     * Page for updating a ticket
     *
     * @return void
     */
    public function edit()
    {

    }

    /**
     * Update a ticket
     *
     * @param integer $id
     * @return void
     */
    public function update(int $id)
    {

    }

    /**
     * list the tickets assigned to a specific admin
     *
     * @return void
     */
    public function my_tickets()
    {
        $assigned_tickets = auth()->assigned_tickets();
        return Response::render_withLayout('my_tickets', compact('assigned_tickets'));
    }

    /**
     * The ticket declared by the current user
     *
     * @return void
     */
    public function owner_ticket()
    {
        $tickets = auth()->my_declared_tickets();

        return Response::render_withLayout('my_declared_tickets', compact('tickets'));
    }

    /**
     * retrieve a specific ticket
     *
     * @param integer $id
     * @return void
     */
    public function ticket(int $id)
    {
        $ticket = $this->ticket_model->findBy('id', $id);

        $data = (new TicketResource($ticket))->attributes();

        return Response::json($data);
    }

    /**
     * Assign a ticket to the current user
     *
     * @return void
     */
    public function assign()
    {
        $id = $this->request->getBody()['id'];

        $this->ticket_model->update(['resolver_id' => auth()->id, 'state' => Ticket::PENDING], $id);

        flash("Vous avez choisi Le ticket numéro $id");

        return Response::redirect('/tickets-declares');
    }

    /**
     * Close a specific ticket
     *
     * @param integer $id
     * @return void
     */
    public function close_ticket(int $id)
    {
        $ticket = $this->ticket_model->findBy('id', $id);
        $solution = $this->request->getBody()['solution'];
        $ticket->update(['solution' => $solution, 'state' => Ticket::CLOSED, 'closed_at' => Carbon::now()]);

        flash("Vous avez cloturé Le ticket numéro $id");

        return Response::redirect('/mes-tickets-assignes');
    }
}