<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View as ViewView;
use PhpParser\NodeVisitor\FirstFindingVisitor;
use Products;

class ProductController extends Controller
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

        // stored in memory
        $categories = Category::where('status', 'available')
            ->orderBy('category_name')
            ->get();
        $brands = DB::table('brands')
            ->where('status', 'available')
            ->orderBy('brand_name')
            ->get();

        $tableProducts = Product::all();

        if ($tableProducts->isEmpty()) {
            $products = DB::table('products')->paginate();
        } else {
            // ienumerable
            $products = DB::table('products');

            // search validation
            $search = Product::where('barcode', 'like', '%' . request()->search . '%')
                ->OrWhere('product_name', 'like', '%' . request()->search . '%')
                ->first();

            $searchAdvance = Product::where('barcode', 'like', '%' . request()->advanceSearch . '%')
                ->OrWhere('product_name', 'like', '%' . request()->advanceSearch . '%')
                ->first();

            if ($search === null) {
                return redirect('products')->with('danger', 'Invalid Search');
            } elseif ($searchAdvance === null) {
                return redirect('products')->with('danger', 'Invalid Search');
            }
            if (!empty(request()->advanceSearch)  ||  !empty(request()->searchBrand) || !empty(request()->searchCategory)) {
                $products = $products->where('product_name', 'LIKE', '%' . request()->advanceSearch .  '%')
                    ->Where('brand', 'LIKE', '%' . request()->searchBrand .  '%')
                    ->Where('category', 'LIKE', '%' . request()->searchCategory .  '%')
                    ->latest()
                    ->paginate(10);
            } else {
                $products = $products->where('barcode', 'like', '%' . request()->search . '%')
                    ->OrWhere('product_name', 'like', '%' . request()->search . '%')
                    ->latest()
                    ->paginate(10);
            }
        }


        return view('products', ['products' => $products, 'categories' => $categories, 'brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 100;
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
            'inputSKU' => 'required|max:255',
            'inputBarcode' => 'required'
        ]);
        // return redirect('product')->with('succes','Data saved');
        $data = new \DateTime();
        try {
            DB::table('products')->insert(
                [
                    'barcode' => $request->input('inputBarcode'),
                    'sku' => $request->input('inputSKU'),
                    'product_name' => $request->input('inputProductName'),
                    'description' => $request->input('inputDescription'),
                    'category' => $request->input('inputCategory'),
                    'brand' => $request->input('inputBrand'),
                    'stock' => $request->input('inputStock'),
                    'price' => $request->input('inputPrice'),
                    'created_at' => $data
                ]
            );
            return redirect('products')->with('success', 'Sucessfully added!');
            // Closures include ->first(), ->get(), ->pluck(), etc.
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('products')->with('danger', 'Invalid');
            // dd($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($SKU)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $SKU)
    {
        $data = new \DateTime();
        DB::table('products')
            ->where('barcode', $request->input('editBarcode'))
            ->update(
                [
                    'sku' => $request->input('editSKU'),
                    'product_name' => $request->input('editProductName'),
                    'description' => $request->input('editDescription'),
                    'category' => $request->input('editCategory'),
                    'brand' => $request->input('editBrand'),
                    'stock' => $request->input('editStock'),
                    'price' => $request->input('editPrice'),
                    'updated_at' => $data
                ]
            );
        return redirect('products')->with('success', ' ' . $request->input('editBarcode') . ' Sucessfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($barcode)
    {
        Product::destroy($barcode);
        return redirect('products')->with('success', 'Sucessfully Deleted!');
    }
}
