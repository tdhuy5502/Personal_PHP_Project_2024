@extends('welcome')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form action="{{route('frontend.login')}}" method="POST">
                        @csrf
                        <input name="email_acc" type="text" placeholder="User Email" />
                        <input name="password" type="password" placeholder="Password" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Keep me signed in
                        </span>
                        <button type="submit" name="loginn" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-5">
                <div class="signup-form"><!--sign up form-->
                    <h2>Become A New User</h2>
                    <form action="{{route('frontend.add_customer')}}" method="POST">
                        @csrf
                        <input name="customer_name" type="text" placeholder="Name"/>
                        <input name="customer_email" type="email" placeholder="Email Address"/>
                        <input name="customer_pass" type="password" placeholder="Password"/>
                        <input name="customer_phone" type="text" placeholder="Phone"/>
                        
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                    
                        @if ($errors->any())
                        <div style="margin-top: 10px" class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                   
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection