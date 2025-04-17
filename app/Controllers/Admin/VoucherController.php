<?php
namespace App\Controllers\Admin;
use App\Models\Voucher;
use eftec\bladeone\BladeOne;
use App\Services\Authorization;

class VoucherController {
    public function index(){
        $vouchers = Voucher::all();
        return view("Admin.voucher.list",compact("vouchers"));
    }
    public function edit($id){
        $voucher = Voucher::find($id);
         
        return view('Admin.voucher.edit',compact('voucher'));
    }
    public function update($id){
        $data= $_POST;
        Voucher::update($data,$id);
        $vouchers = Voucher::find($id);
        return redirect('admin/vouchers');
    }

    public function search(){
        $id=trim($_GET['id'] ?? '');
        $type=trim($_GET['type'] ?? '');
        $status=trim($_GET['status'] ?? '');

        $hasWhere=false;
        $vouchers=null;

        if($id !== ''){
            $vouchers = Voucher::where('id','=',$id);
            $hasWhere=true;
        }

        if($type !== ''){
            if($hasWhere){
                $vouchers->andWhere('discount_type','=',$type);
            }else{
                $vouchers=Voucher::where('discount_type','=',$type);
                $hasWhere=true;
            }
        }

        if($status !== ''){
            if($hasWhere){
                $vouchers->andWhere('status','=',$status);
            }else{
                $vouchers=Voucher::where('status','=',$status);
                $hasWhere=true;
            }
        }

        if(!$hasWhere){
            $vouchers=Voucher::all();
        }else{
            $vouchers=$vouchers->get();
        }
        return view("Admin.voucher.list",compact('vouchers'));
    }

    public function detail($id){
        $voucher =  Voucher::select(['discounts.*'])
        ->where('id', '=', $id)
        ->first();
        // echo $user->getSql();
        // exit;

        $views = __DIR__."/../../views";
        $cache = __DIR__."/../../cache";
        $blade =  new BladeOne($views, $cache, BladeOne::MODE_AUTO);
        return $blade->run("Admin.voucher.detail", compact("voucher"));
    }
  
    public function destroy($id){
        if(!Authorization::can('delete_any')){
            header('HTTP/1.1 403 Forbidden');
            echo "<script>alert('Bạn không có quyền xóa voucher!'); window.history.back();</script>";
            exit;
        }
        Voucher::delete($id);
        return redirect("admin/vouchers");
     }
}