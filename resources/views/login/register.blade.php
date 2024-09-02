<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Register &mdash; Arfa</title>
    @include('layout.partial.link')


</head>

<body>
<section class="container h-100">
    <div class="row justify-content-sm-center h-100 align-items-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <h1 class="fs-4 text-center fw-bold mb-4">Register</h1>
                    <h1 class="fs-6 mb-3">Register to get more benefits!!</h1>
                    <form action="/register-add" method="POST" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate>
                    @csrf
                        <div class="mb-3">
                            <label class="mb-2 text-muted" for="email">Full Name</label>
                            <div class="input-group input-group-join mb-3">
                                <input type="text" placeholder="Enter Your Name" class="form-control"
                                    name="name" value="" required autofocus>
                                <span class="input-group-text rounded-end">&nbsp<i
                                        class="fa fa-user"></i>&nbsp</span>
                                <div class="invalid-feedback">
                                    Name is required
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                            <div class="input-group input-group-join mb-3">
                                <input id="email" type="email" placeholder="Enter Email" class="form-control is-invalid"
                                    name="email" value="" required autofocus>
                                <span class="input-group-text rounded-end">&nbsp<i
                                        class="fa fa-envelope"></i>&nbsp</span>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-2 w-100">
                                <label class="text-muted" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-join mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Your password" required>
                                <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i
                                        class="fa fa-eye"></i>&nbsp</span>
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="mb-2 w-100">
                                <label class="text-muted" for="password">Confirm Password</label>
                            </div>
                            <div class="input-group input-group-join mb-3">
                                <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Your Password"
                                    required>
                                <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i
                                        class="fa fa-eye"></i>&nbsp</span>
                                <div class="invalid-feedback">
                                    Confirm Password is required
                                </div>
                            </div>
                        </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    Register
                                </button>
                            </div>
                    </form>
                    
                </div>
                <div class="card-footer py-3 border-0">
                    <div class="text-center">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-dark">Login kuyy</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5 text-muted">
                {{-- Copyright &copy; 2022 &mdash; Mulai Dari Null --}}
            </div>
        </div>
    </div>
</section>
@include('layout.partial.script')
</body>
</html>