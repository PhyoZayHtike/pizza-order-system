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
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>
                </div>
               <div class="float-end mb-2">
                <form class="form-header" action="{{ route('admin#orderList') }}" method="get">
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

                <form action="{{route('admin#changeStatus')}}" method="get">
                    @csrf
                    <div class="d-flex align-items-center mt-4 mb-2">
                        <select class="form-control col-3" name="orderStatus" id="orderStatus">
                            <option value="" @if(request('orderStatus') == '') selected @endif>All</option>
                            <option value="0" @if(request('orderStatus') == '0') selected @endif>Pending</option>
                            <option value="1" @if(request('orderStatus') == '1') selected @endif>Accept</option>
                            <option value="2" @if(request('orderStatus') == '2') selected @endif>Reject</option>
                        </select>
                        <button type="submit" class="btn btn btn-dark text-white ms-2">
                            <i class="fa-solid fa-magnifying-glass me-1"></i>Search
                        </button>
                    </div>
                </form>


                @if (count($order) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead class="border-bottom">
                            <tr>
                                <th>User Id</th>
                                <th>UserName</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($order as $o)
                            <tr class="border-bottom">
                                <input type="hidden" class="orderId" value="{{$o->id}}">
                                <td class="col-2">{{$o->user_id}}</td>
                                <td class="col-2">{{$o->user_name}}</td>
                                <td class="col-2">{{$o->created_at->format('F j, Y')}}</td>
                                <td class="col-2">
                                    <a href="{{route('admin#listInfo',$o->order_code)}}">{{$o->order_code}}</a>
                                </td>
                                <td class="col-2">{{$o->total_price}} Kyats</td>
                                <td class="col-3">
                                    <select name="status" id="" class="form-control statusChange">
                                        <option class="" value="0" @if($o->status == 0) selected  @endif>Pending </option>
                                        <option class="" value="1" @if($o->status == 1) selected  @endif>Accept</option>
                                        <option class="" value="2" @if($o->status == 2) selected  @endif>Reject</option>
                                    </select>
                                </td>

                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <h2 class="text-secondary text-center mt-5">There is no Order Here!</h2>
                @endif
                 <div class="mt-3">
                    {{-- {{$order->links()}} --}}
                 </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){
    // $('#orderStatus').change(function(){
    //    $status = $('#orderStatus').val();

    //    $.ajax({
    //     type : 'get' ,
    //     url : 'http://localhost:8000/order/ajax/status' ,
    //     data : { 'status' : $status } ,
    //     dataType : 'json' ,
    //     success : function(response){



    //         $list = '';
    //                 for($i=0;$i<response.length;$i++){
    //                     let date = new Date(response[$i].created_at);
    //                     let formattedDate = date.toLocaleDateString('my-MM', {day: '2-digit', month: 'long', year: 'numeric' });

    //                     if(response[$i].status == 0){
    //                         $statusMessage =   `<select name="status" id="" class="form-control statusChange">
    //                                     <option class="" value="0" selected>Pending </option>
    //                                     <option class="" value="1">Accept</option>
    //                                     <option class="" value="2">Reject</option>
    //                         </select> `;
    //                     }else if(response[$i].status == 1){
    //                         $statusMessage =  `<select name="status" id="" class="form-control statusChange">
    //                                     <option class="" value="0">Pending </option>
    //                                     <option class="" value="1" selected>Accept</option>
    //                                     <option class="" value="2">Reject</option>
    //                         </select> `;
    //                     }else if(response[$i].status == 2){
    //                       $statusMessage =  `<select name="status" id="" class="form-control statusChange">
    //                                     <option class="" value="0">Pending </option>
    //                                     <option class="" value="1">Accept</option>
    //                                     <option class="" value="2" selected>Reject</option>
    //                         </select> `;
    //                     }
    //                     $list += `
    //                     <tr class="border-bottom">
    //                         <input type="hidden" class="orderId" value='${response[$i].id}'>
    //                             <td class="col-2">${response[$i].user_id} </td>
    //                             <td class="col-2">${response[$i].user_name} </td>
    //                             <td class="col-2">${formattedDate}  </td>
    //                             <td class="col-2">${response[$i].order_code} </td>
    //                             <td class="col-2">${response[$i].total_price}  Kyats</td>
    //                             <td class="col-3">
    //                                 ${$statusMessage}
    //                             </td>

    //                             </td>
    //                             <td></td>
    //                         </tr>
    //                     `;
    //                 }
    //                 $('#dataList').html($list);
    //     }
    //    });
    // });
    //change status
    $('.statusChange').change(function(){
        $currentStatus = $(this).val();
        $parentNode = $(this).parents('tr');
        $orderId = $parentNode.find('.orderId').val();
        $data = {
            'status' : $currentStatus ,
            'orderId' : $orderId ,
        }
        $.ajax({
        type : 'get' ,
        url : '/order/ajax/change/status' ,
        data : $data ,
        dataType : 'json' ,
     });
});
});
</script>
@endsection
