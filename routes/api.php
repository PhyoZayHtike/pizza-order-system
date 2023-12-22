<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']); //read

//post
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/contact',[RouteController::class,'createContact']); //create
Route::post('contact/delete',[RouteController::class,'contactDelete']); //delete

Route::get('contact/details/{id}',[RouteController::class,'contactDetails']);

//update
Route::post('contact/update',[RouteController::class,'contactUpdate']);
