<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\InvoiceItem;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory(5)->has(
            Invoice::factory(4)->has(
                Discount::factory(1),
                'discount'
            )->has(
                InvoiceItem::factory(4),
                'item'
            )
        )->create();
        Customer::factory(5)->has(
            Invoice::factory(2)->has(
                Discount::factory(2),
                'discount'
            )->has(
                InvoiceItem::factory(8),
                'item'
            )
        )->create();

        Customer::factory(5)->has(
            Invoice::factory(6)->has(
                Discount::factory(1),
                'discount'
            )->has(
                InvoiceItem::factory(4),
                'item'
            )
        )->create();
    }
}
