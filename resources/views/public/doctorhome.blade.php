@extends('welcome')


@section('welmome.contect')

@foreach($data as $datakey)

@section('welmome.seo')
<title>Doktor | {{$datakey->name.' '.$datakey->last}} | {{ $datakey->profession }}</title>
<meta name="description" content="Doktorları incele, randevu oluştur" />
@endsection


@if(session('success_invoice'))
<div class="alert alert-warning" role="alert" style="max-width:450px;margin-top:20px">
    Başarılı bir şekilde, fatura bilgileri alındı.
</div>

@endif

@if(session('success_invoice'))
<div class="alert alert-warning" role="alert" style="max-width:450px;margin-top:20px">
    Başarılı bir şekilde, fatura bilgileri alındı.
</div>
@endif


@if(session('non_comment'))
<div class="alert alert-warning" role="alert" style="max-width:450px;margin-top:20px">
    Doktorunuza saten bir mesaj gönderdiniz.
</div>

@endif


@if(session('success_comment'))
<div class="alert alert-success" role="alert" style="max-width:450px;margin-top:20px">
    Başarılı bir şekilde, mesajınız gönderildi.
</div>

@endif


<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="doctorhome-left-page">
                <div class="row d-flex">

                    <div class="doctorhome-left-page-logo" style="width: 20%;">
                        <img src="/projectlogo/{{ $datakey->projectlogo }}" alt="">
                    </div>


                    <div class="doctorhome-left-page-text" style="width: 80%;">
                        <span>{{ $datakey->name.' '.$datakey->last }}</span>
                        <p>{{ $datakey->profession }}</p>
                        <hr>
                        <p>30 dakikalık randevu ücreti: {{ $datakey->appointment_price }} <i class="fas fa-lira-sign"></i></p>
                    </div>

                </div>
            </div>

            <div class="doctorhome-left-page">
                <span>Önemli bilgiler</span>
                <hr>
                <p><i class="fas fa-globe-americas"></i>
                    <span style="padding-left:5px;color: #000;">Online Danışmanlık</span>
                </p>
                <hr>
                <p><i class="fas fa-smile-wink"></i>
                    <span style="padding-left:5px;color: #000;">Yüz Yüze Bulaşma</span>
                </p>
                <hr>
                <p><i class="fas fa-user-friends"></i>
                    <span style="padding-left:5px;color: #000;">Kabul edilen yaş grubu: yetişkin, her yaştan
                        çocuk</span>
                </p>
                <hr>

                <p><i class="fas fa-globe-americas"></i>
                    <span style="padding-left:5px;color: #000;">Sigortası olan hastalar ve sigortasız
                        hastalar</span>
                </p>

                <hr>

                <p><i class="fas fa-lira-sign"></i>
                    <span style="padding-left:5px;color: #000;">Banka Havalesi</span>
                </p>


                <hr>
            </div>



            <div class="doctorhome-left-page">
                <span>Özgeçmiş</span>
                <hr>

                <div class="row">
                    <div style="width: 5%;justify-content: center;text-align: center;"><i class="far fa-address-card"></i></div>
                    <div style="width: 95%;">
                        <span>Hakkımda</span>
                        <p>{{$datakey->my_about}}</p>
                    </div>
                </div>

                <hr>


                <div class="row">
                    <div style="width: 5%;justify-content: center;text-align: center;"><i class="fas fa-user-injured"></i></div>
                    <div style="width: 95%;">
                        <span>Tedavi edilen hastalıklar</span>
                        <ul style="font-family: Baloo Bhaijaan;font-size:14px">
                            @foreach($diseasedata as $diseasedatakey)
                            <li>{{ $diseasedatakey->diseases }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div style="width: 5%;justify-content: center;text-align: center;"><i class="fas fa-graduation-cap"></i></div>
                    <div style="width: 95%;">
                        <span>Okullar / Eğitimler</span>
                        <ul style="font-family: Baloo Bhaijaan;font-size:14px">
                            @foreach($schooldata as $schooldatakey)
                            <li>{{ $schooldatakey->schools }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            @if(count($userpayment) == 1)
            <div class="doctorhome-left-page">
                @auth

                <div class="doctor-form-price" style="margin-top:0px">

                    <form action="{{ route('doctorcommentsave',[$datakey->user_id,Auth()->user()->user_id]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="text">Kart üzerindeki ismi</label>
                            <input type="text" class="form-control  @error('namelast') is-invalid @enderror" name="namelast" id="text" placeholder="İsim soyisim">
                        </div>
                        <div class="form-group">
                            <label for="text">Doktorunuza puan verin</label>
                            <input type="number" class="form-control  @error('name') is-invalid @enderror" name="puan" id="text" min="1" max="5" placeholder="Doktorunuza 1 - 5 arası bir puan diliminde puanlayın.">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control  @error('comment') is-invalid @enderror" name="comment" placeholder="Müşteri yorumunuz"></textarea>
                        </div>

                        <div class="button-doctor-btn">
                            <button>İşlemi tamamla</button>
                        </div>

                    </form>
                </div>

                <hr>

                @endauth
            </div>
            @endif


            @if(count($doctorcomment) >= 1)

            <div class="doctorhome-left-page">
                <span>Kullanıcı Yorumları</span>
                <hr />
                @foreach($doctorcomment as $doctorcommentkey)

                <div class="row">
                    <div style="">
                        <p>{{ $doctorcommentkey->namelast }}</p>
                        <p style="color:gold">{{ $doctorcommentkey->comment }}</p>
                    </div>
                </div>
                <hr />
                @endforeach
            </div>
            @endif

        </div>

        @guest
        <div class="col-md-5">
            <div class="questlogin">
                <img src="/img/svg/undraw_Access_account_re_8spm.svg">
                <div class="questlogin-text">
                    <h4>Randevu işlemine devam etmek için, üye olun.</h4>
                    <p>Üye olarak randevu işlemi oluşturabilir veya ücretsiz bir şekilde doktorlarımıza
                        mesaj gönderebilirsiniz.</p>
                </div>
            </div>
        </div>
        @endguest


        @auth


        <div class="col-md-5">
            <div class="doctorhome-right-box">
                <div class="doctorhome-right-box-text">
                    <span>Randevu al</span>
                    <p>Sitemiz üzerinden randevu oluşturmak ücretsizdir. Muayene/danışmanlık ücret bilgisi için
                        doktorunuza/uzmanınıza başvurunuz</p>
                </div>
                @if(count($userinvoices) == 0)

                <div class="doctor-form-price" style="box-shadow: 0 2px 0.75rem -3px rgba(37, 51, 66, .5);">

                    <form action="{{ route('userinvoicesave') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <label for="text">İsim</label>
                                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="İsim">
                            </div>
                            <div class="col">
                                <label for="text">Soyisim</label>
                                <input type="text" class="form-control  @error('last') is-invalid @enderror" name="last" placeholder="Soyisim">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="text">Email</label>
                            <input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" id="email" id="text" placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label for="text">Adres</label>
                            <input type="text" class="form-control  @error('address') is-invalid @enderror" name="address" id="address" id="text" placeholder="Adres">
                        </div>

                        <div class="form-group">
                            <label for="text">Telefon</label>
                            <input type="number" class="form-control  @error('phone') is-invalid @enderror" name="phone" id="phone" id="text" placeholder="Telefon">
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label for="text">Ülke</label>
                                <input type="text" class="form-control  @error('country') is-invalid @enderror" name="country" placeholder="Ülke">
                            </div>
                            <div class="col">
                                <label for="text">Şehir</label>
                                <input type="text" class="form-control  @error('city') is-invalid @enderror" name="city" placeholder="Şehir">
                            </div>
                            <div class="col">
                                <label for="text">Posta kodu</label>
                                <input type="text" class="form-control  @error('zip') is-invalid @enderror" name="zip" placeholder="Posta kodu">
                            </div>
                        </div>


                        <div class="button-doctor-btn">
                            <button>İşlemi tamamla</button>
                        </div>



                    </form>


                </div>
                @else

                <div class="doctorhome-right-calendar">

                    <span>Randevu Tarihi Oluştur</span>
                    <form action="{{ route('doctorbuy', [$datakey->user_id,Auth()->user()->user_id] ) }}" method="post">
                        @csrf
                        <div class="mentor-time-box">
                            <div class="container-fluid">
                                <div class="row">

                                    <div class="col-md-9">
                                        <div class="input-group mb-3">
                                            <input type="text" name="doctor_date" class="form-control  @error('projectlogo') is-invalid @enderror" id="daterange" />
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                        <div class="alert alert-warning" role="alert" style="max-width:300px">
                                            Müşteri hizmetleri için <b><a href="/iletisim" target="_blank" style="color:#856404;"><u>0(850) xxx xx xx</u></a></b> telefon numarası
                                            ile iletişime geçebilirsin.
                                            <hr />
                                            Olumsuz bir görüşme gerçekleştirirseniz veya rezervasyon işlemini iptal etmek
                                            istiyorsanız, lütfen bizim ile <a href="/iletisim" target="_blank" style="color:#856404;"><u>iletişime</u></a> geçin.<b></b>
                                        </div>

                                    </div>

                                    <div class="col-md-3">
                                        <div id="html-time">
                                            <div class="radio-sellect">
                                                @foreach($timedata as $timedatakey)
                                                <div class="radio">
                                                    <input type="radio" label="{{ Carbon\Carbon::parse($timedatakey->doctor_time)->format('H:i') }}" value="{{ Carbon\Carbon::parse($timedatakey->doctor_time)->format('H:i') }}" name="doctor_time" id="doctor_time" checked />
                                                </div>
                                                @endforeach




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class='card-wrapper'></div>
                            <!-- CSS is included via this JavaScript file -->
                            <script src="/js/card.js"></script>

                            <div class="doctor-form-price" style="box-shadow: 0 2px 0.75rem -3px rgba(37, 51, 66, .5);">

                                <div class="form-group">
                                    <label for="text">Kart üzerindeki ismi</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" id="text" placeholder="İsim soyisim">
                                </div>

                                <div class="form-group">
                                    <label for="text">Kart numarası</label>
                                    <input type="text" class="form-control  @error('number') is-invalid @enderror" name="number" id="number" id="text" placeholder="**** **** **** ****">
                                </div>

                                <div class="form-group">
                                    <label for="text">Tarih</label>
                                    <input type="text" class="form-control  @error('expiry') is-invalid @enderror" name="expiry" id="expiry" id="text" placeholder="mm / yyyy">
                                </div>

                                <div class="form-group">
                                    <label for="text">Güvenlik kodu</label>
                                    <input type="text" class="form-control  @error('cvc') is-invalid @enderror" name="cvc" id="cvc" id="text" placeholder="***">
                                </div>

                                <hr>

                                <div class="form-group">
                                    <textarea class="form-control  @error('doctor_message') is-invalid @enderror" name="doctor_message" id="doctor_message" placeholder="Mesaj kutusu"></textarea>
                                </div>

                                <div class="button-doctor-btn">
                                    <button>İşlemi tamamla</button>
                                </div>



                            </div>





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

                                        },
                                        doctor_message : {
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
                                        , doctor_message: "Lütfen doktorunuza bir mesaj gönderin"

                                    }

                                });

                            </script>
                    </form>
                </div>




                @endif










            </div>



            <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js">
            </script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js">
            </script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
            <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


            <script>
                $('input[name="doctor_date"]').daterangepicker({

                    "singleDatePicker": true
                    , "timePickerIncrement": 2
                    , "locale": {
                        "format": "DD-MM-YYYY"
                        , "separator": " - "
                        , "applyLabel": "Onayla"
                        , "cancelLabel": "Kapat"
                        , "fromLabel": "Dan"
                        , "toLabel": "a"
                        , "customRangeLabel": "Sen seç"
                        , "weekLabel": "W"
                        , "daysOfWeek": [
                            "Pt", "Sl", "Çr", "Pr", "Cm", "Ct", "Pz"
                        ]
                        , "monthNames": [
                            "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz"
                            , "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"
                        ]
                        , "firstDay": 1
                    }
                    , "linkedCalendars": false
                    , "showCustomRangeLabel": false
                    , "parentEl": "body"
                    , "startDate": "{{ Carbon\Carbon::parse($datakey->doctor_startdate)->format('d-m-Y')}}"
                    , "endDate": " {{ Carbon\Carbon::parse($datakey->doctor_enddate)->format('d-m-Y')}} "
                    , "minDate": "{{ Carbon\Carbon::parse('now')->format('d-m-Y') }}"
                    , "maxDate": "{{ Carbon\Carbon::parse($datakey->doctor_enddate)->format('d-m-Y')}}"
                    , "drops": "down"
                    , parentEl: "#inline-calendar"
                    , alwaysShowCalendars: true
                    , autoApply: true
                    , inline: true


                }, function(start, end, label) {
                    console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' +
                        end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '/saat-ayarla/' + start.format(
                            'DD-MM-YYYY'), // need to create this route
                        data: ""
                        , cache: false
                        , type: "GET"
                        , dataType: 'html'
                        , success: function(data) {
                            $('#html-time').html(data);


                        }
                        , error: function(result) {
                            console.log(result);
                        }
                    });


                });

            </script>
        </div>
    </div>



    @endauth
</div>
</div>


@endforeach


@endsection
