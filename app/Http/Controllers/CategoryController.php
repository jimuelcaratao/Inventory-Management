<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class CategoryController extends Controller
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
        $categories = DB::table('categories')->get();

        $tableCategories = Category::all();

        if ($tableCategories->isEmpty()) {
            $categories = DB::table('categories')->paginate();
        } else {
            // ienumerable
            $categories = DB::table('categories');

            // search validation
            $search = Category::where('category_id', 'like', '%' . request()->search . '%')
                ->OrWhere('category_name', 'like', '%' . request()->search . '%')
                ->first();


            if ($search === null) {
                return redirect('categories')->with('danger', 'Invalid Search');
            } else {
                $categories = $categories->where('category_id', 'like', '%' . request()->search . '%')
                    ->OrWhere('category_name', 'like', '%' . request()->search . '%')
                    ->latest()
                    ->paginate(10);
            }
        }
        return view('categories', ['users' => $users, 'categories' => $categories]);
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
            'inputCategoryName' => 'required'
        ]);

        $data = new \DateTime();
        try {
            DB::table('categories')->insert(
                [
                    'category_id' => $request->input('inputID'),
                    'category_name' => $request->input('inputCategoryName'),
                    'status' => $request->input('inputStatus'),
                    'created_at' => $data
                ]
            );
            return redirect('categories')->with('success', 'Sucessfully added!');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect('categories')->with('danger', 'Invalid');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, $CategoryID)
    {
        // for category view product
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = new \DateTime();
        DB::table('categories')
            ->where('category_id', $request->input('editID'))
            ->update(
                [
                    'category_name' => $request->input('editCategoryName'),
                    'status' => $request->input('editStatus'),
                    'updated_at' => $data
                ]
            );
        return redirect('categories')->with('success', ' ' . $request->input('editID') . ' Sucessfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id)
    {
        Category::destroy($category_id);
        return redirect('categories')->with('success', 'Sucessfully Deleted!');
    }
}
