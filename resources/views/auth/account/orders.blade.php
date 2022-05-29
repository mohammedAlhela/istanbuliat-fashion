@extends('layouts.customers')
@section('content')
    <div class="authentication-container ">
        <div class="account-section-container ">
            @include('auth.account.navigation')
            <div class="form-section">
                <section class="mega-header text-left">
                 orders
                </section>

                <p class="authentication-font">
                    You dont have any orders yet
                </p>

            </div>
        </div>
    </div>
@endsection
