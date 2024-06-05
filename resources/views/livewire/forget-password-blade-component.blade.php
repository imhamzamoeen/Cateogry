<div>
    <div class="auth-wrapper auth-cover">
        <div class="auth-inner row m-0">
            <!-- Brand logo--><a class="brand-logo" href="{{route('login')}}">

                {{-- <img src="{{asset('assets/images/logo.png')}}"> --}}
                <h2 class="brand-text text-primary ms-1">Quote Calculator</h2>
            </a>
            <!-- /Brand logo-->
            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid"
                        src="{{asset('assets/images/Calculator.png')}}" alt="Forgot password QC" /></div>
            </div>
            <!-- /Left Text-->
            <!-- Forgot password-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title fw-bold mb-1">Forgot Password? 🔒</h2>
                    <p class="card-text mb-2">Enter your email and we'll send you instructions to reset your password
                    </p>
                    <form wire:submit.prevent="submit" class="auth-forgot-password-form mt-2" id="forget-password-form"
                        method="POST">
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="forgot-password-email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="forgot-password-email"
                                wire:model.debounce.700ms="email" type="email" name="email" placeholder="f*****@example.com"
                                aria-describedby="forgot-password-email" autofocus="" tabindex="1"  />
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect w-100 forget-btn">
                            <span class="spinner-border spinner-border-sm forget-spinner" role="status"
                                aria-hidden="true" style="display: none"></span>
                            <span class="ms-25 align-middle forget-btn-inner">Send Reset Link</span>
                        </button>

                    </form>
                    <p class="text-center mt-2"><a href="{{route('login')}}"><i data-feather="chevron-left"></i> Back to
                            login</a></p>
                </div>
            </div>
            <!-- /Forgot password-->
        </div>
    </div>
</div>