<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::query()->where('user_id', auth()->user()->id);

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
        $recibido = Order::where('status', 2)->where('user_id', auth()->user()->id)->count();
        $enviado = Order::where('status', 3)->where('user_id', auth()->user()->id)->count();
        $entregado = Order::where('status', 4)->where('user_id', auth()->user()->id)->count();
        $anulado = Order::where('status', 5)->where('user_id', auth()->user()->id)->count();

        return view('orders.index', compact('orders', 'pendiente', 'recibido', 'enviado', 'entregado', 'anulado'));
    }

    public function show(Order $order)
    {
        $this->authorize('author', $order);

        $items = json_decode($order->content);

        return view('orders.show', compact('order', 'items'));
    }


    public function pay(Order $order, Request $request)
    {

        $this->authorize('author', $order);

        $payment_id = $request->get('payment_id');

        $response = http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-6509222656269035-062022-c2e01d5c247e7d66efbf29a2c3f1a53e-778711587");

        $response = json_decode($response);

        $status = $response->status;

        if ($status == 'approved') {
            $order->status = 2;
            $order->save();
        }

        return redirect()->route('orders.show', $order);
    }
}
