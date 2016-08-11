@extends('layouts.auth')

@section('title', 'See for yourself why many loves CasterBuddy')

@section('content')


<div class="logo-screen row">
    <div class="col-md-4 col-md-offset-4">
        <img src="/img/logo.png" class="img-responsive" alt="CasterBuddy Login Logo">
    </div>
</div>

<form class="form-signin" method="POST" action="{{ url('/register') }}" style="margin-top: 0; margin-bottom: 30px;">
            {{ csrf_field() }}

        <h2 class="form-signin-heading">Sign up for free</h2>
        <div class="login-wrap">

            <p> Enter your account details below</p>
            {{-- Full Name --}}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Full Name" autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            
            {{-- Email --}}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input value="{{ old('email') }}" type="text" class="form-control" name="email" placeholder="Email" autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            
            {{-- Password --}}
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>  
    
            {{-- Password Confirmation --}}
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Re-type Password">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <button class="btn btn-lg btn-login btn-block" type="submit">Submit</button>

            <div class="registration">
                Already Registered.
                <a class="" href="/login">
                    Login
                </a>
            </div>

        </div>

      </form>
@endsection
