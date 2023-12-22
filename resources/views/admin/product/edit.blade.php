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
                    <div class="card-header">
                        {{-- <a class="text-dark" href="{{route('product#list')}}"> --}}
                            <i style="cursor: pointer" class="fa-solid fa-arrow-left ms-3 fs-2"onclick=history.back()></i>
                        {{-- </a> --}}
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Pizza Info</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 offset-1">
                                <img class="rounded shadow-sm" src="{{asset('storage/'.$pizza->image)}}" alt="Pizza" />
                                <hr class="sty">
                                <div class="mt-3">
                                    <h4 class="my-1"> <i class="fa-solid fa-envelope-open-text fa-bounce me-1"></i> Details</h4>
                                    <p class="text">{{$pizza->description}}</p>
                                </div>
                            </div>
                            <div class="col-6 ms-2">
                                <h4 class="my-1"> <i class="fa-solid fa-pizza-slice fa-bounce me-1"></i> Name : <span class="text-muted">{{$pizza->name}}</span></h4> <hr class="sty">
                                <h4 class="my-1"> <i class="fa-solid fa-money-bill-1-wave fa-bounce me-1"></i>  Price : <span class="text-muted">{{$pizza->price}}</span></h4> <hr class="sty">
                                <h4 class="my-1"> <i class="fa-solid fa-user-clock fa-bounce me-1"></i> Waiting Time : <span class="text-muted">{{$pizza->waiting_time}}</span></h4> <hr class="sty">
                                <h4 class="my-1"> <i class="fa-solid fa-eye fa-bounce me-1"></i> View Count : <span class="text-muted">{{$pizza->view_count}}</span></h4> <hr class="sty">
                                <h4 class="my-1"> <i class="fa-solid fa-clone fa-bounce me-1"></i> Category : <span class="text-muted">{{$pizza->category_name}}</span></h4> <hr class="sty">
                                <h4 class="my-1"> <i class="fa-solid fa-clock fa-bounce me-1"></i> Pizza Date : <span class="text-muted">{{$pizza->created_at->format('j,F,Y')}}</span></h4> <hr class="sty">
                            </div>
                            <div class="text-center">
                                <a href="{{route('product#updatePage',$pizza->id)}}">
                                    <button class="btn btn-dark text-white">
                                        <i class="fa-solid fa-pen-to-square fa-beat-fade me-1"></i>  Edit Pizza
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
