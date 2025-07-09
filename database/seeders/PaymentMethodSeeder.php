<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Bank BCA',
                'description' => 'Transfer ke rekening BCA',
                'account_number' => '1234567890',
            ],
            [
                'name' => 'OVO',
                'description' => 'Pembayaran melalui OVO',
                'account_number' => '081234567890',
            ],
            [
                'name' => 'Gopay',
                'description' => 'Pembayaran melalui Gopay',
                'account_number' => '081234567891',
            ],
            [
                'name' => 'Dana',
                'description' => 'Pembayaran melalui Dana',
                'account_number' => '081234567892',
            ],
            [
                'name' => 'Cash',
                'description' => 'Pembayaran tunai di tempat',
                'account_number' => null,
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}