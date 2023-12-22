<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function customerService(Request $request){
       $this->customerMessageValidation($request);
       Contact::create([
         'name' => $request->name,
         'email' => $request->email,
         'message' => $request->message,
       ]);
       return back()->with(['sendMessage'=>'Message Send Success . . .']);
    }

    public function customerMessage(){
        $data = Contact::when(request('key'),function($query){
            $query
            ->orWhere('name','like','%'.request('key').'%')
            ->orWhere('email','like','%'.request('key').'%');
        })
        ->orderBy('created_at','desc')->paginate(5);
        $data->appends(request()->all());
        return view('admin.contact.contact',compact('data'));
    }

    //delete
    public function customerMessageDelete($id){
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Message Deleted . . .']);
    }
    //validation
    private function customerMessageValidation($request){
        Validator::make($request->all(), [
            "name"=> "required",
            "email"=> "required|email",
            "message"=> "required",
        ])->validate();
    }
}
