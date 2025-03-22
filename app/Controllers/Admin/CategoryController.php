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
}