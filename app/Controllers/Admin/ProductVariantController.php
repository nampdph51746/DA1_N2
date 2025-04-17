<?php
namespace App\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use eftec\bladeone\BladeOne;
use App\Models\Product_Variant;
use App\Services\Authorization;

class ProductVariantController {
    public function create($id){
        $product = Product::find($id);
        // dd($product);
        return view("Admin.product_variant.create",compact( "product"));
    }
    public function store(){
        $data= $_POST;
        // if(!isset($data['product_id']) || empty($data['product_id'])){
        //     return redirect("admin/products/detail")->back()->with('error', 'Vui lòng chọn sản phẩm muốn thêm biến thể.');
        // }
        $image="";
        $file=$_FILES['image_url'];
        if($file['size']>0){
            $image="images/".$file['name'];
            move_uploaded_file($file['tmp_name'], $image);
        }
        $data['image_url']=$image;
        
        Product_Variant::create($data);
        return redirect("admin/products/detail/{$data['product_id']}");
    }
    public function edit($id){
        $product_variant = Product_Variant::find($id);
        $product = Product::find($id);
        return view("Admin.product_variant.edit",compact("product_variant", "product"));
    }
    public function update($id){
        $product_variant = Product_Variant::find($id);
        $data= $_POST;
        $file = $_FILES["image_url"];
        if($file['size']>0){
            $image="images/".$file['name'];
            move_uploaded_file($file['tmp_name'], $image);
            $data['image_url']=$image;
        }
        if($file['size']>0){
            if(file_exists($product_variant->image_url) && $image != $product_variant->image_url){
                unlink($product_variant->image_url);
            }
        }
        Product_Variant::update($data,$id);
        return redirect("admin/products/detail/{$data['product_id']}");
    }

    public function destroy($id){
        if(!Authorization::can('delete_any')){
            header('HTTP/1.1 403 Forbidden');
            echo "<script>alert('Bạn không có quyền xóa biến thể!'); window.history.back();</script>";
            exit;
        }
       Product_Variant::delete($id);
       return redirect("admin/products");
    }
}
