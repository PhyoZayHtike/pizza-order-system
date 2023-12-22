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
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Category
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
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-xmark text-danger"></i>  {{session('deleteSuccess')}}
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
                <form class="form-header" action="{{ route('category#list') }}" method="get">
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

                @if (count($categories) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead class="border-bottom">
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Category Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr class="border-bottom">
                                <td>{{$category->id}}</td>
                                <td class="col-6">{{$category->name}}</td>
                                <td>{{$category->created_at->format('j-F-Y')}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="view">
                                            <i class="fa-regular fa-eye text-success"></i>
                                        </button> --}}
                                        <a href="{{route('category#edit',$category->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit text-dark"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('category#delete',$category->id)}}">
                                            <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete text-danger"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$categories->links()}}
                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                    </div>
                </div>
                @else
                <h2 class="text-secondary text-center mt-5">There is no Data</h2>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
