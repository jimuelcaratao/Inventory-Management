<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
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
        $brands = DB::table('brands')->get();

        $tableBrands = Brand::all();

        if ($tableBrands->isEmpty()) {
            $brands = DB::table('brands')->paginate();
        } else {
            // ienumerable
            $brands = DB::table('brands');

            // search validation
            $search = Brand::where('brand_id', 'like', '%' . request()->search . '%')
                ->OrWhere('brand_name', 'like', '%' . request()->search . '%')
                ->first();


            if ($search === null) {
                return redirect('brands')->with('danger', 'Invalid Search');
            } else {
                $brands = $brands->where('brand_id', 'like', '%' . request()->search . '%')
                    ->OrWhere('brand_name', 'like', '%' . request()->search . '%')
                    ->latest()
                    ->paginate(10);
            }
        }
        return view('brands', ['users' => $users, 'brands' => $brands]);
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
            'inputBrandName' => 'required'
        ]);

        $data = new \DateTime();
        try {
            DB::table('brands')->insert(
                [
                    'brand_id' => $request->input('inputID'),
                    'brand_name' => $request->input('inputBrandName'),
                    'status' => $request->input('inputStatus'),
                    'created_at' => $data
                ]
            );
            return redirect('brands')->with('success', 'Sucessfully added!');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('brands')->with('danger', 'Invalid');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $data = new \DateTime();
        DB::table('brands')
            ->where('brand_id', $request->input('editID'))
            ->update(
                [
                    'brand_name' => $request->input('editBrandName'),
                    'status' => $request->input('editStatus'),
                    'updated_at' => $data
                ]
            );
        return redirect('brands')->with('success', ' ' . $request->input('editID') . ' Sucessfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($brand_id)
    {
        Brand::destroy($brand_id);
        return redirect('brands')->with('success', 'Sucessfully Deleted!');
    }
}
