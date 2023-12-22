<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // category list page
    public function list(){
        $categories = Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })
        ->orderby('id','desc')->paginate(5);
        $categories->appends(request()->all()); //append
        return view('admin.category.list',compact('categories'));
    }
    // category create page
    public function createPage(){
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess'=> 'Category Create . . .']);
    }

    //delete
    public function delete($id){
      Category::where('id',$id)->delete();
      return back()->with(['deleteSuccess'=>'Category Deleted . . .']);
    }

    //edit
    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess'=> 'Category Update . . .']);
    }

    //category validation
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
          'categoryName' => 'required|min:3|unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    //request category data
    private function requestCategoryData($request){
         return [
            'name' => $request->categoryName
         ];
    }
}
