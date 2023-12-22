@extends('admin.layouts.master')

@section('title','Category List')
@section('content')
{{-- main content --}}
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Add Your Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#create')}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="pizzaName" type="text" value="{{old('pizzaName')}}" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name . . .">
                                @error('pizzaName')
                                 <div class="invalid-feedback">
                                    {{$message}}
                                 </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Category</label>
                                <select class="form-control" name="pizzaCategory" id="">
                                    <option value="">Choose Your Category . . .</option>
                                    @foreach ($categories as $c)
                                    <option value="{{ $c->id}}">{{$c->name}}</option>
                                    @endforeach
                                  </select>
                                  @error('pizzaCategory')
                                      <small class="text-danger">{{$message}}</small>
                                  @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                <textarea name="pizzaDescription" class="form-control  @error('pizzaDescription') is-invalid @enderror" id="cc-payment"  rows="2" placeholder="Enter Description . . .">{{old('pizzaDescription')}}</textarea>
                               @error('pizzaDescription')
                                   <small class="text-danger">{{$message}}</small>
                               @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Image</label>
                                <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror" id="">
                                @error('pizzaImage')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                <input id="cc-pament" name="pizzaWaiting" type="number" value="{{old('pizzaWaiting')}}" class="form-control @error('pizzaWaiting') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Waiting Time . . .">
                                @error('pizzaWaiting')
                                 <div class="invalid-feedback">
                                    {{$message}}
                                 </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="pizzaPrice" type="number" value="{{old('pizzaPrice')}}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price . . .">
                                @error('pizzaPrice')
                                 <div class="invalid-feedback">
                                    {{$message}}
                                 </div>
                                @enderror
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
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
