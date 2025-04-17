<?php
namespace App\Controllers\Admin;
use App\Models\Review;
use eftec\bladeone\BladeOne;
use App\Services\Authorization;

class ReviewController {
    public function index(){
        $reviews = Review::select([
            'reviews.id as review_id',
            'reviews.product_id',
            'reviews.user_id',
            'reviews.rating',
            'reviews.review_text',
            'reviews.review_status',
            'reviews.created_at',
            'reviews.updated_at',
            'products.*',
            'users.*'])
        ->join('products','products.id', 'reviews.product_id')
        ->join('users','users.id', 'reviews.user_id')
        ->get();
        // echo $reviews->getSql();
        // exit;
        return view("Admin.review.list",compact("reviews"));
    }
    public function edit($id){
        $review = Review::find($id);
         
        return view('Admin.review.edit',compact('review'));
    }
    public function update($id){
        $data= $_POST;
        Review::update($data,$id);
        $reviews = Review::find($id);
        return redirect('admin/reviews');
    }

    public function search(){
        $query=trim($_GET['name'] ?? '');
        $id=trim($_GET['id'] ?? '');
        $rating=trim($_GET['rating'] ?? '');
        $product=trim($_GET['product_name'] ?? '');
        $status=trim($_GET['status'] ?? '');

        $reviews = Review::select(['reviews.*','products.product_name','users.full_name'])
        ->join('products','products.id', 'reviews.product_id')
        ->join('users','users.id', 'reviews.user_id');

        $hasWhere=false;
        $reviews=null;

        if($query !== ''){
            $reviews = Review::where('users.full_name','LIKE',"%$query%");
            $hasWhere=true;
        }

        if($id !== ''){
            if($hasWhere){
                $reviews->andWhere('id','=',$id);
            }else{
                $reviews=Review::where('id','=',$id);
                $hasWhere=true;
            }
        }

        if($rating !== ''){
            if($hasWhere){
                $reviews->andWhere('rating','=',$rating);
            }else{
                $reviews=Review::where('rating','=',$rating);
                $hasWhere=true;
            }
        }

        if($product !== ''){
            if($hasWhere){
                $reviews->andWhere('products.product_name','LIKE',"%$product%");
            }else{
                $reviews=Review::where('products.product_name','LIKE',"%$product%");
                $hasWhere=true;
            }
        }

        if($status !== ''){
            if($hasWhere){
                $reviews->andWhere('review_status','=',$status);
            }else{
                $reviews=Review::where('review_status','=',$status);
                $hasWhere=true;
            }
        }

        if(!$hasWhere){
            $reviews=Review::all();
        }else{
            $reviews=$reviews->get();
        }
        return view("Admin.review.list",compact('reviews'));
    }

    public function detail($id){
        $review =  Review::select(['reviews.*'])
        ->where('id', '=', $id)
        ->first();
        // echo $review->getSql();
        // exit;

        $views = __DIR__."/../../views";
        $cache = __DIR__."/../../cache";
        $blade =  new BladeOne($views, $cache, BladeOne::MODE_AUTO);
        return $blade->run("Admin.review.detail", compact("review"));
    }
    
    public function destroy($id){
        if(!Authorization::can('delete_any')){
            header('HTTP/1.1 403 Forbidden');
            echo "<script>alert('Bạn không có quyền xóa bình luận!'); window.history.back();</script>";
            exit;
        }
        Review::delete($id);
        return redirect("admin/reviews");
    }

    
}