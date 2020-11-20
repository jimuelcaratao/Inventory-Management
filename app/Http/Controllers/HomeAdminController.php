<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeAdminController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
        $categories = Category::where('status', 'available')
            ->orderBy('category_name')
            ->get();

        $orders = DB::table('orders')
            ->get();

        $order_items = DB::table('order_items')
            ->latest()
            ->get();


        //Queries to display
        $users_count = DB::table('users')
            ->where('is_admin', '0')
            ->count();

        $products_count = DB::table('products')->count();

        $products_count_low = DB::table('products')
            ->where('stock', '<=', 10)
            ->count();

        $orders_count_today = DB::table('orders')
            ->whereDate('created_at', Carbon::today())
            ->count();

        $earned_month = DB::table('order_items')->sum('price');

        // identify time now

        $dt = new DateTime();
        $hour = $dt->format('H');
        // $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning");

        if ($hour > 6 && $hour <= 11) {
            $dayTerm = "Good Morning";
        } else if ($hour > 11 && $hour <= 17) {
            $dayTerm = "Good Afternoon";
        } else if ($hour > 17 && $hour <= 23) {
            $dayTerm = "Good Evening";
        } else {
            $dayTerm = "Why aren't you asleep?  Are you programming?";
        }

        // $order_items = DB::table('order_items')
        //     ->having('account_id', '>', 100)
        //     ->latest()
        //     ->get();

        $price = DB::table('order_items')
            ->avg('price');

        return view('adminHome', [
            'users' => $users,
            'categories' => $categories,
            'orders' => $orders,
            'order_items' => $order_items,
            'users_count' => $users_count,
            'products_count' => $products_count,
            'orders_count_today' => $orders_count_today,
            'products_count_low' => $products_count_low,
            'earned_month' => $earned_month,
            'dayTerm' => $dayTerm,

        ]);
    }
}
