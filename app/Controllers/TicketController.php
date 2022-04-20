<?php
namespace App\Controllers;

use Carbon\Carbon;
use Http\Response;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Category;
use App\Controllers\Controller;
use App\Mails\NotificationMail;
use App\Resources\TicketResource;
use Services\Generation\PdfGenerator;

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
    public function post(User $user_model, NotificationMail $notificationMail)
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
        $body['user_id'] = auth()->u_userid;

        // admins who receive the notification
        $users = $user_model->select(['u_email'])->where('is_agent', User::ADMIN)->get();
        $emails = array_map(fn ($user) => $user->u_email, $users);

        // Ticket creation
        $new_ticket = $this->ticket_model->create($body);
        $new_ticket->update(['reference' => "ticket_0$new_ticket->id"]);

        // Email notification
        $notificationMail->to($emails)->with($new_ticket)->send();

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
     * Generate a pdf with a ticket information
     *
     * @param integer $id
     * @return void
     */
    public function generate_pdf(int $id, PdfGenerator $pdf)
    {
        $data = $this->ticket_resource($id)->attributes();
        $pdf->load_html('pdf/ticket', [
            'info' => (object) $data, 
            'printed_at' => Carbon::now()]
        )->download($data['reference']);
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
        $data = $this->ticket_resource($id)->attributes();
        return Response::json($data);
    }

    /**
     * Retrieve data for a ticket resource
     *
     * @param integer $id
     * @return TicketResource
     */
    private function ticket_resource(int $id): TicketResource
    {
        $ticket = $this->ticket_model->findBy('id', $id);

        return new TicketResource($ticket);
    }

    /**
     * Assign a ticket to the current user
     *
     * @return void
     */
    public function assign(int $id)
    {
        $this->ticket_model->update(['resolver_id' => auth()->u_userid, 'state' => Ticket::PENDING], $id);

        flash("Vous avez choisi Le ticket numéro $id");

        return Response::redirect('/tickets-declares');
    }

    /**
     * Assign a ticket to the current user
     *
     * @return void
     */
    public function unassign(int $id)
    {
        $this->ticket_model->update(['resolver_id' => null, 'state' => Ticket::OPEN], $id);

        flash("Vous ne travaillez plus sur le ticket numéro $id");

        return Response::back();
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