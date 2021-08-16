<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;

class PublicController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->paginate(10, [
            'id',
            'name',
            'status'
        ]);

        $products = Product::with('category')
            ->where('status', 1)
            ->paginate(10);

        return view('public.product-list', compact(['categories', 'products']));
    }

    public function getProductsByCategory($id)
    {
        if ($id == 'all') {
            $products = Product::with('category')
                ->where('status', 1)
                ->get();
        } else {
            $products = Product::with('category')
                ->where('status', 1)
                ->where('category_id', $id)
                ->get();
        }
        return $this->sendResponse($products, 'success');
    }
}
