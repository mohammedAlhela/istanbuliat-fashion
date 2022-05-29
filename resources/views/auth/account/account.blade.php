@extends('layouts.customers')

@section('content')
    <div class="authentication-container ">
        <div class="account-section-container ">
            @include('auth.account.navigation')
            <div class="form-section">

                <section class="mega-header text-left">
                    Account Informations
                </section>

                <form method="POST" action="{{ route('account-update') }}" class="auth-form">
                    @if ($errors->any())
                        <div class="my-errors">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    @csrf
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="authentication-font">
                                Full name
                            </div>
                            <input id="real-name" type="text" class="form-control" name="name"
                                value="{{ auth()->user()->name }}">

                            <div class="authentication-font">
                                Email Address
                            </div>
                            <input id="real-email" type="email" class="form-control" name="email"
                                value="{{ auth()->user()->email }}" autocomplete="nope">
                            <div class="authentication-font">
                                Password
                            </div>
                            <input id="password" type="password" class="form-control " name="password"
                                autocomplete="new-password">
                            <div class="buttons-holder mt-3 text-left">
                                <button class="update-profile-button " type="submit"> Save</button>
                            </div>

                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>
@endsection
