<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function index()
    {
        return Inertia::render('checkout/Checkout');
    }

    public function store(Request $request)
    {
        $order = Order::create([ 'user_id' => $request->user()->id, 'amount' => $request->total, 'status' => 'pending' ]);
        return $request->user()->checkoutCharge($request->total * 100, 'Dev Shop Checkout', sessionOptions: [
            'success_url' => route('success', ['order' => $order->id]),
            'cancel_url' => route('cancel', ['order' => $order->id]),
        ])->asStripeCheckoutSession()->url;
    }

    public function orders() {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return Inertia::render('checkout/Orders')->with('orders', $orders);
    }

    public function success(Request $request) {
        // TEST - Easily hackable
        Order::where('id', $request->order)->update(['status' => 'paid']);
        return Inertia::render('checkout/Success');
    }

    public function cancel(Request $request) {
        Order::where('id', $request->order)->update(['status' => 'cancelled']);
        return Inertia::render('checkout/Cancel');
    }
}
