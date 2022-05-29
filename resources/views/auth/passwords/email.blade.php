


@extends('layouts.customers')

@section('content')
    <div class="authentication-container">


        <div class="form-card toper-card">
            <div class = 'mega-header'> Reset password</div>

          <div class = 'auth-text'>We will send you an email to reset your password.
              </div>

            <div class="errors">
                <ul>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @endif

                </ul>
            </div>

            <form method="POST" action="{{ route('password.email') }}" autocomplete="off">
                @csrf


                <input autocomplete="off" name="hidden" type="text" class="d-none">

                <input id="email" style="display:none" type="text" name="fakeusernameremembered">

                <input placeholder="email" id="real-email" type="email" class="form-control" name="email"
                    value="{{ old('email') }}" required autocomplete="nope">

                    <div class="buttons-holder mt-2">

                        <button type="submit" >
                            {{ 'Submit' }}
                        </button>
                 
                        <div>

                            <a class = 'cancel' href="/login">
                                {{ 'Cancel' }}

                        </a>
                        </div>

                    </div>


            </form>
        </div>
    </div>
@endsection
