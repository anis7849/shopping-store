<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Category;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('status', '1')
        ->get();
        return $this->sendResponse($products, 'success');
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
        $validator = Validator::make($request->all(),[
            'name' => [
                'required',
                Rule::unique('products')->where(function ($query) {
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

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->sendError($error, null, 422);
        }

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
            return $this->sendResponse($product, 'success');
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
        $product = Product::with(['category'])
        ->find($id);
        return $this->sendResponse($product, 'success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $validator = Validator::make($request->all(),[
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

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->sendError($error, null, 422);
        }
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
        if ($product) {
            return $this->sendResponse($product, 'success');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->status = '0';
        $product->save();
        if ($product) {
            return $this->sendResponse(null, "Success");
        }
    }
}
