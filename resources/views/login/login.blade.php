<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNN &mdash; Permintaan Barang</title>
    @include('layout.partial.link')

    


</head>

<body>
<section class="container h-100">
    <div class="row justify-content-sm-center h-100 align-items-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-8">
            <div class="card shadow-lg">
                <div class="card-body p-4 text">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/bnn.png') }}" width="180" alt="">
                    </div>
                    <h1 class="fs-4 text-center fw-bold mb-4"></h1>
                    @if(Session::has('status'))
                        <div class="alert alert-danger mt-4" role="alert">
                            <p class="text-center" style="margin-bottom: 0px">{{ Session::get('pesan') }}</p>
                        </div>  
                    @else
                        <h1 class="fs-6 mb-3">Mohon masukan Email dan password anda untuk login</h1>
                    @endif
                   
                    <form method="POST" aria-label="abdul" data-id="abdul" class="needs-validation" novalidate=""
                        autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                            <div class="input-group input-group-join mb-3">
                                <input id="email" type="email" placeholder="Enter Email" class="form-control"
                                    name="email" value="" required autofocus>
                                    <span class="input-group-text rounded-end">&nbsp<i class="fa fa-envelope"></i>&nbsp</span>
                                <div class="invalid-feedback">
                                    Email is invalid
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-2 w-100">
                                <label class="text-muted" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-join mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Your password" required>
                                <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                <div class="invalid-feedback">
                                    Password required
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">    
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer py-3 border-0">
                    <div class="text-center">
                        Belum memiliki akun? <a href="{{ route('register') }}" class="text-dark">Buat disini</a>
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