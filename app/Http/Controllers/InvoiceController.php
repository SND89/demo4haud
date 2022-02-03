<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $invoices = Invoice::with('customer', 'item', 'discount')->get();

        foreach ($invoices as $inv) {
            $productPrice = DB::table('products')
                // ->select('products.price, invoice_items.qty')
                ->join('invoice_items', "products.id", '=', 'invoice_items.product_id')
                ->where('invoice_items.invoice_id', '=', $inv->id)
                ->get();
            // dd($productPrice[0]->price);
            // $inv->total = array_sum($productPrice->price * $productPrice->qty);
            $productPricetotal = 0;
            foreach ($productPrice as $pp) {
                $productPricetotal += $pp->price * $pp->qty;
            }

            $inv->total = $productPricetotal;
            $inv->discounted = $this->applyDiscount($productPricetotal, $inv->discount);
        }

        return view('invoice', compact('invoices'));
    }

    //NEEED TO MOVE THIS ! Maybe as a decorator 
    private function applyDiscount($sum, $discounts)
    {
        foreach ($discounts as $disc) {
            if ($disc->type == Discount::PERCENT) {
                $sum = $disc->value / 100 * $sum;
            } else {
                $sum -= $disc->value;
            }
        }

        return $sum;
    }
}
