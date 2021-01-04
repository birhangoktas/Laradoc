   @extends('admin.welcome')

   @section('admin.seo')

   <title>Hoş Geldin</title>
   <meta name="description" content="Doktorları incele, randevu oluştur" />
   @endsection


@section('admin.contect')


<div class="container" style="margin-top: 40px;">
    <div class="row">

        <div class="col-md-6" style="margin-top: 100px;">
            <div class="doctor-header-text-box">
                <p>Doktar</p>
                <h1>Doktorlardan randevu al</h1>
                <span>Doktorlarımıza istediğin konuyu danışabilir veya randevu oluşturabilirsin. 
                    
                </span>
            </div>

            <div class="doctor-header-btn">
                <a href="/doktorlar"><button>Doktorlar</button></a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="doctor-header-img">
                <img src="/img/undraw/undraw_medicine_b1ol.svg" alt="">
            </div>
        </div>

    </div>
</div>


<div class="container">
    <div class="row">
        <div class="doctor-alert-box">
            <div class="row">
                <div class="col-md-4">
                    <p>Ücretsiz randevu oluştur</p>
                    <span>Doktorlarımızı incele, ücretsiz randevu oluştur.
                    </span>
                </div>
                <div class="col-md-4">
                    <p>Görüşmeyi tamamla</p>
                    <span>Doktorlarunuz ile görüşün
                    </span>
                </div>
                <div class="col-md-4">
                    <p>Ücreti onayla</p>
                    <span>Görüşmeyi onayla, doktorunuza ücreti gönder.
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection