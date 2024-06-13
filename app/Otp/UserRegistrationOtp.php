<?php

namespace App\Otp;

use App\Models\Customer;
use SadiqSalau\LaravelOtp\Contracts\OtpInterface as Otp;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserRegistrationOtp implements Otp
{
/**
     * Initiates the OTP with customer detail
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        protected string $first_name,
        protected string $last_name,
        protected string $email,
        protected string $password
    ) {
    }

    /**
     * Creates the customer
     */
    public function process()
    {
        /** @var Customer */
        $customer = Customer::unguarded(function () {
            return Customer::create([
                'first_name'                  => $this->first_name,
                'last_name'                  => $this->last_name,
                'email'                 => $this->email,
                // 'code'                 => rand(0000, 9999),
                'password'              => Hash::make($this->password),
                'email_verified_at'     => now(),
            ]);
        });

        event(new Registered($customer));
        
        Auth::login($customer);

        return [
            'customer' => $customer
        ];
    }
}
