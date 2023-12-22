<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
           $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(4);
        $pizzas->appends(request()->all()); //append
        return view('admin.product.pizzaList',compact('pizzas'));
    }
    //pizza create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }
    //create
    public function create(Request $request){
        $this->productValidationCheck($request,'create');
        $data = $this->requestProductInfo($request);

        //image
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;


        Product::create($data);
        return redirect()->route('product#list');
    }

    //delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product Delete Success . . .']);
    }
    //edit
    public function edit($id){
        $pizza = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizza'));
    }

    //updatepage
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }
    //update
    public function update(Request $request){
      $this->productValidationCheck($request,'update');
      $data = $this->requestProductInfo($request);
      if($request->hasFile('pizzaImage')){
        $oldImageName = Product::where('id',$request->pizzaId)->first();
        $oldImageName = $oldImageName->image;
        if($oldImageName != null){
            Storage::delete('public/'.$oldImageName);
        }
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;
      }
      Product::where('id',$request->pizzaId)->update($data);
      return redirect()->route('product#list')->with(['updateSuccess'=> 'Pizza Update SuccessFully. . .']);
    }

    //data product info
    private function requestProductInfo($request){
        return [
         'category_id' => $request->pizzaCategory ,
         'name' => $request->pizzaName ,
         'description' => $request->pizzaDescription ,
         'price' => $request->pizzaPrice ,
         'waiting_time' => $request->pizzaWaiting,
        ];
    }

    //validation check
    private function productValidationCheck($request,$action){
        $validatationRules = [
           'pizzaName' => 'required|min:4|unique:products,name,'.$request->pizzaId,
           'pizzaCategory' => 'required',
           'pizzaDescription' => 'required|min:8',
           'pizzaPrice' => 'required',
           'pizzaWaiting' => 'required',
        ];
        $validatationRules['pizzaImage'] = $action == 'create' ? 'required|mimes:png,jpg,jpeg,webp|file' : 'mimes:png,jpg,jpeg,webp|file' ;
        Validator::make($request->all(),$validatationRules)->validate();
    }
}
