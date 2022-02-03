<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'username', 'password', 'email_verified_at', 'blocked'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
