<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(['open', 'in_progress', 'closed']);
        $closedAt = $status === 'closed' ? $this->faker->dateTimeBetween('-1 month', 'now') : null;

        return [
            'subject' => $this->faker->word(),
            'description' => $this->faker->text(),
            'status' => $status,
            'closed_at' => $closedAt,
            'created_at' => Carbon::now()->subDays(rand(30, 60)),
            'updated_at' => $closedAt,

            'customer_id' => Customer::factory(),
        ];
    }
}
