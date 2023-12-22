@extends('admin.layouts.master')

@section('title','Category List')
@section('content')
{{-- main content --}}
<div class="main-content mt-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card rounded-3">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Your Password</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password"  class="form-control rounded-3 @if (session('notMatch')) is-invalid @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password">
                                @error('oldPassword')
                                 <div class="invalid-feedback">
                                    {{$message}}
                                 </div>
                                @enderror
                                @if (session('notMatch'))
                                <div class="invalid-feedback">
                                    {{session("notMatch")}}
                                 </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password"  class="form-control rounded-3 @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                @error('newPassword')
                                 <div class="invalid-feedback">
                                    {{$message}}
                                 </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password"  class="form-control rounded-3 @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password">
                                @error('confirmPassword')
                                 <div class="invalid-feedback">
                                    {{$message}}
                                 </div>
                                @enderror
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block rounded-3">
                                    <i class="me-1 fa-solid fa-key fa-bounce"></i>
                                    <span id="payment-button-amount">Change Password</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--end main content --}}
@endsection
