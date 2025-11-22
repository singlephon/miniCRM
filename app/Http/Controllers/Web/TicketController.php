<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\UpdateTicketStatusRequest;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController
{
    public function index(Request $request)
    {
        $tickets = TicketService::make()
            ->list($request->all());

        return view('tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function update(UpdateTicketStatusRequest $request, Ticket $ticket)
    {
        TicketService::make()
            ->updateStatus($ticket, $request->status);

        return back()->with('success', 'Status updated!');
    }
}
