@extends('website.master')
@section('contents')
<div class="page-wrapper">
    <main class="main">
        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('/website/images/login.jpg')">
            <div class="container">
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">
                                    Add Review From Here
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade  show active" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                                <!-- login -->
                                <form action="{{ route('user.sumbit.review',$review->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>write a review</label>
                                        <textarea name="" id="" cols="30" rows="10" class="form-control" required></textarea>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>Submit</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </div>
                                </form>
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