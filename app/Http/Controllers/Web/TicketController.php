<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\UpdateTicketStatusRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController
{
    public function __construct(
        public TicketService $ticketService
    ) {}

    public function index(Request $request)
    {
        $tickets = $this->ticketService
            ->list(filters: $request->all());

        return view('tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function update(UpdateTicketStatusRequest $request, Ticket $ticket)
    {
        $this->ticketService
            ->updateStatus(
                ticket: $ticket,
                newStatus: $request->status
            );

        return back()->with('success', 'Status updated!');
    }
}
