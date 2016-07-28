@extends('layouts.auth')

@section('title', 'Login to your CasterBuddy account')

@section('content')
    
    <form class="form-signin" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
          
        <div class="login-wrap">
        <img src="/img/logo.png" class="img-responsive" alt="CasterBuddy Login Logo">

           @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            {{-- Email address --}}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <input value="{{ old('email') }}" type="text" class="form-control" name="email" placeholder="Email address" autofocus>

              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>
            
            {{-- Password --}}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <input type="password" class="form-control" name="password" placeholder="Password">
              
               @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            
            {{-- Remember Me --}}
            <label class="checkbox">
                <input type="checkbox" name="remember"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
            
            <div class="registration">
                Don't have an account yet?
                <a class="" href="/register">
                    Create an account
                </a>
            </div>

        </div>

      </form>

      @include('auth.passwords.email_modal')

@stop