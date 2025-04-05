<?php
namespace App\Controllers;

use App\Controllers\Admin\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Variant;

class HomeController {
    public function index(){
        $products =  Product::select(['products.*','categories.category_name as cate_name'])
        ->join('categories','categories.id', 'products.category_id')
        ->limit(4)
        ->get();
        return view('Client.home',compact(var_name: 'products'));
    }
    public function sanpham(){
     $products = Product::select(['products.*','categories.category_name as cate_name'])
     ->join('categories','categories.id','products.category_id')
     ->get();
     return view('Client.sanpham',compact('products'));
    }
    public function chitiet($id){
        $product=Product::find($id);
        $products=Product::select(['products.*','categories.category_name as cate_name'])
        ->join('categories','categories.id','products.category_id')
        ->where('category_id','=',$product->category_id)
        ->andWhere('id','!=',$product->id)
        ->get();
        $category= Category::find($product->category_id);
        $product_variants=Product_Variant::where('product_id','=', $product->id)->get();
        return view('Client.chitiet',compact('product','category','product_variants','products'));
    }
    public function timkiem(){
        $query = trim($_GET['query'] ?? '');
        $products = Product::where('product_name','LIKE','%'.''.$query.'%')
        ->get();
        $message = '';
        if($query !=''){
            $message = 'Kết quả tìm kiếm cho từ khóa: '.$query;
            if(count($products)==0){
                $message ='không tìm thấy kết quả cho từ khóa: '.$query;
            }
        }else{
            $message = 'Vui lòng nhập từ khóa tìm kiếm';
        }
        return view ('Client.sanpham',compact('products','message'));
    }

    // public function sanphamTheoDanhMuc($id){
    //     $product=Product::find($id);
    //     $products=Product::select(['products.*','categories.category_name as cate_name'])
    //     ->join('categories','categories.id','products.category_id')
    //     ->where('products.category_id','=',$id)
    //     ->get();
    //     return view('Client.chitiet',compact('products'));
    // }
    
}