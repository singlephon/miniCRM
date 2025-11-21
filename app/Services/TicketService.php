<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\CustomerRepository;
use App\Repositories\TicketRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class TicketService extends Service
{

    public function __construct(
        public CustomerRepository $customerRepository,
        public TicketRepository $ticketRepository,
    ) {}

    /**
     * @throws \Exception
     */
    public function create(
        string $name,
        string $phone,
        string $email,
        string $subject,
        string $description,
    ): array {
        $customer = $this->customerRepository->findOrCreate(
            name: $name,
            phone: $phone,
            email: $email
        );

        $ticket = $this->ticketRepository->create(
            customer_id: $customer->id,
            subject: $subject,
            description: $description
        );

        return $ticket->toArray();
    }

    public function stats(): array
    {
        $now = Carbon::now();

        return [
            'day' => Ticket::createdSince($now->clone()->subDay())->count(),
            'week' => Ticket::createdSince($now->clone()->subWeek())->count(),
            'month' => Ticket::createdSince($now->clone()->subMonth())->count(),
        ];
    }
}
