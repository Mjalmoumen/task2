<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getTopCustomerSpender()
    {
        $topSpender = Customer::with(['orders.orderDetails' => function ($query) {
            $query->selectRaw('SUM(priceEach) as totalAmount');
        }])->orderByDesc('orders.orderDetails.totalAmount')->first();
        return $topSpender;
    }

    public function getTopOrderCountCustomer()
    {
        $topOrderCountCustomer = Customer::withCount('orders')->orderByDesc('orders_count')->first();
        return $topOrderCountCustomer;
    }
}
