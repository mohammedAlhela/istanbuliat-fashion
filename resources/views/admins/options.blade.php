@extends('layouts.admins')
@section('title')
    istanbuliat.store manage options
@endsection
@section('content')
    @if (session()->has('message'))
        <div class="fluid-container alert alert-success alert-dismissible fade show mb-0" role="alert">
            {{ session()->get('message') }} <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> </div>
    @endif


    @if ($errors->any())
        <div class="fluid-container alert alert-danger alert-dismissible fade show mb-0" role="alert">
            <ul class = "errors-ul">
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <admins-options></admins-options>
@endsection
