@extends('layouts.customers')
@section('content')
    <div class="authentication-container ">
        <div class="account-section-container ">
            @include('auth.account.navigation')
            <div class="form-section">
                <section class="heading-authentication-navigation text-left">
                 my orders
                </section>

         

                <div class="authentication-font  designing-div mt-3">
                    You dont have any orders yet
                </div>
            </div>
        </div>
    </div>
@endsection
