<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\InvoiceItem;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function item()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function discount()
    {
        return $this->hasMany(Discount::class);
    }
}
