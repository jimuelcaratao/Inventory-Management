<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ienumerable
        $invoices = DB::table('orders')->get();

        $tableInvoices = Invoice::all();

        if ($tableInvoices->isEmpty()) {
            $invoices = DB::table('orders')->paginate();
        } else {
            // ienumerable
            $invoices = DB::table('orders');

            // search validation
            $search = Invoice::where('transaction_no', 'like', '%' . request()->search . '%')
                ->OrWhere('status', 'like', '%' . request()->search . '%')
                ->first();


            if ($search === null) {
                return redirect('invoices')->with('danger', 'Invalid Search');
            } else {
                $invoices = $invoices->where('transaction_no', 'like', '%' . request()->search . '%')
                    ->OrWhere('status', 'like', '%' . request()->search . '%')
                    ->latest()
                    ->paginate(10);
            }
        }
        return view('invoices', ['invoices' => $invoices]);
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
    public function destroy($transaction_no)
    {
        Invoice::destroy($transaction_no);
        return redirect('invoices')->with('success', 'Sucessfully Deleted!');
    }
}
