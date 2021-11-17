<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductAttributeValue;
use App\CategoryTranslation;
use App\Category;

class HomeController extends Controller
{
    /**
    Index Base Function
    */
    public function index()
    {
        $sale_products = ProductAttributeValue::where('attribute_id', 13)->where('float_value','!=','')->with('product.ratings','product.images','product.attributes')->get();
        $ages = Category::where('parent_id',2)->with('transalation')->get();
        $categories = Category::where('parent_id',5)->with('transalation')->get();
        $products = ProductAttributeValue::where('attribute_id', 11)->where('float_value','!=','')->with('product.ratings','product.images','product.attributes')->get();
        //return $products;
        return view('home', compact('sale_products','ages','categories','products'));
    }
}