<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
    //changePassword
    public function changePassword(Request $request){
     $this->passwordValidationCheck($request);
     $currentUserId = Auth::user()->id;
     $user = User::select('password')->where('id',$currentUserId)->first();
     $dbHashValue = $user->password;
     if(Hash::check($request->oldPassword , $dbHashValue)){
        User::where('id',Auth::user()->id)->update([
           'password' => Hash::make($request->newPassword)
        ]);
        return redirect()->route('category#list')->with(['changePassword' => 'Change Password SuccessFully']);
     }
     return back()->with(['notMatch' => 'The Old Password Not Match. Try Again!']);
    }

    //account detail
    public function details(){
        return view('admin.account.details');
    }
    //edit profile page
    public function edit(){
        return view('admin.account.edit');
    }
    //update profile
    public function update($id,Request $request){
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
    return redirect()->route('category#list')->with(['updateProfileSuccess' => 'Profile Update SuccessFully']);
    }

    //admin list
    public function list(){
        $admin = User::when(request('key'),function($query){
           $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
        })->paginate(4);
        $admin->appends(request()->all()); //append
        return view('admin.account.list',compact('admin'));
    }
    //delete acc
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Admin Account Delete SuccessFully']);
    }
    //change role
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }
    public function change($id, Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //change
    public function changeUserAdmin(Request $request){
       User::where('id',$request->adminId)->update([
            'role' => $request->role ,
       ]);
    }

    //request user data

    private function requestUserData($request){
        return [
            'role' => $request->role
        ];
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

    //password validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
          'oldPassword' => 'required' ,
          'newPassword' => 'required|min:5|max:15' ,
          'confirmPassword' => 'required|min:5|max:15|same:newPassword' ,
        ])->validate();
    }
}
