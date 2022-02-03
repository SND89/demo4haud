<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    //Define discount type
    const PERCENT = 0; // % discounted (e.g. -50% )
    const VALUE = 1; // X value discount (e.g. -50$ )

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
