@extends('welcome')


@section('welmome.contect')


@if(session('error_password'))
<div class="alert alert-danger" role="alert" style="max-width:450px;margin:20px">
  Bilgileriniz uyuşmuyor
</div>

@endif


    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="doctor-login-left-box">
                    <div class="doctor-login-left-box-text">
                        <h1>Hemen giriş yap, hizmet vermeye başlayın</h1>
                        <p>Kayıt olmak için aşağıdaki bilgileri doldurun.</p>
                    </div>
                    <hr>
                    <div class="doctor-login-left-box-form">
                        <form action="{{ route('doctorloginsave') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="inputAddress2">Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputAddress2"
                                    placeholder="Email">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress2">Şifre</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="inputAddress2"
                                    placeholder="Şifre">
                            </div>

                            <button type="submit" class="btn" style="width: 100%;background-color: gold;">Giriş yap</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">

                <div id="promotion">
                    <div class="owl-carousel">

                        <div class="doctorlogin-right-box">
                            <img src="/img/svg/undraw_Access_account_re_8spm.svg" alt="">
                            <div class="doctorlogin-right-box-text">
                                <h3>Bilgilerini doldur</h3>
                                <p>Bilgilerini doldur, emailini onayla aramıza katıl.</p>
                            </div>
                        </div>

                        <div class="doctorlogin-right-box">
                            <img src="/img/svg/undraw_doctor_kw5l.svg" alt="">
                            <div class="doctorlogin-right-box-text">
                                <h3>Randevu alın veya bir konuyu danışın</h3>
                                <p>Bilgilerini doldur, emailini onayla aramıza katıl. Dilediğin 
                                    gibi randevu oluşturabilir, bir konuyu danışabilirisin.
                                </p>
                            </div>
                        </div>

                        





                    </div>
                </div>


                <script>
                    $(document).ready(function () {
                        $("#promotion .owl-carousel").owlCarousel({
                            loop: true,
                            margin: 10,
                            responsiveClass: true,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                450: {
                                    items: 1
                                },
                                600: {
                                    items: 1
                                },
                                1000: {
                                    items: 1,
                                    loop: true
                                }
                            },
                            autoplay: true,
                            autoplayTimeout: 2000,
                            transition: 500
                        });
                    });
                </script>





            </div>
        </div>
    </div>



@endsection