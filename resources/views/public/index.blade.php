@extends('welcome')


@section('welmome.seo')

<title>Doktor Bul | Ön Görüşme Yap</title>
<meta name="description" content="Doktorluk başvursunda bulunabilir, doktorlarımız ile görüşme yapabilirsin." />

@endsection


@section('welmome.contect')

<div class="container" style="margin-top: 90px;">
    <div class="row">

        <div class="col-md-6" style="margin-top: 100px;">
            <div class="doctor-header-text-box">
                <p>Doktar</p>
                <h1>Doktorlardan randevu al</h1>
                <span>Doktorlarımıza istediğin konuyu danışabilir veya doktorluk başvurusunda
                    bulunabilirsin.
                </span>
            </div>

            <div class="doctor-header-btn">
                <a href="uyelik-sistemi"><button>Ücretsiz Kaydol</button></a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="doctor-header-img">
                <img src="img/undraw/undraw_medicine_b1ol.svg" alt="">
            </div>
        </div>

    </div>
</div>


<div class="container">
    <div class="row">
        <div class="doctor-alert-box">
            <div class="row">
                <div class="col-md-4">
                    <p>Doktorluk başvurusunda bulun</p>
                    <span>Kendi alanınız ile ilgili hizmet vermek için doktorluk
                        başvursunda bunabilirsiniz.
                    </span>
                </div>
                <div class="col-md-4">
                    <p>Başvurun onaylansın</p>
                    <span>Tüm gerekli bilgileri doldurun, ekibimiz
                        sizin ile iletişime geçin.
                    </span>
                </div>
                <div class="col-md-4">
                    <p>Hizmet vermeye başlayın</p>
                    <span>Bilgileriniz onaylandığı taktirde, kullanıcılarımıza hizmet vermeye
                        başlayın.
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>






<div class="container" style="margin-top: 50px;">
    <div class="end-doctor-list-title" style="margin-left: 10px;">
        <span>Son eklenen doktarlar</span>
    </div>
    <div class="row" style="margin-top: 20px;">
        @foreach($doctors as $doctorskey)

        <div class="col-md-3">
            <div class="doctor-box-width" style="width:100%">
                <div class="doctor-box-img">
                    <img src="/projectlogo/{{ $doctorskey->projectlogo }}" alt="Doktor logo" width="150" height="150">
                </div>

                <div class="doctor-padding-20" style="padding: 20px;">
                    <div class="doctor-box-text">
                        <p>{{ $doctorskey->name.' '.$doctorskey->last }}</p>
                        <span class="text-limit-2" style="color:#000">{{ $doctorskey->my_about }}
                        </span>
                    </div>
                    <div class="doctor-home-btn">
                        <a href="{{ route('doctorexamined',[$doctorskey->name_url,$doctorskey->project_url,$doctorskey->user_id]) }}"><button>Randevu al</button></a>
                    </div>

                    <hr />
                    <span>{{ $doctorskey->profession }}</span>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection
