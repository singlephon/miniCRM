<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function search(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = Ticket::with('customer')->latest();

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['date'])) {
            $query->whereDate('created_at', $filters['date']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function update(Ticket $ticket, array $data): bool
    {
        return $ticket->update($data);
    }
}
