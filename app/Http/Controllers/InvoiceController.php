<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $invoices = DB::table('invoices')->get();

        $tableInvoices = Invoice::all();

        if ($tableInvoices->isEmpty()) {
            $invoices = DB::table('invoices')->paginate();
        } else {
            // ienumerable
            $invoices = DB::table('invoices');

            // search validation
            $search = Invoice::where('invoice_id', 'like', '%' . request()->search . '%')
                ->OrWhere('status', 'like', '%' . request()->search . '%')
                ->first();


            if ($search === null) {
                return redirect('invoices')->with('danger', 'Invalid Search');
            } else {
                $invoices = $invoices->where('invoice_id', 'like', '%' . request()->search . '%')
                    ->OrWhere('status', 'like', '%' . request()->search . '%')
                    ->latest()
                    ->paginate(10);
            }
        }
        return view('invoices', ['users' => $users, 'invoices' => $invoices]);
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
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoice_id)
    {
        Invoice::destroy($invoice_id);
        return redirect('invoices')->with('success', 'Sucessfully Deleted!');
    }
}
