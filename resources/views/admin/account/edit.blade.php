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
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Edit</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin#update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image == null)
                                       @if (Auth::user()->gender == 'male')
                                        <img class="rounded" src="{{asset('image/default_user.jpg')}}" alt="">
                                     @else
                                        <img class="rounded" src="{{asset('image/default_female.jpg')}}" alt="">
                                       @endif
                                @else
                                    <img class="rounded shadow-sm" src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" />
                                @endif
                                    <div class="mt-3">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="">
                                        @error('image')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-dark text-white col-12"><i class="fa-solid fa-circle-right fa-shake me-2"></i>Update Your Profile</button>
                                    </div>
                                </div>
                                <div class="row col-6">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{old('name',Auth::user()->name)}}"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter UserName">
                                        @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="text" value="{{old('email',Auth::user()->email)}}"  class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Email">
                                        @error('email')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="text" value="{{old('phone',Auth::user()->phone)}}"  class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="09xxxxxxxx">
                                        @error('phone')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control" name="gender" id="">
                                          <option value="">Choose Gender . . .</option>
                                          <option value="male" @if (Auth::user()->gender == 'male') selected  @endif>Male</option>
                                          <option value="female"  @if (Auth::user()->gender == 'female') selected  @endif>Female</option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <textarea name="address" class="form-control  @error('address') is-invalid @enderror" id="cc-payment"  rows="2">{{old('address',Auth::user()->address)}}</textarea>
                                        @error('address')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
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
