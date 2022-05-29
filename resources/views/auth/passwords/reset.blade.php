@extends('layouts.customers')




@section('content')
    <div class="authentication-container">


        <div class="form-card toper-card">
            <div class = 'mega-header '> Reset password</div>


            <div class="errors">
                <ul>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @endif

                </ul>
            </div>


            <?php

            $url = url()->full();

            $url_components = parse_url($url);
            parse_str($url_components['query'], $params);

            ?>

            <form method="POST" action="{{ route('password.update') }}" autocomplete="off">
                @csrf


                <input autocomplete="off" name="hidden" type="text" class="d-none">

                <input id="email" style="display:none" type="email" name="fakeemailremembered">
                <input id="password" style="display:none" type="password" name="fakepasswordremembered">
                <input id="password-confirm" style="display:none" type="password" name="fakepasswordconfirmremembered">




                <input type="hidden" name="token" value="{{ $token }}">
                <input placeholder="email" id="real-email" type="hidden" class="form-control" name="email"
                    value="{{ $params['email'] }}" autocomplete="nope">


                <input placeholder="password" id="real-password" type="password" class="form-control " name="password"
                    required autocomplete="new-password">

                <input placeholder="password confirm" id="real-password-confirm" type="password" class="form-control "
                    name="password_confirmation" required autocomplete="new-password">

                <div class="buttons-holder mt-4">
                    <button type="submit">
                        Reset Password
                    </button>
                </div>


            </form>
        </div>
    </div>
@endsection
