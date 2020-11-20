<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // User Descriptions
        $users = DB::table('users')
            ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')
            ->join('user_photos', 'users.id', '=', 'user_photos.user_id')
            // ->select('users.*', 'user_descriptions.*', 'user_photos.*')
            ->Where('id', 'LIKE', '%' . Auth::user()->id .  '%')
            ->first();


        // ienumerable
        $order_items = DB::table('order_items')->get();

        $tableOrder = OrderItem::all();

        if ($tableOrder->isEmpty()) {
            $order_items = DB::table('order_items')->paginate();
        } else {
            // ienumerable
            $order_items = DB::table('order_items');

            // search validation
            $search = OrderItem::where('transaction_no', 'like', '%' . request()->search . '%')
                ->OrWhere('barcode', 'like', '%' . request()->search . '%')
                ->first();


            if ($search === null) {
                return redirect('orders')->with('danger', 'Invalid Search');
            } else {
                $order_items = $order_items->where('transaction_no', 'like', '%' . request()->search . '%')
                    ->OrWhere('barcode', 'like', '%' . request()->search . '%')
                    ->latest()
                    ->paginate(10, ['*'], 'order_items');
            }
        }


        return view('orders', [
            'users' => $users,
            'order_items' => $order_items,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function show(OrderItem $orderItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderItem $orderItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderItem  $orderItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($order_item_id)
    {
        OrderItem::destroy($order_item_id);
        return redirect('orders')->with('success', 'Sucessfully Deleted!');
    }
}
