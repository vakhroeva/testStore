<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:1',
            'comment' => 'nullable|string',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $validated['price'] = $product->price * $validated['amount'];

        Order::create($validated);

        return redirect()->route('orders.index')->with('success', 'Заказ создан');
    }

    public function edit(Order $order)
    {
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'client_name' => 'sometimes|required|string|max:255',
            'product_id' => 'sometimes|required|exists:products,id',
            'amount' => 'sometimes|required|integer|min:1',
            'comment' => 'nullable|string',
            'status' => 'sometimes|required|string|in:новый,завершен',
        ]);

        if (isset($validated['product_id']) || isset($validated['amount'])) {
            $productId = $validated['product_id'] ?? $order->product_id;
            $amount = $validated['amount'] ?? $order->amount;
            $product = Product::findOrFail($productId);
            $validated['price'] = $product->price * $amount;
        }

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Заказ обновлен');
    }

    public function destroy(Order $order)
    {
        if ($order->status !== 'завершен') {
            return redirect()->route('orders.index')->with('danger', 'Невозможно удалить заказ пока он не завершен');
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Заказ удален');
    }

    public function show(Order $order)
    {
        $order->load('product');
        return view('orders.show', compact('order'));
    }
}
