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
                        <a class="fs-5 text-dark" href="{{route('admin#orderList')}}"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
                    </div>
                </div>

                <div class="row col-5">
                    <div class="card rounded-3">
                        <div class="card-body">
                            <div class="cart-header mb-3">
                                <h3 class="text-center">Order Info</h3>
                            </div>
                            <hr style="border-bottom: 1px solid black">
                           <div class="row">
                            <div class="col"><i class="fa-solid fa-user me-2"></i>Customer Name</div>
                            <div class="col">{{strtoupper($orderList[0]->user_name)}}</div>
                           </div>
                           <div class="row mt-2">
                            <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                            <div class="col">{{$orderList[0]->order_code}}</div>
                           </div>
                           <div class="row mt-2">
                            <div class="col"><i class="fa-regular fa-calendar me-2"></i>Order Date</div>
                            <div class="col">{{$orderList[0]->created_at->format('F j, Y')}}</div>
                           </div>
                           <div class="row mt-2">
                            <div class="col"><i class="fa-solid fa-file-invoice-dollar me-2"></i>Total Price</div>
                            <div class="col">{{$order->total_price - 3000}} Kyats <span class="text-danger">+ Deli 3000 Kyats</span></div>
                           </div>
                        </div>
                    </div>
                </div>

                @if (count($orderList) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead class="border-bottom">
                            <tr>
                                <th>Order Id</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Order Date</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orderList as $o)
                            <tr class="border-bottom">
                                <input type="hidden" class="orderId" value="{{$o->id}}">
                                <td>{{$o->id}}</td>
                                <td class="col-2">
                                    <img class="rounded-3 img-thumbnail" src="{{asset('storage/'.$o->product_image)}}" alt="image">
                                </td>
                                <td>{{$o->product_name}}</td>
                                <td>{{$o->created_at->format('F j, Y')}}</td>
                                <td>{{$o->qty}}</td>
                                <td>{{$o->total}}</td>
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
