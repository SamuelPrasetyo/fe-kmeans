@extends('layouts.header')

@section('title', 'Login Page')

@section('content')
<style>
    .login-box.card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 15px;
    }
</style>


<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Elite admin</p>
    </div>
</div>

<section id="wrapper">
    <img src="{{ asset('assets/images/bg-login.png') }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <center>
        <div class="login-register" style="width: 25%; margin-top: 10%;">
            <div class="login-box card">
                <div class="card-body">

                    <form class="form-horizontal form-material" id="loginform" action="login" method="post">
                        @csrf
                        <h3 class="text-center m-b-20">Sign In</h3>

                        @if ($errors->has('login'))
                            <div class="alert alert-danger" id="loginAlert">
                                {{ $errors->first('login') }}
                            </div>
                        @endif

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="username" required="" placeholder="Username" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" id="form-control-password" required="" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="cek-password">
                                        <label class="custom-control-label" for="cek-password">Show Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </center>
</section>





<script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
<script src="assets/node_modules/popper/popper.min.js"></script>
<script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Untuk show password -->
<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });


    setTimeout(function() {
        document.getElementById('flash-msg').style.display = 'none';
    }, 5000);


    $(document).ready(function() {
        $('#cek-password').click(function() {
            if ($(this).is(':checked')) {
                $('#form-control-password').attr('type', 'text');
            } else {
                $('#form-control-password').attr('type', 'password');
            }
        });
    });
</script>

<!-- Untuk notifikasi alert -->
<script>
    // Tunggu hingga halaman selesai dimuat
    document.addEventListener("DOMContentLoaded", function() {
        // Dapatkan elemen alert
        var alertElement = document.getElementById('loginAlert');
        
        // Jika elemen alert ada, sembunyikan setelah 3 detik
        if (alertElement) {
            setTimeout(function() {
                alertElement.style.display = 'none';
            }, 3000); // Waktu dalam milidetik (3000 ms = 3 detik)
        }
    });
</script>
@endsection