<?php
namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;

class HomeController {
    public function index(){
        $products =  Product::select(['products.*','categories.category_name as cate_name'])
        ->join('categories','categories.id', 'products.category_id')
        ->limit(4)
        ->get();
        return view('Client.home',compact(var_name: 'products'));
    }
    public function sanpham(){
        $categories = Category::all();
        $categoryID=$_GET['category_id'] ?? null;
        if($categoryID){
           $products= Product::select(['products.*'])
           ->Where('category_id','=',$categoryID)
           ->get();
        }else{
            $products = Product::select(['products.*','categories.category_name as cate_name'])
            ->join('categories','categories.id','products.category_id')
            ->get();
        };
    
     return view('Client.sanpham',compact('products','categories','categoryID'));
    }
    public function chitiet($id){
        $product=Product::find($id);
        $category= Category::find($product->category_id);
        $reviews = Review::where('product_id','=', $id)->get();
        // lấy riêng thông tin người dùng
        foreach($reviews as $review){
            $review->user = User::find($review->user_id);
        }
        return view('Client.chitiet',compact('product','category','reviews'));
    }
    public function timkiem(){
        $query = trim($_GET['query'] ?? '');
        $categories = Category::all();
        $products = Product::select(['products.*'])
        ->where('product_name','like','%'.$query.'%')
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
        return view ('Client.sanpham',compact('products','message','categories','query'));
    }
}