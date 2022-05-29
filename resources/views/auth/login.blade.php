@extends('layouts.customers')

@section('content')
    <div class="authentication-container">


        <div class="form-card toper-card">
          <div class = 'mega-header '> Login</div>
            <div class="errors">
                <ul>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @endif

                </ul>
            </div>


            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf


                <input autocomplete="off" name="hidden" type="text" class="d-none">

                <input id="email" style="display:none" type="text" name="fakeusernameremembered">
                <input id="password" style="display:none" type="password" name="fakepasswordremembered">



                <input placeholder="email" id="real-email" type="email" class="form-control" name="email"
                    value="{{ old('email') }}" required autocomplete="nope">


                <input placeholder="password" id="real-password" type="password" class="form-control " name="password"
                    required autocomplete="new-password">
                <div class="forget-password">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                </div>

                <div class="buttons-holder">
                    <button type="submit" class="">
                        Sign in
                    </button>
                    <div class="create-account">

                        <a href="{{ route('register') }}">
                            Create New Account
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
