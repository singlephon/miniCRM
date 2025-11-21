<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository
{

    public function create(int $customer_id, string $subject, string $description): Ticket
    {
        return Ticket::create([
            'customer_id' => $customer_id,
            'subject' => $subject,
            'description' => $description,
        ]);
    }
}
