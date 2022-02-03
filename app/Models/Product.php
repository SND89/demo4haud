<?php

namespace App\Models;

use App\Models\ProductImage;
use App\Models\ProductStock;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stock()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function invoiceItem()
    {
        return $this->has(InvoiceItem::class);
    }
}
