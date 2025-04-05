<?php
namespace App\Controllers\Admin;
use App\Models\Category;
use App\Models\Product;
class CategoryController {
    public function index(){
        $categories = Category::all();
        return view("Admin.danhmuc.Category",compact("categories"));
    }
    public function create(){
        $categories = Category::all();
        return view("Admin.danhmuc.create",compact("categories"));
    }
    public function store(){
        $data=$_POST;
        Category::create($data);
        return redirect('admin/categories');
    }
    public function edit($id){
        $cate = Category::find($id);
         
        return view('Admin.danhmuc.edit',compact('cate'));
    }
    public function update($id){
        $data= $_POST;
        Category::update($data,$id);
        $category = Category::find($id);
        return redirect('admin/categories');
    }

    public function destroy($id ){
            Category::delete(id: $id );
            return redirect('admin/categories');
    }
    public function search(){
        $query=trim($_GET['name'] ?? '');
        $status=trim($_GET['status'] ?? '');

        $hasWhere=false;
        $categories=null;

        if($query !== ''){
            $categories = Category::where('category_name','LIKE',"%$query%");
            $hasWhere=true;
        }

        if($status !== ''){
            if($hasWhere){
                $categories->andWhere('category_status','=',$status);
            }else{
                $categories=Category::where('category_status','=',$status);
                $hasWhere=true;
            }
        }

        if(!$hasWhere){
            $categories=Category::all();
        }else{
            $categories=$categories->get();
        }
        return view("Admin.danhmuc.Category",compact('categories'));
    }
  
}