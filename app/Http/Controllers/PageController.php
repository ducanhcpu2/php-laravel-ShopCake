<?php

namespace App\Http\Controllers;
use App\Slide;
use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
use Session;
use App\Cart;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Auth;
class PageController extends Controller
{
    public function getIndex(){
    	$slide = Slide::all();
    	//var_dump($slide);
    	//print_r($slide);
    	//exit;	
    	//cach 2 return view('page.trangchu',['slide'=>$slide]);
    	$new_product = Product::where('new',1)->paginate(4);
    	$sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(8);

    	//dd($new_product);
    	return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
    }
    
    public function getLoaiSp($type){
    	$sp_theoloai = Product::where('id_type',$type)->paginate(4);
    	$sp_khac = Product::where('id_type','<>',$type)->paginate(6);
    	$loai = ProductType::all();
    	$loai_sp = ProductType::where('id',$type)->first();
    	return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));	
    }

    public function getChitiet(Request $req){
    	$sanpham= Product::where('id',$req->id)->first();
    	$sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(6);
        $new_product = Product::where('new',1)->paginate(4);
    	return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu','new_product'));
    }
    public function getLienHe(){
    	return view('page.lienhe');
    }
    public function getGioiThieu(){
    	return view('page.gioithieu');
    }
    public function AddtoCart(Request $req,$id){
        $product = Product::find($id);
        $oldCart = Session('cart')?session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart-> add($product,$id);
        $req->Session()->put('cart',$cart);

        return redirect()->back();

    }
    public function DellCart($id){
        $oldCart = Session('cart')?session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) >0){
            Session::put('cart',$cart);
        }
        else
        {
            session::forget('cart');
        }
        return redirect()->back();
    }
    public function getCheckout(){
        if(session::has('cart')){
            $oldCart = Session('cart')?session::get('cart'):null;
            $cart = new Cart($oldCart);
            return view('page.dat_hang',['product_cart'=>$cart->items,
                'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
        }
        else
            {
                return view('page.dat_hang');
            }
    }
    public function postCheckout(Request $req){
        $cart = session::get('cart');
        //lưu thông tin nhập vào database bằng cách request lên server
        $customer =new Customer;
        $customer->name=$req->name;
        $customer->gender=$req->gender;
        $customer->email=$req->email;
        $customer->address=$req->address;
        $customer->phone_number=$req->phone;
        $customer->note=$req->notes;
        $customer->save();
        //tiếp theo là lưu thông tin vào hóa đơn
        $bill= new Bill;
        $bill->id_customer=$customer->id;
        $bill->date_order=date('y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$req->payment_method;
        $bill->note=$req->notes;
        $bill->save();

        foreach($cart->items as $key=>$value){
            $bill_detail = new BillDetail;
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$key;
            $bill_detail->quantity=$value['qty'];
            $bill_detail->unit_price= ($value['price']/$value['qty']);
            $bill_detail->save();
        }
    session::forget('cart');
    return redirect()->back()->with('thongbao','đặt hàng thành công');
    
    }

    public function getDangNhap(){
        return view('page.dangnhap');
    }

    public function getDangKy(){
        return view('page.dangky');
    }

    public function postDangKy(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.email'=>'không đúng định dang email',
                'email.required'=>'vui lòng nhập lại email',
                'email.unique'=>'email đã có người sử dụng',
                'password.required'=>'vui lòng nhập password',
                're_password.same'=>'mật khẩu không trùng,vui lòng nhập lại',
                'password.min'=>'mật khẩu ít nhất 6 ký tự'
            ]

        );
        $user = new User;
        $user->full_name= $req->fullname;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->phone=$req->phone;
        $user->address=$req->address;
        $user->save();
        return redirect()->back()->with('thanhcong','đã tạo tài khoản thành công ');
    }

    public function postDangNhap(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email|',
                'password'=>'required|min:6|max:20',
            ],
            [
                'email.email'=>'không đúng định dang email',
                'email.required'=>'vui lòng nhập lại email',
                'email.unique'=>'email đã có người sử dụng',
                'password.required'=>'vui lòng nhập password',
                'password.min'=>'mật khẩu ít nhất 6 ký tự',
                'password.max'=>'mật khẩu không quá 10 ký tự'
            ]
        );
        $user = array('email'=>$req->email,'password'=>$req->password);
        // if(Auth::Attempt($user)){
        //     return redirect()->back()->with(['flag'=>'success','notification'=>'bạn đã đăng nhập thành công']);
        // }else
        // {
        //     return redirect()->back()->with(['flag'=>'danger','notification'=>'bạn đã đăng nhập không thành công']);
        // }
        
        if(Auth::Attempt($user)){
            return redirect()->route('trang-chu');
        }else
        {
            return redirect()->back()->with(['flag'=>'danger','notification'=>'bạn đã đăng nhập không thành công']);
        }
    }

    public function getDangXuat(Request $req){
        Auth::logout();
        return redirect()->route('trang-chu');
    }

    public function getTimkiem(Request $req){
        $product = Product::Where('name','like','%'.$req->key.'%')->orWhere('unit_price',$req->key)->get();
        return view('page.search',compact('product'));
    }
}
