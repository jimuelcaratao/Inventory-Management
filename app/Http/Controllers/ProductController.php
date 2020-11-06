<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        // User Descriptions
        $users = DB::table('users')
            ->join('user_descriptions', 'users.id', '=', 'user_descriptions.user_id')
            ->join('user_photos', 'users.id', '=', 'user_photos.user_id')
            // ->select('users.*', 'user_descriptions.*', 'user_photos.*')
            ->Where('id', 'LIKE', '%' . Auth::user()->id .  '%')
            ->first();

        // stored in memory
        $categories = Category::where('status', 'available')
            ->orderBy('category_name')
            ->get();
        $brands = DB::table('brands')
            ->where('status', 'available')
            ->orderBy('brand_name')
            ->get();

        // $productPhotos = ProductPhoto::where('barcode', '1111z')
        //     ->get();

        $tableProducts = Product::all();

        // var_dump($productPhotos);

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

        return view('products', ['users' => $users, 'products' => $products, 'categories' => $categories, 'brands' => $brands]);
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
    public function store(Request $request, $barcode)
    {
        $this->validate($request, [
            'inputSKU' => 'required|max:255',
            'inputBarcode' => 'required'
        ]);
        // return redirect('product')->with('succes','Data saved');
        $data = new \DateTime();
        /*Insert your data*/
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


            // $images = array();
            // if ($files = $request->file('images')) {
            //     foreach ($files as $file) {
            //         $name = $file->getClientOriginalName();
            //         $file->move('image', $name);
            //         $images[] = $name;
            //     }
            // }
            // ProductPhoto::insert([
            //     'barcode' => $request->input('inputBarcode'),
            //     'photo' =>  implode("|", $images),
            //     //you can put other insertion here
            // ]);


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
