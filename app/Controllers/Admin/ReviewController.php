<?php
namespace App\Controllers\Admin;
use App\Models\Review;
use eftec\bladeone\BladeOne;
class ReviewController {
    public function index(){
        $reviews = Review::select(['reviews.*','products.*','users.*'])
        ->join('products','products.id', 'reviews.product_id')
        ->join('users','users.id', 'reviews.user_id')
        ->get();
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
        $rating=trim($_GET['price_min'] ?? '');
        $product=trim($_GET['price_max'] ?? '');
        $status=trim($_GET['status'] ?? '');

        $hasWhere=false;
        $reviews=null;

        if($query !== ''){
            $reviews = Review::where('full_name','LIKE',"%$query%");
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
                $reviews->andWhere('product_name','=',$product);
            }else{
                $reviews=Review::where('product_name','=',$product);
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
        // echo $user->getSql();
        // exit;

        $views = __DIR__."/../../views";
        $cache = __DIR__."/../../cache";
        $blade =  new BladeOne($views, $cache, BladeOne::MODE_AUTO);
        return $blade->run("Admin.review.detail", compact("review"));
    }
  
}