   @extends('doctor.welcome')

   @section('doctor.seo')
   <title>Hoş Geldin</title>
   <meta name="description" content="Doktor paneline hoş geldin." />
   @endsection



   @section('doctor.contect')
   @if(session('success_web'))
   <div class="alert alert-success" role="alert" style="max-width:500px;margin-top:20px">
       İşlem başarılı bir şekilde gerçekleştirildi.
   </div>
   @endif

   @if(session('error_web'))
   <div class="alert alert-danger" role="alert" style="max-width:450px;margin:20px">
       Bilgileriniz uyuşmuyor
   </div>
   @endif

   <section id="doctor-price-box">
       <div class="container">
           <div class="row">
               <div class="col-md-6">
                   <div class="doctor-price-text">
                       <h1>Siz uzmanlığınıza odaklanın.
                           Gerisini bize bırakın!</h1>

                       <p>* Randevularınız tek online takvimde ve planlı</p>
                       <p>* Unutulan ve kaçırılan randevulara son</p>
                       <p>* Gereksiz ve cevapsız aramalar artık sorun değil</p>
                       <p>* Size özel web sitesi ile internette %100 etkinlik</p>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="doctor-price-img">
                       <img src="img/png/doctor_PNG16007.png" alt="">
                   </div>
               </div>
           </div>
       </div>

   </section>


   <div class="container">
       <div class="row">
           <div class="doctor-alert-boxaa" style="width:95%;margin:auto;margin-top:-30px">
               <div class="row">
                   <div class="col-md-4">
                       <p><span>5</span> milyon</p>
                       <span>Aylık tekil ziyaretçi sayısı
                       </span>
                   </div>
                   <div class="col-md-4">
                       <p><span>250</span> bin</p>
                       <span>Aylık ortalama randevu işlemi</span>
                   </div>
                   <div class="col-md-4">
                       <p><span>7000</span> 'den fazla</p>
                       <span>Profesyonel üye hekim ve uzman

                       </span>
                   </div>
               </div>
           </div>
       </div>
   </div>
@if($invociecount == 0)

   <div class="container" style="margin-top: 50px;">
       <div class="row justify-content-start">

           <div class="col-md-7">
               

               @if(Auth::guard('doctor')->user()->is_money == 0)
               <div class='card-wrapper'></div>
               <!-- CSS is included via this JavaScript file -->
               <script src="/js/card.js"></script>
               <form action="{{ route('drcheckout') }}" method="post">
                   @csrf

                   <div class="doctor-form-price">

                       <div class="form-group">
                           <label for="text">Kart üzerindeki ismi</label>
                           <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" id="text" placeholder="İsim soyisim">
                       </div>

                       <div class="form-group">
                           <label for="text">Kart numarası</label>
                           <input type="text" class="form-control @error('number') is-invalid @enderror" name="number" id="number" id="text" placeholder="**** **** **** ****">
                       </div>

                       <div class="form-group">
                           <label for="text">Tarih</label>
                           <input type="text" class="form-control @error('expiry') is-invalid @enderror" name="expiry" id="expiry" id="text" placeholder="mm / yyyy">
                       </div>

                       <div class="form-group">
                           <label for="text">Güvenlik kodu</label>
                           <input type="text" class="form-control @error('cvc') is-invalid @enderror" name="cvc" id="cvc" id="text" placeholder="***">
                       </div>

                       <div class="button-doctor-btn">
                           <button>İşlemi tamamla</button>
                       </div>



                   </div>


               </form>


               <script>
                   var card = new Card({
                       form: 'form'
                       , container: '.card-wrapper',

                       messages: {
                           validDate: 'expire\ndate'
                           , monthYear: 'mm/yy'
                       }
                   });

               </script>

               <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
               <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
               <script>
                   var $form = $("form")
                       , $successMsg = $(".alert");
                   $.validator.addMethod("letters", function(value, element) {
                       return this.optional(element) || value == value.match(/^[a-zA-Z\s]*$/);
                   });
                   $form.validate({
                       rules: {
                           cvc: {
                               required: true
                               , minlength: 3
                               , maxlength: 3

                           }
                           , mentor_time: {
                               required: true
                           }
                           , expiry: {
                               required: true

                           }
                           , name: {
                               required: true

                           }
                           , number: {
                               required: true

                           }

                       }
                       , messages: {
                           cvc: "3 haneli güvenlik kodunu giriniz."
                           , email: "Please specify a valid email address"
                           , mentor_time: "Görüşme saatini seçiniz."
                           , expiry: "Tarih bilgini giriniz."
                           , name: "Kartın üzerindeki ismi giriniz."
                           , number: "Kart bilgisini giriniz."

                       }

                   });

               </script>


               @else
               <div class="doctor-form-price">
                   <form action="{{ route('invoicesave') }}" method="post">
                       @csrf
                       <div class="form-row">
                           <div class="form-group col-md-6">
                               <label for="inputEmail4">İsim bilgisi</label>
                               <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputEmail4" placeholder="İsim">
                           </div>
                           <div class="form-group col-md-6">
                               <label for="inputPassword4">Soyisim bilgisi</label>
                               <input type="text" class="form-control @error('last') is-invalid @enderror" name="last" id="inputPassword4" placeholder="Soyisim">
                           </div>
                       </div>

                       <div class="form-group">
                           <label for="inputAddress">Email bilgisi</label>
                           <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputAddress" placeholder="Email">
                       </div>

                       <div class="form-group">
                           <label for="inputAddress">Telefon numrası</label>
                           <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="inputAddress" placeholder="Telefon numrası">
                       </div>
                       <div class="form-group">
                           <label for="inputAddress2">Adres bilgisi</label>
                           <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="inputAddress2" placeholder="Adres bilgisi">
                       </div>
                       <div class="form-row">
                           <div class="form-group col-md-6">
                               <label for="inputCity">Ülke</label>
                               <input type="text" class="form-control @error('country') is-invalid @enderror" name="country" id="inputCity" placeholder="Türkiye">
                           </div>
                           <div class="form-group col-md-4">
                               <label for="inputCity">Şehir</label>
                               <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="inputCity" placeholder="Samsun">
                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputZip">Şehir kodu</label>
                               <input type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" id="inputZip">
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="form-check">

                               <label class="form-check-label" for="gridCheck" style="margin-left: -15px;">
                                   Hizmet sözleşmesini ve gizlilik sözleşmesini, okudum ve onaylıyorum.
                               </label>
                           </div>
                       </div>
                       <button type="submit" class="btn" style="background-color: gold;">Tamamla</button>
                   </form>
               </div>


               @endif
           </div>
           <div class="col-md-5">
               <div class="doctor-property-list-box" style="max-width: 400px;">
                   <div class="doctor-property-list-center">
                       <p>PROFESYONEL ÜYELİK</p>
                       <span>459 TL (Tek seferlik + kdv)</span>
                       <div class="doctor-property-list-buy">
                           <button>Satın Al</button>
                       </div>

                       <hr>
                       <div class="doctor-property-list">
                           <p><i class="far fa-check-circle"></i> <span>Fatura bilgilerini doldur</span></p>
                       </div>
                       <div class="doctor-property-list">
                           <p><i class="far fa-check-circle"></i> <span>Ödeme işlemini tamamla</span></p>
                       </div>
                       <div class="doctor-property-list">
                           <p><i class="far fa-check-circle"></i> <span>Randevu almaya başla</span></p>
                       </div>
                   </div>

               </div>
           </div>
       </div>
   </div>
   @else

   <div class="container" style="margin-top: 40px;">
    <div class="row">

        <div class="col-md-6" style="margin-top: 100px;">
            <div class="doctor-header-text-box">
                <p>Doktar</p>
                <h1>Abone olduğunuz için teşekkür ederiz.</h1>
                <span>Hemen doktorluk ilanınızı oluşturabilir, hastalarınıza yardımcı olabilirsiniz. 
                    
                </span>
            </div>

            <div class="doctor-header-btn">
                <a href="/dr/ilan-olustur"><button>İlan oluştur</button></a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="doctor-header-img">
                <img src="/img/undraw/undraw_medicine_b1ol.svg" alt="">
            </div>
        </div>

    </div>
</div>

   @endif
   @endsection
