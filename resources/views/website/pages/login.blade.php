@extends('website.master')
@section('contents')
<div class="message">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="page-wrapper">
    <main class="main">
        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('/website/images/login.jpg')">
            <div class="container">
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">
                                    Sign In
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">
                                    Register
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade  show active" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                                <!-- login -->
                                <form action="{{ route('user.do.login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="singin-email">Username/Email</label>
                                        <input type="text" name="email" class="form-control" id="singin-email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="singin-password">Password *</label>
                                        <input type="password" name="password" class="form-control" id="singin-password" required>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>LOG IN</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="signin-remember-2">
                                            <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
                                        </div>

                                        <a href="#" class="forgot-link">Forgot Your Password?</a>
                                    </div>
                                </form>
                                <!-- desktop login with facebook/google -->
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="{{ route('user.login.google') }}" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Login With Google
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="{{ route('user.login.facebook') }}" class="btn btn-login btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Login With Facebook
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                                <!-- register -->
                                <form action="{{ route('user.do.registration') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Full Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email"> Email</label>
                                        <input type="email" name="email" class="form-control" id="email" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" id="password" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="confirm_password">Re-enter Password</label>
                                            <input type="password" name="confirm_password" class="form-control" id="confirm_password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">address</label>
                                        <input type="text" name="address" class="form-control" id="address" required>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SIGN UP</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                            <label class="custom-control-label" for="register-policy-2">I agree to the <a href="{{ route('website.privacy.policy') }}">privacy policy</a> *</label>
                                        </div>
                                    </div>
                                </form>
                                <!-- mobile login with facebook/google -->
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="{{ route('user.login.google') }}" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Login With Google
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="{{ route('user.login.facebook') }}" class="btn btn-login  btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Login With Facebook
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
@endsection