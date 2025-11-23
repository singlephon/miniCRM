<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CreateTicketRequest;
use App\Services\TicketService;
use Exception;

class TicketController
{
    public function __construct(
        public TicketService $ticketService
    ) {}

    public function statistics()
    {
        try {
            $tickets = $this->ticketService
                ->stats();

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }

        return response()->json([
            'tickets' => $tickets,
        ]);
    }

    public function store(CreateTicketRequest $request)
    {
        try {
            $ticket = $this->ticketService
                ->create(...$request->toArray());

        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Created successfully',
            'ticket' => $ticket,
        ]);
    }
}
