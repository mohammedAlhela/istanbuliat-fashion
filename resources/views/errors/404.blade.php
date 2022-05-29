<?php
use Illuminate\Support\Facades\Auth;
if (Auth::check() && Auth::user()->role) {
    $view = "admins";
    $redirect = "/admins/dashboard";
}

elseif (Auth::check() && !Auth::user()->role) {
    $view = "customers";
    $redirect = "/";
}

else {
    $view = "customers";
    $redirect = "/";
}


?>

@extends('layouts.customers')

@section('content')
<admins-navbar></admins-navbar>
    <div class="error-page-container">
  <div class="mega-header">
    404 page not found
  </div>
  <p class = "text"> the page you requested does not exist. Click <a href="{{ $redirect }}">here</a>  to continue shopping. </p>


    </div>
@endsection

