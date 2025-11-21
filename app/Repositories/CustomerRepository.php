<?php

namespace App\Repositories;

use App\Models\Customer;
use Exception;

class CustomerRepository
{

    /**
     * @throws Exception
     */
    public function findOrCreate(string $name, string $phone, string $email): Customer
    {
        $customerByPhone = Customer::where('phone', $phone)->first();
        $customerByEmail = Customer::where('email', $email)->first();

        if (($customerByPhone or $customerByEmail) and ($customerByPhone?->id !== $customerByEmail?->id)) {
            throw new Exception("Data collision: Phone number or email already used with another customer");
        }

        if ($customerByPhone->id == $customerByEmail->id) {
            return $customerByEmail;
        }

        return Customer::create([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
        ]);
    }
}
