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

        if (!$customerByPhone and !$customerByEmail) {
            return Customer::create([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
            ]);
        }

        if (($customerByPhone and $customerByEmail) and $customerByPhone->is($customerByEmail)) {
            return $customerByPhone;
        }

        throw new Exception("Phone number or email already used with another customer");
    }
}
