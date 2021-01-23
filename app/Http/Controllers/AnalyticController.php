<?php

namespace App\Http\Controllers;

use App\Models\Analytic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AnalyticController extends Controller
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

        // where date range laravel

        //Queries to display

        // sales
        $order_items = DB::table('order_items')
            ->whereBetween('created_at', [request()->sales_from, request()->sales_to])
            ->orderBy('created_at')
            ->get();
        if (!empty(request()->sales_from)  ||  !empty(request()->sales_to)) {
            $order_items = DB::table('order_items')
                ->whereBetween('created_at', [request()->sales_from, request()->sales_to])
                ->orderBy('created_at')
                ->get();
        } else {
            $order_items = DB::table('order_items')
                ->orderBy('created_at')
                ->get();
        }

        // new products filtered
        $new_products = DB::table('products')
            ->whereDate('created_at',  request()->product_month)
            ->count();
        if (!empty(request()->product_month)) {
            $new_products = DB::table('products')
                ->whereDate('created_at',  request()->product_month)
                ->count();
        } else {
            $new_products = DB::table('products')
                ->count();
        }

        // new users filtered
        $new_users = DB::table('users')
            ->whereDate('created_at',  request()->user_month)
            ->count();
        if (!empty(request()->user_month)) {
            $new_users = DB::table('users')
                ->whereDate('created_at',  request()->user_month)
                ->count();
        } else {
            $new_users = DB::table('users')
                ->count();
        }

        // total invoices
        $total_invoices = DB::table('invoices')
            ->count();


        // best seller
        $best_seller = DB::table('order_items')
            ->max('quantity');

        // all orders
        $orders_count = DB::table('orders')->count();

        // cancelled
        $orders_canceled = DB::table('orders')
            ->where('status', 'Canceled')
            ->count();

        // Delivered
        $orders_delivered = DB::table('orders')
            ->where('status', 'Delivered')
            ->count();

        // Shipping
        $orders_shipping = DB::table('orders')
            ->where('status', 'Shipping')
            ->count();

        // Returned
        $orders_returned = DB::table('orders')
            ->where('status', 'Returned')
            ->count();

        // active supplier
        $active_supplier = DB::table('suppliers')
            ->where('status', 'Active')
            ->count();

        // inactive supplier
        $inactive_supplier = DB::table('suppliers')
            ->where('status', 'Inactive')
            ->count();

        //earned this month
        $earned_this = DB::table('order_items')
            ->whereMonth('created_at', '=', Carbon::now()->month)
            ->sum('price');

        //earned last month
        $earned_last = DB::table('order_items')
            ->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
            ->sum('price');

        //earned last month
        $earned_all = DB::table('order_items')
            ->sum('price');

        return view('analytics', [
            'users' => $users,
            'order_items' => $order_items,
            'new_products' => $new_products,
            'new_users' => $new_users,
            'total_invoices' => $total_invoices,
            'orders_count' => $orders_count,
            'best_seller' => $best_seller,
            'orders_canceled' => $orders_canceled,
            'orders_delivered' => $orders_delivered,
            'orders_shipping' => $orders_shipping,
            'orders_returned' => $orders_returned,
            'active_supplier' => $active_supplier,
            'inactive_supplier' => $inactive_supplier,
            'earned_this' => $earned_this,
            'earned_last' => $earned_last,
            'earned_all' => $earned_all,

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
     * @param  \App\Models\Analytic  $analytic
     * @return \Illuminate\Http\Response
     */
    public function show(Analytic $analytic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Analytic  $analytic
     * @return \Illuminate\Http\Response
     */
    public function edit(Analytic $analytic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Analytic  $analytic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Analytic $analytic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Analytic  $analytic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Analytic $analytic)
    {
        //
    }
}
