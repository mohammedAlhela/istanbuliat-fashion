@extends('layouts.customers')




@section('content')
    <div class="authentication-container">


        <div class="form-card toper-card">
            <div class = 'mega-header '> Create account</div>
            <div class="errors">
                <ul>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @endif

                </ul>
            </div>


            <form method="POST" action="{{ route('register') }}" autocomplete="off">
                @csrf


                <input autocomplete="off" name="hidden" type="text" class="d-none">

                <input id="name" style="display:none" type="text" name="fakenameremembered">
                <input id="email" style="display:none" type="email" name="fakeemailremembered">
                <input id="password" style="display:none" type="password" name="fakepasswordremembered">
                <input id="password-confirm" style="display:none" type="password" name="fakepasswordconfirmremembered">



                <input placeholder="full name" id="real-name" type="text" class="form-control" name="name"
                value="{{ old('name') }}" required >

                <input placeholder="email" id="real-email" type="email" class="form-control" name="email"
                    value="{{ old('email') }}" required autocomplete="nope">


                <input placeholder="password" id="real-password" type="password" class="form-control " name="password"
                    required autocomplete="new-password">

                    <input placeholder="password confirm" id="real-password-confirm" type="password" class="form-control " name="password_confirmation"
                    required autocomplete="new-password">



                <div class="buttons-holder mt-4">
                <button type="submit" >
                    Sign up
                </button>    </div>


                <div class="login">

                    <a href="{{ route('login') }}">
                       Already have an account
                    </a>



                </div>





            </form>

        </div>





    </div>
@endsection















































