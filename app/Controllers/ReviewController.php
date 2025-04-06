<?php
namespace App\Controllers;

use App\Models\Review;
class ReviewController {
    public function store(){
        if(!isset($_SESSION['user'])){
            return redirect('login');
        }   
        $data=$_POST;
        // if(trim($data['review_text']=="")){
        //     echo"khong duoc de trong binh luan";
        // }
        Review::create([
            'user_id'=>$_SESSION['user']->id,
            'product_id'=>$data['product_id'],
            'rating'=>$data['rating'],
            'review_text'=>$data['review_text'],
            'created_at'=>date('Y-m-d H:i:s')
        ]);
return redirect('sanpham/chitiet/'.$data['product_id']);
}
}