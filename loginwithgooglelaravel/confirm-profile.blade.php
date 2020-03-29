@extends('layout')
@section('content')
    @if(\Session::has('email'))
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="login-form"><!--login form-->
                        <h2>Register account {{\Session::get('name')}} !!</h2>
                        <form action="{{route('save-profile')}}" method="post">
                            @csrf
                            <input value="{{\Session::get('email')}}" name="customer_email" type="hidden" placeholder="Name"/>
                            <input value="{{\Session::get('name')}}" name="customer_name" type="hidden" placeholder="Email Address"/>
                            <input name="customer_password" type="password" placeholder="Password" />
                            <input name="re_customer_password" type="password" placeholder="Confirm Password" />
                            <input name="customer_numberphone" type="number" placeholder="Phone Number" />
                            <textarea name="customer_address" placeholder="Address"></textarea>
                            <button type="submit" class="btn btn-default">Register</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </section><!--/form-->
    @else
    <h1>Authentication failed</h1>
    <a href="{{route('login-customer')}}">Back to login</a>
    @endif
    @endsection
