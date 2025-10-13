@extends('layouts.layoutlogin')

<style>
    /* Untuk semua input dan textarea */
    input::placeholder,
    textarea::placeholder {
        color: #000;  /* warna abu-abu standar Bootstrap */
        opacity: 1 !important;      /* pastikan terlihat */
    }
    
    body {
        background-image: url("{{ asset('images/background-login.png') }}");
        background-size: cover;                 /* menyesuaikan ukuran layar */
        background-repeat: no-repeat;           /* agar tidak diulang */
        background-position: center center;     /* posisi tengah */
    }

    .btn-login {
        font-size: 0.9rem;
        letter-spacing: 0.05rem;
        padding: 0.75rem 1rem;
    }

    .signin{
        display: flex;
        justify-content: center;
    }

    .center-img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

</style>

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                @if(\Session::has('alert'))
                    <div class="alert alert-danger">
                        <div>{{Session::get('alert')}}</div>
                    </div>
                @endif
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <div class="image-container">
                            <a href="{{url('/')}}">
                                <img class="center-img" src="{{ asset('images/logo-insap.png') }}" style="height: 60px;" alt="shape">
                            </a>
                        </div>
                    <br>
                    <!-- <h5 class="card-title text-center mb-5 fw-light fs-5">Sign In</h5> -->
                    <form action="{{ route('actionlogin') }}" id="loginForm" name="loginForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="floatingInput">Email Perusahaan</label>
                        <div class="mt-2 mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="sinta@adhi.co.id">
                        <span id="resultemail" style="font-size: 12px" class="mt-2 ml-2"></span>
                        </div>
                        <label for="floatingPassword">Password</label>
                        <div class="mt-2 mb-2">
                        <input type="password" class="form-control" id="passwordLogin" name="passwordLogin" placeholder="Password">
                        </div>
                        <div>
                        <!-- <h8>Note : Silahkan masukan email dan password yang digunakan pada aplikasi SINTA</h8><br> -->
                        <br>
                        </div>
                        <div class="d-grid signin mb-2">
                        <button class="btn btn-primary btn-login text-uppercase fw-bold" style="width: 300px;"  type="submit" id="signin" value="signin">Masuk</button>
                        </div>
                        <p style="font-size:11px;margin-bottom:0;text-align:center;">
                            Hak Cipta © 2025 PT ADHI KARYA Tbk. Semua Hak Dilindungi.
                        </p>
                        <hr class="my-4">
                    </form>
                    </div>
                </div>
                </div>
            </div>
        </div>

    <!--====== Jquery js ======-->
    <!-- jQuery -->
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        
        $(function() {
            'use strict';

            $('.form-control').on('input', function() {
                var $field = $(this).closest('.form-group');
                if (this.value) {
                    $field.addClass('field--not-empty');
                } else {
                    $field.removeClass('field--not-empty');
                }
            });

        });


    
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    </script>
@endsection
