@extends('welcome')

@section('welmome.seo')
<title>Kayıt Oluştur</title>
<meta name="description" content="Doktorlarımız ile görüşebilmek için lütfen kayıt olun." />
@endsection

@section('welmome.contect')



@if(session('success_web'))

<div class="container" style="margin-top:50px">
    <div class="row">
        <div class="col-md-6" style="max-width:500px;margin-top:100px">
            <div class="success_web_text">
            <h1>Aramıza hoş geldin, Haydi! mailini onayla aramıza katıl.</h1> 
            <p>İşlem başarılı bir şekilde tamamlamak için emailinize gelen linke tıklayarak
            giriş yap sayfasına gönlendirilmeniz gerekiyor.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="success_web_img">
                <img src="/img/undraw/undraw_order_confirmed_aaw7.png">
            </div>
        </div>
    </div>
</div>

@else


<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="doctor-login-left-box">
                <div class="doctor-login-left-box-text">
                    <h1>Hemen kayıt olun, doktorlardan randevu alın</h1>
                    <p>Kayıt olmak için aşağıdaki bilgileri doldurun.</p>
                </div>

                <div class="sig">
                    <a href="auth/linkedin"><i class="fab fa-linkedin"></i> <span style="padding-left:5px">Linkedin ile Giriş Yap</span></a>
                </div>
                <hr>
                <div class="doctor-login-left-box-form">
                    <form action="{{ route('usersave') }}" method="post">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">İsim</label>
                                <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" id="inputEmail4" placeholder="isim">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Soyisim</label>
                                <input type="text" name="last" class="form-control @error('last') is-invalid @enderror" id="inputPassword4" placeholder="Soyisim">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress2">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputAddress2" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="inputAddress2">Telefon numarası</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="inputAddress2" placeholder="Telefon numarası">
                        </div>

                        <div class="form-group">
                            <label for="inputAddress2">Şifre</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="inputAddress2" placeholder="Şifre">
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Hizmet politikasını ve gizlik politikasını, okudum ve onaylıyorum.
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="width: 100%;background-color: gold;">Kayıt ol</button>


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
                $(document).ready(function() {
                    $("#promotion .owl-carousel").owlCarousel({
                        loop: true
                        , margin: 10
                        , responsiveClass: true
                        , responsive: {
                            0: {
                                items: 1
                            }
                            , 450: {
                                items: 1
                            }
                            , 600: {
                                items: 1
                            }
                            , 1000: {
                                items: 1
                                , loop: true
                            }
                        }
                        , autoplay: true
                        , autoplayTimeout: 2000
                        , transition: 500
                    });
                });

            </script>





        </div>
    </div>
</div>
@endif


@endsection
