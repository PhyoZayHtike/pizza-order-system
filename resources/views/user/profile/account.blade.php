@extends('user.layouts.master')

@section('content')
<div class="main-content mt-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title w-50 m-auto">
                            @if (session('updateProfileSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{session('updateProfileSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                           @endif
                            <h3 class="text-center title-2">Account Edit</h3>
                        </div>
                        <hr>
                        <form action="{{route('user#accountChange',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-5 offset-1">
                                    @if (Auth::user()->image == null)
                                       @if (Auth::user()->gender == 'male')
                                        <img class="rounded w-75" src="{{asset('image/default_user.jpg')}}" alt="">
                                     @else
                                        <img class="rounded w-75" src="{{asset('image/default_female.jpg')}}" alt="">
                                       @endif
                                @else
                                    <img class="rounded w-75 shadow-sm" src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" />
                                @endif
                                    <div class="mt-3">
                                        <input type="file" name="image" class="form-control w-75 rounded-3 @error('image') is-invalid @enderror" id="">
                                        @error('image')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-dark text-white w-75 rounded-3"><i class="fa-solid fa-circle-right fa-shake me-2"></i>Update Your Profile</button>
                                    </div>
                                </div>
                                <div class="row col-5">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" type="text" value="{{old('name',Auth::user()->name)}}"  class="form-control rounded-3 @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter UserName">
                                        @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" type="text" value="{{old('email',Auth::user()->email)}}"  class="form-control rounded-3 @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Your Email">
                                        @error('email')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" type="text" value="{{old('phone',Auth::user()->phone)}}"  class="form-control rounded-3 @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="09xxxxxxxx">
                                        @error('phone')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control rounded-3" name="gender" id="">
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
                                        <textarea name="address" class="form-control rounded-3  @error('address') is-invalid @enderror" id="cc-payment"  rows="2">{{old('address',Auth::user()->address)}}</textarea>
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
@endsection
