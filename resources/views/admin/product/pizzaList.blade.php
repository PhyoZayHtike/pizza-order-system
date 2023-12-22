@extends('admin.layouts.master')

@section('title','Category List')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('product#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
               @if (session('createSuccess'))
               <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check text-dark"></i> {{session('createSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
               @endif
               @if (session('deleteSuccess'))
               <div class="col-4 offset-8">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     {{session('deleteSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
               @endif
               @if (session('updateSuccess'))
               <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('updateSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
               @endif
               @if (session('changePassword'))
               <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{session('changePassword')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
               @endif
               @if (session('updateProfileSuccess'))
               <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{session('updateProfileSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
               @endif
               <div class="float-end mb-2">
                <form class="form-header" action="{{ route('product#list') }}" method="get">
                    @csrf
                    <input class="form-control" type="text" name="key" placeholder="Search..." value="{{request('key')}}"/>
                    <button class="au-btn--submit" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                   </form>
               </div>

                <div class="">
                    <h4 class="text-muted">Search Key : <Span class="text-danger">{{request('key')}}</Span></h4>
                </div>

                @if (count($pizzas) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead class="border-bottom">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>View Count</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pizzas as $p)
                            <tr class="border-bottom">
                                <td class="col-2"><img src="{{asset('storage/'. $p->image)}}" class="img rounded-3" alt=""></td>
                                <td class="col-3">{{$p->name}}</td>
                                <td class="col-2"><i class="fa-regular fa-money-bill-1 me-2"></i>{{$p->price}}</td>
                                <td class="col-2">{{$p->category_name}}</td>
                                <td class="col-2"><i class="fa-solid fa-eye me-2"></i>{{$p->view_count}}</td>
                                <td class="col-2">
                                    <div class="table-data-feature">
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="view">
                                            <i class="fa-regular fa-eye text-success"></i>
                                        </button> --}}
                                        <a href="{{route('product#edit',$p->id)}}">
                                            <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="view">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('product#updatePage',$p->id)}}">
                                            <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit text-dark"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('product#delete',$p->id)}}">
                                            <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete text-danger"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <h2 class="text-secondary text-center mt-5">There is no Pizza Here!</h2>
                @endif
                 <div class="mt-3">
                    {{$pizzas->links()}}
                 </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
