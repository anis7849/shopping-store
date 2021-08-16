<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', '1')
        ->get();
        return $this->sendResponse($categories, 'success');
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
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories')->where(function ($query) {
                    $query->where('status', 1);
                })
            ]
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->sendError($error, null, 422);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->save();
        if ($category) {
            return $this->sendResponse($category, 'success');
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
        $category = Category::find($id);
        return $this->sendResponse($category, 'success');
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
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'max:250',
                Rule::unique('categories')->where(function ($query) {
                    $query->where('status', 1);
                })->ignore($id)
            ]
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->sendError($error, null, 422);
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        if ($category) {
            return $this->sendResponse($category, 'success');
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
        $category = Category::find($id);
        $category->status = '0';
        $category->save();
        if ($category) {
            return $this->sendResponse(null, "Success");
        }
    }
}
