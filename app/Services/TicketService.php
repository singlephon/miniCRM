<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\CustomerRepository;
use App\Repositories\TicketRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class TicketService extends Service
{
    public function __construct(
        public CustomerRepository $customerRepository,
        public TicketRepository $ticketRepository,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function create(
        string $name,
        string $phone,
        string $email,
        string $subject,
        string $description,
        ?UploadedFile $attachment = null
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

        if ($attachment) {
            $ticket->addMedia($attachment)->toMediaCollection('attachments');
        }

        return $ticket->load('media')->toArray();
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


    public function list(array $filters): LengthAwarePaginator
    {
        return $this->ticketRepository->search($filters);
    }

    public function updateStatus(Ticket $ticket, string $newStatus): void
    {
        $data = ['status' => $newStatus];

        if ($newStatus === 'closed') {
            $data['closed_at'] = Carbon::now();
        }

        $this->ticketRepository->update($ticket, $data);
    }
}
