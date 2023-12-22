@extends('user.layouts.master')

@section('content')
    <div class="row">
        <div class="col-6 offset-3 shadow-lg p-4 rounded-3">
            @if (session('changePassword'))
             <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {{session('changePassword')}}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
            @endif
            <h3 class="text-center">Change Password</h3>
            <form action="{{route('user#changePassword')}}" method="post" novalidate="novalidate">
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
                    <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block rounded-3">
                        <i class="me-1 fa-solid fa-key fa-bounce"></i>
                        <span id="payment-button-amount">Change Password</span>
                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
