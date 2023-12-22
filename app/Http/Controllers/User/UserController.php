<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home(){
        $pizza = Product::get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }
    //password change page
    public function changePasswordPage(){
        return view('user.password.change');
    }
    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        $dbHashValue = $user->password;
        if(Hash::check($request->oldPassword , $dbHashValue)){
           User::where('id',Auth::user()->id)->update([
              'password' => Hash::make($request->newPassword)
           ]);
           return back()->with(['changePassword' => 'Change Password SuccessFully']);
        }
        return back()->with(['notMatch' => 'The Old Password Not Match. Try Again!']);
       }
       //user account change page
       public function accountChangePage(){
        return view('user.profile.account');
       }
       //account change
       public function accountChange($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);
        //for image
        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return back()->with(['updateProfileSuccess' => 'Profile Update SuccessFully']);
       }
       //filter pizza
       public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
       }
       //pizzaDetails
       public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
       }
       //cart list
       public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('carts.user_id',Auth::user()->id)
        ->get();
        $totalPrice = 0;
        foreach($cartList as $c){
          $totalPrice += $c->pizza_price * $c->qty;
        }
        return view('user.main.cart',compact('cartList','totalPrice'));
       }
    //password validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
          'oldPassword' => 'required' ,
          'newPassword' => 'required|min:5|max:15' ,
          'confirmPassword' => 'required|min:5|max:15|same:newPassword' ,
        ])->validate();
    }
    //history
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.main.history',compact('order'));
    }
     //accound validation
     private function accountValidationCheck($request){
        Validator::make($request->all(),[
          'name' => 'required' ,
          'email' => 'required' ,
          'gender' => 'required' ,
          'phone' => 'required' ,
          'image' => 'mimes:png,jpg,jpeg,webp|file' ,
          'address' => 'required' ,
        ])->validate();
    }
    private function getUserData($request){
        return [
           'name' => $request->name ,
           'email' => $request->email ,
           'gender' => $request->gender ,
           'phone' => $request->phone ,
           'address' => $request->address ,
        ];
    }
}
