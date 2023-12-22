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
                            <h2 class="title-1">Admin & User List</h2>
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
                    {{session('createSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
               @endif
               @if (session('deleteSuccess'))
               <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                <form class="form-header" action="{{ route('admin#list') }}" method="get">
                    @csrf
                    <input class="form-control" type="text" name="key" placeholder="Search Email or Name..." value="{{request('key')}}"/>
                    <button class="au-btn--submit" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                   </form>
               </div>

                <div class="">
                    <h4 class="text-muted">Search Key : <Span class="text-danger">{{request('key')}}</Span></h4>
                </div>

                @if (count($admin) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead class="border-bottom">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Setting</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $a)
                            <tr class="border-bottom">
                                <td class="col-2">
                                   @if ($a->image == null)
                                      @if ($a->gender == 'male')
                                      <img src="{{asset('image/default_user.jpg')}}" alt="">
                                      @else
                                      <img src="{{asset('image/default_female.jpg')}}" alt="">
                                      @endif
                                   @else
                                   <img class="img" src="{{asset('storage/'.$a->image)}}" alt="">
                                   @endif
                                </td>
                                <input type="hidden" value="{{$a->id}}" id="adminId">
                                <td class="">{{$a->name}}</td>
                                <td class="">{{$a->email}}</td>
                                <td class="">{{$a->gender}}</td>
                                <td class="">{{$a->phone}}</td>
                                <td class="">{{$a->address}}</td>
                                <td class="col-3">
                                    <div class="table-data-feature">
                                            @if (Auth::user()->id == $a->id)

                                            @else
                                            <div class="form-group">
                                                <select class="form-select roleChange" aria-label="Default select example" name="role" id="">
                                                  <option disabled value="">Choose Role . . .</option>
                                                  <option value="admin" @if ($a->role == 'admin') selected  @endif>Admin</option>
                                                  <option value="user"  @if ($a->role == 'user') selected  @endif>User</option>
                                                </select>
                                            </div>

                                            <a href="{{route('admin#delete',$a->id)}}">
                                                <button class="item ms-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete text-danger"></i>
                                                </button>
                                            </a>
                                            @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$admin->links()}}
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

@section('scriptSection')
   <script>
      $(document).ready(function(){
        $('.roleChange').change(function(){
        $role = $(this).val();
        $parentNode = $(this).parents('tr');
        $adminId = $parentNode.find('#adminId').val();
        $data = {
            'role' : $role ,
            'adminId' :$adminId ,
        }

        $.ajax({
        type : 'get' ,
        url : '/admin/changeUserAdmin' ,
        data : $data ,
        dataType : 'json' ,
     });
     window.location.href = "/admin/list";
    });
  });
   </script>
@endsection
