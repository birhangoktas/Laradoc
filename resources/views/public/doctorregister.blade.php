@extends('welcome')

@section('welmome.seo')
<title>Doktorluk Başvuru Formu</title>
<meta name="description" content="Doktorluk başvuru formunu doldur, aramıza katıl." />
@endsection

@section('welmome.contect')

@if(session('error_web'))

<div class="alert alert-warning" role="alert" style="max-width:450px;margin:20px">
    Bir hata oluştu. Hatayı yetkili ekimimize iletiyor, en kısa sürede hatayı gideriyor olacağız.
</div>

@endif


@if(session('success_web'))

<div class="container" style="margin-top:50px">
    <div class="row">
        <div class="col-md-6" style="max-width:500px;margin-top:100px">
            <div class="success_web_text">
            <h1>Aramıza hoş geldin, en kısa sürede emailini onaylıyor olcağız</h1> 
            <p>İşlem başarılı bir şekilde tamamlanırsa emailinize ve telefon numaranıza işlemin başarılı bir şekilde
            tamamlandığı bildiriyor olacağız.</p>
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
                    <h1>Hemen kayıt olun, hizmet vermeye başlayın</h1>
                    <p>Kayıt olmak için aşağıdaki bilgileri doldurun.</p>
                </div>
                <hr>
                <div class="doctor-login-left-box-form">
                    <form action="{{ route('doctorregistersave') }}" method="post" enctype="multipart/form-data">
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
                            <label for="inputAddress2">Ünvanınız</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="inputAddress2" placeholder="Prof.Dr.Uğur Şahin">
                        </div>


                        <div class="form-group">
                            <label for="inputAddress2">Telefon numarası</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="inputAddress2" placeholder="Telefon numarası">
                        </div>

                        <div class="form-group">
                            <label for="inputAddress2">T.C Numarası</label>
                            <input type="text" class="form-control @error('tc') is-invalid @enderror" name="tc" id="inputAddress2" placeholder="T.C Numarası">
                        </div>

                        <div class="custom-file">
                            <input type="file" name="profil" class="custom-file-input  @error('profil') is-invalid @enderror" id="customFile">
                            <label class="custom-file-label" for="customFile">Profil resmi</label>
                        </div>


                        <div class="form-group">
                            <label for="inputAddress2">Şifre</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="inputAddress2" placeholder="Şifre">
                        </div>

                        <div class="form-group">
                            <div class="form-check">

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
                        <img src="img/svg/undraw_Access_account_re_8spm.svg" alt="">
                        <div class="doctorlogin-right-box-text">
                            <h3>Bilgilerini doldur</h3>
                            <p>Bilgilerini dolduruktan sonra bir onay sürecinden geçeceksininz.
                                İşlem başarılı bir şekilde tamamlanırsa E-mailinize ve telefon numaranıza
                                işlemin başarılı olduğuna dair bir mesaj göndereceğiz.
                            </p>
                        </div>
                    </div>

                    <div class="doctorlogin-right-box">
                        <img src="img/svg/undraw_doctor_kw5l.svg" alt="">
                        <div class="doctorlogin-right-box-text">
                            <h3>Hizmet vermeye başlayın</h3>
                            <p>İşleminiz onaylandığı takdirde hastalarımıza hizmet vermeye
                                başlayabilirsiniz.
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
