<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class RouteController extends Controller
{
    // get all product list
    public function productList(){
        $product = Product::get();
        $user = User::get();
        $order = Order::get();
        $contact = Contact::get();

        $data = [
            'product' => $product ,
            'user' => $user ,
            'order' => $order ,
            'contact' => $contact ,
        ];
       return response()->json($data , 200);
    }

    public function categoryList(){
        $category = Category::orderBy('id','desc')->get();
        return response()->json($category, 200);
    }

    //createCategory
    public function createCategory(Request $request){
    //   dd($request->header('headerData'));
    //   dd($request->all());
    $data = [
        'name' => $request->name,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
      $response = Category::create($data);
      return response()->json($response ,200);
    }

    //createContact
    public function createContact(Request $request){
      $data = [
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
      ];
      $response = Contact::create($data);
      return response()->json($response ,200);
    }
    //createDelete
    public function contactDelete(Request $request){
       $data = Contact::where('id',$request->contact_id)->first();
       if(isset($data)){
        Contact::where('id',$request->contact_id)->delete();
        return response()->json(['status' => true , 'message' => 'success delete'] ,200);
       }
       return response()->json(['status' => false , 'message' => 'fail! delete'] ,200);
    }

    public function contactDetails($id){
        $data = Contact::where('id',$id)->first();
        if(isset($data)){
         return response()->json(['status' => true , 'message' => $data] ,200);
        }
        return response()->json(['status' => false , 'message' => 'fail!'] ,200);
    }
    //contactUpdate
    public function contactUpdate(Request $request){
        $contactId = $request->contact_id;
        $dbSource = Contact::where('id',$contactId)->first();
        if(isset($dbSource)){
            $data = $this->getContactData($request);
           $response = Contact::where('id',$contactId)->update($data);
         return response()->json(['status' => true , 'message' => 'update success . . .' , 'contact' => $response] ,200);
        }
        return response()->json(['status' => false , 'message' => 'No data!'] ,500);
    }
    //get data
    private function getContactData($request){
        return [
        'message' => $request->message,
        ];
    }
}
