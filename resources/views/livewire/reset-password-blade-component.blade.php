
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Reset Password basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <a href="#" class="brand-logo">
                        <img src="{{ asset('assets/images/Calculator.png') }}"
                            style="width:fit-content;height:fit-content"
                            onerror="this.onerror=null;this.src='{{ asset('assets/images/logo.png') }}'">

                        {{-- <h2 class="brand-text text-primary ms-1">QC</h2> --}}
                    </a>

                    <h4 class="card-title mb-1">Reset Password 🔒</h4>
                    <p class="card-text mb-2">You can change your password any time</p>

                    <form wire:submit.prevent="submit" id="reset-password-form" class="auth-reset-password-form mt-2"
                        method="POST">
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="reset-password-new">Your Email</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="text" class="form-control form-control- @error('email') is-invalid @enderror" id="email"
                                    wire:model.lazy="email" 
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="reset-password-new" tabindex="1" autofocus="false" 
                                    readonly />
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror


                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="reset-password-new">New Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="reset-password-new"
                                    wire:model.lazy="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="reset-password-new" tabindex="1" autofocus  />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye-off"></i></span>
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="reset-password-confirm">Confirm Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge @error('password_confirmation') is-invalid @enderror"
                                    wire:model.lazy="password_confirmation" id="reset-password-confirm"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="reset-password-confirm" tabindex="2"  />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye-off"></i></span>
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                        </div>
                        <button type="submit" id="resetPassword" class="btn btn-primary w-100" tabindex="3">Set New
                            Password</button>
                    </form>

                    <p class="text-center mt-2">
                        <a href="{{ route('login') }}"> <i data-feather="chevron-left"></i> Back to login </a>
                    </p>
                </div>
            </div>
            <!-- /Reset Password basic -->
        </div>
    </div>
