@extends('admin.layouts.master')
<style>
    hr.sty{
        border: 1px solid black;
    }
</style>
@section('title','Category List')
@section('content')
{{-- main content --}}
<div class="main-content mt-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                            <a class="text-dark" href="{{route('product#list')}}">
                                <i style="cursor: pointer" class="fa-solid fa-arrow-left ms-3 fs-2"></i>
                            </a>
                        <div class="card-title">
                            <h3 class="text-center title-2">Update Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <img class="rounded shadow-sm" src="{{asset('storage/'.$pizza->image)}}" alt="Pizza" />
                                    <div class="mt-3">
                                        <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror" id="">
                                        @error('pizzaImage')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-dark text-white col-12"><i class="fa-solid fa-circle-right fa-shake me-2"></i>Update Your Pizza</button>
                                    </div>
                                </div>
                                <div class="row col-6">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="pizzaName" type="text" value="{{old('pizzaName',$pizza->name)}}"  class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name">
                                        @error('pizzaName')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Description" aria-required="true" aria-invalid="false" id=""  rows="2">{{old('pizzaDescription',$pizza->description)}}</textarea>
                                        @error('pizzaDescription')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="pizzaPrice" type="number" value="{{old('pizzaPrice',$pizza->price)}}"  class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="$">
                                        @error('pizzaPrice')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" name="pizzaCategory" id="">
                                          <option value="">Choose Category . . .</option>
                                          @foreach ($category as $c)
                                            <option value="{{$c->id}}"@if ($pizza->category_id == $c->id) selected @endif>{{$c->name}}</option>
                                          @endforeach
                                        </select>
                                        @error('pizzaCategory')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                        <input id="cc-pament" name="pizzaWaiting" type="number" value="{{old('pizzaWaiting',$pizza->waiting_time)}}"  class="form-control @error('pizzaWaiting') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time">
                                        @error('pizzaWaiting')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">View Count</label>
                                        <input id="cc-pament" name="viewCount" disabled type="number" value="{{old('viewCount',$pizza->view_count)}}"  class="form-control" aria-required="true" aria-invalid="false" placeholder="View Count">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--end main content --}}
@endsection
