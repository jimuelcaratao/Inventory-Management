<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
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

        // order Record
        // ienumerable
        $orders = DB::table('orders')->get();

        $tableOrder = Order::all();

        if ($tableOrder->isEmpty()) {
            $orders = DB::table('orders')->paginate();
        } else {
            // ienumerable
            $orders = DB::table('orders');

            // search validation
            $search = Order::where('transaction_no', 'like', '%' . request()->searchOrder . '%')
                ->OrWhere('user_id', 'like', '%' . request()->searchOrder . '%')
                ->first();


            if ($search === null) {
                return redirect('orders')->with('danger', 'Invalid Search');
            } else {
                $orders = $orders->where('transaction_no', 'like', '%' . request()->searchOrder . '%')
                    ->OrWhere('user_id', 'like', '%' . request()->searchOrder . '%')
                    ->latest()
                    ->paginate(10, ['*'], 'orders');
            }
        }

        // order Record
        // ienumerable
        $order_items = DB::table('order_items')->get();

        $tableOrderItem = OrderItem::all();

        if ($tableOrderItem->isEmpty()) {
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
            'orders' => $orders,
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
        $datas = DB::table('orders')->get();
        try {
            // insert
            foreach ($datas as $data) {
                DB::table('invoices')->insert(
                    [
                        'invoice_id' => $data->transaction_no,
                        'user_id' => $data->user_id,
                        'status' => $data->status,
                        'shipped_date' => $data->shipped_date,
                        'arriving_date' => $data->arriving_date,
                    ]
                );
            }
            // turncate
            // Order::truncate();
            return redirect('orders')->with('success', 'Sucessfully migrated!');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('orders')->with('danger', 'Invalid');
        }
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
