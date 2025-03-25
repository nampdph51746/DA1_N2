<?php
namespace App\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Models\Product_Variant;
use eftec\bladeone\BladeOne;
class ProductController {
    public function index(){
        $products =  Product::select(['products.*','categories.category_name as cate_name'])
        ->join('categories','categories.id', 'products.category_id')
        ->get();
        // echo $products->getSql();
        // exit;
        // var_dump($products);
         return view("Admin.product.list",compact("products"));
    }
    public function create(){
        $categories = Category::all();
        return view("Admin.product.create",compact("categories"));
    }
    public function store(){
        $data= $_POST;
        $image="";
        $file=$_FILES['image_url'];
        if($file['size']>0){
            $image="images/".$file['name'];
            move_uploaded_file($file['tmp_name'], $image);
        }
        $data['image_url']=$image;
        
        Product::create($data);
        return redirect("admin/products");
    }
    public function edit($id){
        $categories = Category::all();
        $product=Product::find($id);
        return view("Admin.product.edit",compact("categories","product"));
    }
    public function update($id){
        $product = Product::find($id);
        $data= $_POST;
        $file = $_FILES["image_url"];
        if($file['size']>0){
            $image="images/".$file['name'];
            move_uploaded_file($file['tmp_name'], $image);
            $data['image_url']=$image;
        }
        if($file['size']>0){
            if(file_exists($product->image_url) && $image != $product->image_url){
                unlink($product->image_url);
            }
        }
        Product::update($data,$id);
        return redirect('admin/products');
    }

    public function destroy($id){
       Product::delete($id);
       return redirect("admin/products");
    }

    public function detail($id){
        $product =  Product::select(['products.*','categories.category_name as cate_name'])
        ->join('categories','categories.id', 'products.category_id')
        // ->where('products.id', '=', $id)
        ->first();
        // echo $product->getSql();
        // exit;
        // var_dump($product);

        $variants = Product_Variant::where('product_id', '=', $id)->get();

        $views = __DIR__."/../../views";
        $cache = __DIR__."/../../cache";
        $blade =  new BladeOne($views, $cache, BladeOne::MODE_AUTO);
        // var_dump($product, $variants);
        return $blade->run("Admin.product.detail", compact("product", "variants"));
    }
    public function search(){
        $query=trim($_GET['query'] ?? '');
        $products = Product::where('product_name','LIKE',"%$query%")->get();
        return view("Admin.product.list",compact("products"));   
    }
}
