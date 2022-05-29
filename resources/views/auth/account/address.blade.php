@extends('layouts.customers')

@section('content')
    <div class="authentication-container ">
        <div class="account-section-container ">
            @include('auth.account.navigation')
            <div class="form-section">


                  <section class="mega-header text-left">
                    Address Informations
                </section>



          


                <form method="POST" action="{{ route('address-update') }}" class="auth-form">
                    @if ($errors->any())   <div class="my-errors">
                        <ul>

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                        </ul>

                    </div>   @endif

                    @csrf

                    <div class="row mt-2">
                        <div class="col-6 py-0">
                            <div class="authentication-font">
                                First name
                            </div>
                            <input id="first_name" type="text" class="form-control" name="first_name"
                                value="{{ auth()->user()->first_name }}" required>
                        </div>

                        <div class="col-6 py-0">
                            <div class="authentication-font">
                                Last name
                            </div>
                            <input id="last_name" type="text" class="form-control" name="last_name"
                                value="{{ auth()->user()->last_name }}" required>
                        </div>

                        <div class="col-6 py-0">
                            <div class="authentication-font">
                                Address 1
                            </div>

                            <input id="address1" type="text" class="form-control" name="address1"
                                value="{{ auth()->user()->address1 }}" required>
                        </div>


                        <div class="col-6 py-0">

                            <div class="authentication-font">
                                Address 2
                            </div>
                            <input id="address2" type="text" class="form-control" name="address2"
                                value="{{ auth()->user()->address2 }}" required>
                        </div>

                        <div class="col-6 py-0">
                            <div class="authentication-font">
                                Contact number
                            </div>
                            <input id="contact_number" type="text" class="form-control" name="contact_number"
                                value="{{ auth()->user()->contact_number }}" required>
                        </div>
                        <div class="col-6 py-0">
                            <div class="authentication-font">
                                Postal / zip code
                            </div>
                            <input id="zip_code" type="text" class="form-control" name="zip_code"
                                value="{{ auth()->user()->zip_code }}" required>
                        </div>
                    </div>
                    <div class="buttons-holder  text-left address-buttons-holder">
                        <button class="update-profile-button " type="submit"> Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
