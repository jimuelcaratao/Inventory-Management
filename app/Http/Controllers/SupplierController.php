<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SupplierController extends Controller
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
        $supplierCollection = Supplier::all();

        if ($supplierCollection->isEmpty()) {
            $suppliers = DB::table('suppliers')->paginate();
        } else {
            // ienumerable
            $suppliers = DB::table('suppliers');

            // search validation
            $search = Supplier::where('supplier_id', 'like', '%' . request()->search . '%')
                ->OrWhere('company_name', 'like', '%' . request()->search . '%')
                ->first();

            if ($search === null) {
                return redirect('suppliers')->with('danger', 'Invalid Search');
            } else {
                $suppliers = $suppliers->where('supplier_id', 'like', '%' . request()->search . '%')
                    ->OrWhere('company_name', 'like', '%' . request()->search . '%')
                    ->latest()
                    ->paginate(10);
            }
        }
        return view('suppliers', ['suppliers' => $suppliers]);
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
        $this->validate($request, [
            'inputID' => 'required|max:255',
            'inputCompanyName' => 'required|max:255',
            'inputAddress' => 'required'
        ]);

        // return redirect('product')->with('succes','Data saved');
        $data = new \DateTime();
        try {
            DB::table('suppliers')->insert(
                [
                    'supplier_id' => $request->input('inputID'),
                    'company_name' => $request->input('inputCompanyName'),
                    'address' => $request->input('inputAddress'),
                    'contact' => $request->input('inputContact'),
                    'status' => $request->input('inputStatus'),
                    'created_at' => $data
                ]
            );
            return redirect('suppliers')->with('success', 'Sucessfully added!');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('suppliers')->with('danger', 'Invalid');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data = new \DateTime();
        DB::table('suppliers')
            ->where('supplier_id', $request->input('editID'))
            ->update(
                [
                    'company_name' => $request->input('editCompanyName'),
                    'address' => $request->input('editAddress'),
                    'contact' => $request->input('editContact'),
                    'status' => $request->input('editStatus'),
                    'updated_at' => $data
                ]
            );
        return redirect('suppliers')->with('success', ' ' . $request->input('editID') . ' Sucessfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($supplier_id)
    {
        Supplier::destroy($supplier_id);
        return redirect('suppliers')->with('success', 'Sucessfully Deleted!');
    }
}
