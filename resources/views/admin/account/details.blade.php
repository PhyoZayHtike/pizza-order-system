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
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col offset-1">
                          @if (Auth::user()->image == null)
                          @if (Auth::user()->gender == 'male')
                          <img class="rounded" src="{{asset('image/default_user.jpg')}}" alt="">
                          @else
                          <img class="rounded" src="{{asset('image/default_female.jpg')}}" alt="">
                          @endif
                          @else
                                <img class="rounded shadow-sm" src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" />
                          @endif
                            </div>
                            <div class="col-7 offset-1">
                                <h4 class="my-1"> <i class="fa-solid fa-user fa-bounce me-1"></i> Name : <span class="text-muted">{{Auth::user()->name}}</span></h4> <hr class="sty">
                                <h4 class="my-1"> <i class="fa-solid fa-envelope fa-bounce me-1"></i> Email : <span class="text-muted">{{Auth::user()->email}}</span></h4> <hr class="sty">
                                <h4 class="my-1"> <i class="fa-solid fa-phone fa-bounce me-1"></i> Phone : <span class="text-muted">{{Auth::user()->phone}}</span></h4> <hr class="sty">
                                <h4 class="my-1"> <i class="fa-solid fa-location-dot fa-bounce me-1"></i> Address : <span class="text-muted">{{Auth::user()->address}}</span></h4> <hr class="sty">
                                <h4 class="my-1"> <i class="fa-solid fa-venus-mars fa-bounce me-1"></i> Gender : <span class="text-muted">{{Auth::user()->gender}}</span></h4> <hr class="sty">
                                <h4 class="my-1"> <i class="fa-solid fa-user-clock fa-bounce me-1"></i> Join Date : <span class="text-muted">{{Auth::user()->created_at->format('j,F,Y')}}</span></h4> <hr class="sty">
                            </div>
                            <div class="text-center">
                                <a href="{{route('admin#edit')}}">
                                    <button class="btn btn-dark text-white">
                                        <i class="fa-solid fa-pen-to-square fa-beat-fade me-1"></i>  Edit Profile
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--end main content --}}
@endsection
