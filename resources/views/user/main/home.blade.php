@extends('user.layouts.master')

@section('content')
<!-- Shop Start -->
<div class="container-fluid">
    @if (session('sendMessage'))
    <div class="col-3 offset-9">
     <div class="alert alert-success alert-dismissible fade show fw-bold" role="alert">
       {{session('sendMessage')}}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>
     </div>
    @endif
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        {{-- <input type="checkbox" class="-input" checked id="price-all"> --}}
                        <h4>Categories</h4>
                        <h4><span class="badge bg-dark">{{count($category)}}</span></h4>
                    </div>
                    <hr>
                    <div class=" align-items-center justify-content-between mb-3">
                        <a class="text-dark" href="{{route('user#home')}}">
                          <label class="-label" for="price-1"><i class="fa-solid fa-pizza-slice me-1"></i>All Pizza</label>
                        </a>
                      </div>
                   @foreach ($category as $c)
                   <div class=" align-items-center justify-content-between mb-3">
                  <a class="text-dark" href="{{route('user#filter',$c->id)}}">
                    <label class="-label" for="price-1"><i class="fa-solid fa-pizza-slice me-1"></i>{{$c->name}}</label>
                  </a>
                </div>
                   @endforeach
                </form>
            </div>
            <!-- Price End -->

            <div class="">
                <button class="btn btn btn-warning rounded-3 w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mt-3 mb-4">
                        <div>
                            <a class="" href="{{route('user#cartList')}}">
                                <button type="button" class="btn bg-dark text-white position-relative rounded-3">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{ count($cart) }}
                                    </span>
                                  </button>
                            </a>
                            <a href="{{route('user#history')}}" class="ms-3">
                                <button type="button" class="btn bg-dark text-white position-relative rounded-3">
                                    <i class="fa-solid fa-clock-rotate-left"></i> History
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{ count($history) }}
                                    </span>
                                  </button>
                            </a>
                        </div>
                        <div class="ml-2">
                            <div class="">
                                <select name='sorting' id="sortingOption" class="form-control rounded-3">
                                    <option value=""> Choose Option . . .</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-auto" id="dataList">
                   @if (count($pizza) != null)
                   @foreach ($pizza as $p)
                   <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                    <div class="product-item bg-light mb-4 rounded-3" id="myForm">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" style="height: 230px" src="{{asset('storage/'.$p->image)}}" alt="">
                             <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetails',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$p->price}} Kyats</h5>
                            </div>
                        </div>
                    </div>
                </div>
                   @endforeach
                   @else
                   <h3 class="text-center col-6 offset-3 mt-5 py-5 shadow-sm rounded-3">There is no pizza</h3>
                   @endif
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){

            $('#sortingOption').change(function(){
                $eventOption = $('#sortingOption').val();

                if($eventOption == 'asc'){
                $.ajax({
                type : 'get' ,
                url : '/user/ajax/pizza/List' ,
                data : { 'status' : 'asc' } ,
                dataType : 'json' ,
                success : function(response){
                    // console.log(response[0].name);
                    $list = '';
                    for($i=0;$i<response.length;$i++){
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                    <div class="product-item bg-light mb-4" id="myForm">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" style="height: 230px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                             <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${response[$i].price} Kyats</h5>
                            </div>
                        </div>
                    </div>
                </div> `;
                    }
                    $('#dataList').html($list);
                }
            })
                }else if($eventOption == 'desc'){
                $.ajax({
                type : 'get' ,
                url : '/user/ajax/pizza/List' ,
                data : { 'status' : 'desc' } ,
                dataType : 'json' ,
                success : function(response){
                    $list = '';
                    for($i=0;$i<response.length;$i++){
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                    <div class="product-item bg-light mb-4" id="myForm">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" style="height: 230px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                             <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>${response[$i].price} Kyats</h5>
                            </div>
                        </div>
                    </div>
                </div> `;
                    }
                    $('#dataList').html($list);
                }
            })
                }
            })

});
    </script>
@endsection
