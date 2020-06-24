<?php

namespace App\Modules\Admin\Http\Controllers;


use App\Http\Requests;
use App\Languages;
use App\Modules\Admin\Http\Controllers\Controller;
use App\Modules\Admin\Models\AdminUser;
use App\Modules\Admin\Models\Department;
use App\Modules\Admin\Models\Ticket;
use App\Modules\Admin\Models\TicketMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        $filter = request()->all();

        $langs = Languages::all();

        $departmentList = Department::all();

        $departmentsData = DB::table('tickets')
            ->select(
                DB::raw('departments.id as department_id'),
                DB::raw('departments.display_name as department_name'),
                DB::raw('count(tickets.id) as total_tickets'),
                DB::raw("(SELECT count(tickets.id) FROM tickets WHERE departments.id = tickets.department_id and tickets.priority = 'high') as high"),
                DB::raw("(SELECT count(tickets.id) FROM tickets WHERE departments.id = tickets.department_id and tickets.priority = 'medium') as medium"),
                DB::raw("(SELECT count(tickets.id) FROM tickets WHERE departments.id = tickets.department_id and tickets.priority = 'low') as low")
            )
            ->leftJoin('departments', 'departments.id', '=', 'tickets.department_id')
            ->groupBy('departments.id')
            ->get();

        $statuses = DB::table('tickets')
            ->select('status',DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $agents = AdminUser::whereHas('roles', function ($q){
            $q->where('name', 'agent');
        })->get();

        foreach ( $agents as $agent){
            $agent['departments'] = $agent->departments()->get();
        }

        $query = DB::table('tickets')
            ->select(
                'tickets.id',
                'tickets.client_id',
                'tickets.admin_user_id',
                'tickets.department_id',
                'tickets.status',
                'tickets.title',
                'tickets.priority',
                'tickets.created_at',
                DB::raw('departments.display_name as department'),
                DB::raw('users.first_name as client_first_name'),
                DB::raw('users.last_name as client_last_name'),
                DB::raw('businesses.name as business_name'),
                DB::raw('admin_users.name as agent'),
                DB::raw("(SELECT languages.name FROM languages WHERE tickets.client_id = users.id AND users.language = languages.id ) as lang"),
                DB::raw("(SELECT count(tickets.id) FROM tickets WHERE users.id = tickets.client_id GROUP BY tickets.client_id) as all_count_tickets"),
                DB::raw("(SELECT count(tickets.id) FROM tickets WHERE users.id = tickets.client_id AND tickets.status LIKE '%Open%' GROUP BY tickets.client_id) as open_count_tickets"),
                DB::raw("(SELECT MAX(ticket_messages.created_at) FROM ticket_messages WHERE tickets.id = ticket_messages.ticket_id ) as last_reply")
            );

        if (count($filter)){
            $query = $this->composeConditions($query, $filter);
        }

            $conditions = $query->leftJoin('users', 'users.id', '=', 'tickets.client_id')
            ->leftJoin('businesses', 'businesses.id', '=', 'tickets.business_id')
            ->leftJoin('ticket_messages', 'tickets.id', '=', 'ticket_messages.ticket_id')
            ->leftJoin('admin_users', 'admin_users.id', '=', 'tickets.admin_user_id')
            ->leftJoin('departments', 'departments.id', '=', 'tickets.department_id');

        if (isset($filter['ordered-name'])){
            $conditions = $this->composeOrdered($query, $filter['ordered-name'], $filter['ordered-direction']);
        }
            $tickets = $conditions->groupBy('tickets.id')
                ->paginate(15)
                ->appends(request()->query());

//        $tickets = $conditions->groupBy('tickets.id')->get();
//        dd($tickets);

        return view('admin::ticket.index', compact('tickets', 'departmentList', 'departmentsData' , 'agents', 'statuses', 'langs'));
    }

    public function composeConditions($query, $filter)
    {
        if(isset($filter['filter_status'])){
            $query->where('tickets.status', '=', $filter['filter_status']);
        }

        if (isset($filter['title'])){
            $query->where('tickets.title', 'like', '%'.$filter['title'].'%');
        }

        if (isset($filter['invoice_id'])){
            $query->where('invoice.id', '=', $filter['invoice_id']);
        }

        if (isset($filter['client_s'])){
            $query->where('users.id', '=', $filter['client_s'])->orWhere('users.first_name', 'like', '%'.$filter['client_s'].'%');
        }

        if (isset($filter['filter_priority'])){
            $query->where('tickets.priority', '=', $filter['filter_priority']);
        }

        if (isset($filter['filter_department'])){
            $query->where('tickets.department_id', $filter['filter_department']);
        }

        if (isset($filter['agent_id'])){
            $query->where('tickets.admin_user_id', '=', $filter['agent_id']);
        }

        if (isset($filter['priority'])){
            $query->where('tickets.priority', '=', $filter['priority']);
        }

        if (isset($filter['delay'])){
            $dayToCheck = Carbon::now()->subDays($filter['delay']);
            $query->where('tickets.created_at', '<', $dayToCheck);
        }

        return $query;
    }

    public function composeOrdered($query, $ordered, $direction)
    {
        if ($ordered == 'client-id'){
            $query->orderBy('tickets.client_id', $direction);
        }

        if ($ordered == 'business-name'){
            $query->orderBy('business_name', $direction);
        }

        if ($ordered == 'ticket-id'){
            $query->orderBy('tickets.id', $direction);
        }

        if ($ordered == 'status'){
            $query->orderBy('tickets.status', $direction);
        }

        if ($ordered == 'title'){
            $query->orderBy('tickets.title', $direction);
        }

        if ($ordered == 'last-reply'){
            $query->orderBy('last_reply', $direction);
        }

        if ($ordered == 'assigned-to'){
            $query->orderBy('agent', $direction);
        }

        if ($ordered == 'priority'){
            $query->orderBy('tickets.priority', $direction);
        }
        if ($ordered == 'department'){
            $query->orderBy('department', $direction);
        }
        if ($ordered == 'open-since'){
            $query->orderBy('tickets.created_at', $direction);
        }

        if ($ordered == 'open-tickets'){
            $query->orderBy('open_tickets', $direction);
        }

        return $query;
    }

    public function show(Ticket $ticket) {

        $ticket = $ticket->load('client');

        $ticket = $ticket->load('ticketMessages');

        foreach ($ticket->ticketMessages as $item){
            $item->load('admin_user');
            $item->client = $ticket->client;
        }
        
        $ticket = $ticket->load('business');

        $ticket->client->lang = DB::table('languages')->where('languages.id', '=', $ticket->client->language)->first();

        return response()->json($ticket);
    }


    public function update(Ticket $ticket)
    {

        $user = Auth::guard('adminUser')->user();

        $message = $this->composeSystemMessage($ticket, $user, request());

        $data =$this->composeUpdateTicket($ticket, request());

        if (!empty($data)){
            $ticket->update($data);

            TicketMessage::create([
                'ticket_id' => $ticket->id,
                'agent_id' => $user->id,
                'client_id' => 0,
                'text' => $message,
                'type' => 'system_message'
            ]);
        }

        return response()->json('ok', 200);
    }

    public function composeUpdateTicket($ticket, $request)
    {
        $data = [];

        if ($ticket->admin_user_id != $request->admin_user_id){
            $data['admin_user_id'] = $request->admin_user_id;
        }

        if ($ticket->department_id != $request->department_id){
            $data['department_id'] = $request->department_id;
        }

        if($ticket->status != $request->status){
            $data['status'] = $request->status;
        }

        if ($ticket->priority != $request->priority){
            $data['priority'] = $request->priority;
        }

        return $data;
    }


    public function composeSystemMessage($ticket, $user, $request)
    {
        $message = '';

        $message .= $user->name;

        if ($ticket->admin_user_id != $request->admin_user_id){

            $agentTo = AdminUser::find($request->admin_user_id);

            $message .= ' assigned ticket to ' . $agentTo->name . '; ';
            }

        if ($ticket->department_id != $request->department_id){

            $departmentFrom = $ticket->load('department');

            $departmentTo = Department::find($request->department_id);

            $message .= ' changed department from '. $departmentFrom->department->display_name .' to ' . $departmentTo->display_name . '; ';
            }

        if($ticket->status != $request->status){
            $message .= ' changed ticket status from ' . $ticket->status . ' to ' . $request->status . '; ';
        }

        if ($ticket->priority != $request->priority){
            $message .= ' changed priority from ' . $ticket->priority . ' to ' . $request->priority . '; ';
        }

        return trim($message, '; ');
    }

    
    public function add_massage(Ticket $ticket)
    {
        $user = Auth::guard('adminUser')->user();

        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'agent_id' => $user->id,
            'client_id' => 0,
            'text' => request()->text,
            'type' => request()->type
        ]);

        return response()->json('ok', 200);
    }

    public function update_status(Ticket $ticket)
    {
        $user = Auth::guard('adminUser')->user();

        $data['admin_user_id'] = $user->id;
        $data['status'] = request()->status;

        if (!empty($data)){
            $ticket->update($data);
        }

        if(!empty( request()->text) ){
            TicketMessage::create([
                'ticket_id' => $ticket->id,
                'agent_id' => $user->id,
                'client_id' => 0,
                'text' => $user->name . ' resolved: ' . request()->text,
                'type' => 'system_message'
            ]);
        }

        return response()->json('ok', 200);
    }

}
