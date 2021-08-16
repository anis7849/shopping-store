<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $products = Product::with(['category'])
            ->where('status', 1)->paginate(10);

        // echo '<pre>';print_r($products);die;

        return view('admin.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', '1')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('categories')->where(function ($query) {
                    return $query->where('status', '1');
                }),
            ],
            'description' => [
                'required'
            ],
            'category_id' => [
                'required'
            ],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
        }

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = '/storage/' . $path;
        $product->category_id = $request->category_id;

        $product->save();
        if ($product) {
            return redirect(route('products.index'))->with('success', 'product added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('status', '1')->get();
        $product = Product::with(['category'])
            ->find($id);
        // echo '<pre>';print_r($product);die;
        return view('admin.product.edit', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => [
                'required'
            ],
            'description' => [
                'required'
            ],
            'category_id' => [
                'required'
            ]
        ]);

        $path = "";
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
        }

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        if ($path != '') {
            $product->image = '/storage/' . $path;
        }
        $product->save();

        return redirect(route('products.index'))->with('success', 'product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id', $id)->update(['status' => 0]);
        return redirect()->back()->with('success', 'product deleted successfully');
    }
}
