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
                            <h2 class="title-1">Customer Message List</h2>
                        </div>
                    </div>
                </div>
                  @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{session('deleteSuccess')}}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>
                 </div>
                @endif
               <div class="float-end mb-2">
                <form class="form-header" action="{{route('admin#customerMessage')}}" method="get">
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

                @if (count($data) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead class="border-bottom">
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Delete</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr class="border-bottom">
                                <td></td>
                                <td>{{$d->id}}</td>
                                <td class="col-2">{{$d->name}}</td>
                                <td class="">{{$d->email}}</td>
                                <td>{{$d->message}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('admin#customerMessageDelete',$d->id)}}">
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
                    <div class="mt-3">
                        {{$data->links()}}
                    </div>
                </div>
                @else
                <h2 class="text-secondary text-center mt-5">There is no Message</h2>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
