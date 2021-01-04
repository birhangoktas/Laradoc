   @extends('root.welcome')

   @section('root.seo')

   <title>Hoş Geldin | ROOT </title>
   <meta name="description" content="Hello" />
   @endsection


   @section('root.contect')



   @if(session('success'))
   <div class="alert alert-success" role="alert" style="max-width:500px;margin-top:20px">
       İşlem başarılı bir şekilde gerçekleştirildi.
   </div>
   @endif

   <div class="container">
       <div class="row">
           <div class="form-doctor-project">
               @foreach($doctorproject as $doctorprojectkey)
               <form action="{{ route('rootdoctorupdate',$doctorprojectkey->user_id) }}" method="post" enctype="multipart/form-data">
                   @csrf
                   <div class="form-row">
                       <div class="col">
                           <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $doctorprojectkey->name }}" placeholder="İsim">
                       </div>
                       <div class="col">
                           <input type="text" class="form-control @error('last') is-invalid @enderror" name="last" value="{{ $doctorprojectkey->last }}" placeholder="Soyisim">
                       </div>
                   </div>

                   <div class="form-row">
                       <div class="col">
                           <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $doctorprojectkey->email }}" placeholder="Email">
                       </div>
                       <div class="col">
                           <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $doctorprojectkey->phone }}" placeholder="Telefon numarası">
                       </div>
                   </div>

                   <div class="form-group">
                       <input type="number" class="form-control @error('appointment_price') is-invalid @enderror" value="{{ $doctorprojectkey->appointment_price }}" name="appointment_price" placeholder="Randevu ücreti">
                   </div>

                   <div class="form-group">
                       <textarea type="text" class="form-control @error('my_about') is-invalid @enderror" name="my_about" placeholder="Kendinizi tanıtın">{{ $doctorprojectkey->my_about }}</textarea>
                   </div>

                   <div class="form-group">

                       <span>Alanınız</span>

                       <select class="js-example-disabled-results @error('profession') is-invalid @enderror" style="height: 45px;width: 100%;border:none;" name="profession">
                           <option selected>{{ $doctorprojectkey->profession }}</option>
                           <option value="İç Hastalıkları">İç Hastalıkları
                           <option value="Kardiyoloji">Kardiyoloji</option>
                           <option value="Göğüs Hastalıkları">Göğüs Hastalıkları</option>
                           <option value="Enfeksiyon Hastalıkları">Enfeksiyon Hastalıkları</option>
                           <option value="Nöroloji">Nöroloji</option>
                           <option value="Psikiyatri">Psikiyatri</option>
                           <option value="Çocuk Sağlığı ve Hastalıkları">Çocuk Sağlığı ve Hastalıkları</option>
                           <option value="Çocuk Psikiyatrisi">Çocuk Psikiyatrisi</option>
                           <option value="Dermatoloji">Dermatoloji</option>
                           <option value="Fiziksel Tıp ve Rehabilitasyon">Fiziksel Tıp ve Rehabilitasyon</option>
                           <option value="Genel Cerrahi">Genel Cerrahi</option>
                           <option value="Çocuk Cerrahisi">Çocuk Cerrahisi</option>
                           <option value="Göğüs Cerrahisi">Göğüs Cerrahisi</option>
                           <option value="Kalp ve Damar Cerrahisi">Kalp ve Damar Cerrahisi</option>
                           <option value="Beyin ve Sinir Cerrahisi">Beyin ve Sinir Cerrahisi</option>
                           <option value="Ortopedi ve Travmatoloji">Ortopedi ve Travmatoloji</option>
                           <option value="Üroloji">Üroloji</option>
                           <option value="Kulak-Burun-Boğaz Hastalıkları">Kulak-Burun-Boğaz Hastalıkları</option>
                           <option value="Göz Hastalıkları">Göz Hastalıkları</option>
                           <option value="Kadın Hastalıkları ve Doğum">Kadın Hastalıkları ve Doğum</option>
                           <option value="Anesteziyoloji ve Reanimasyon">Anesteziyoloji ve Reanimasyon</option>
                           <option value="Radyasyon Onkolojisi">Radyasyon Onkolojisi</option>
                           <option value="Radyoloji">Radyoloji</option>
                           <option value="Nükleer Tıp">Nükleer Tıp</option>
                           <option value="Tıbbi Patoloji">Tıbbi Patoloji</option>
                           <option value="Tıbbi Genetik">Tıbbi Genetik</option>
                           <option value="Tıbbi Biyokimya">Tıbbi Biyokimya</option>
                           <option value="Tıbbi Mikrobiyoloji">Tıbbi Mikrobiyoloji</option>
                           <option value="Tıbbi Farmakoloji">Tıbbi Farmakoloji</option>
                           <option value="Spor Hekimliği">Spor Hekimliği</option>
                           <option value="Askeri Sahra Hekimliği">Askeri Sahra Hekimliği</option>
                           <option value="Hava ve Uzay Hekimliği">Hava ve Uzay Hekimliği</option>
                           <option value="Sualtı Hekimliği ve Hiperbarik Tıp">Sualtı Hekimliği ve Hiperbarik Tıp</option>
                           <option value="Acil Tıp">Acil Tıp</option>
                           <option value="3Adli Tıp">3Adli Tıp</option>
                           <option value="Halk Sağlığı">Halk Sağlığı</option>
                           <option value="Fizyoloji">Fizyoloji</option>
                           <option value="Aile Hekimliği">Aile Hekimliği</option>
                           <option value="Anatomi">Anatomi</option>
                           <option value="Embriyoloji ve Histoloji">Embriyoloji ve Histoloji</option>

                       </select>


                       <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js">
                       </script>
                       <script>
                           var $disabledResults = $(".js-example-disabled-results");
                           $disabledResults.select2();
                           $('.js-example-basic-multiple').select2();

                       </script>
                   </div>


                   <div class="custom-file">
                       <input type="file" name="projectlogo" class="custom-file-input  @error('projectlogo') is-invalid @enderror" id="customFile">
                       <label class="custom-file-label" for="customFile">Logo yükle</label>
                   </div>

                   <div class="custom-file" style="margin-top:10px">
                       <input type="file" name="projectimages" class="custom-file-input  @error('projectimages') is-invalid @enderror" id="customFile">
                       <label class="custom-file-label" for="customFile">Resim yükle</label>
                   </div>


                   <script src="https://code.jquery.com/jquery-latest.js"></script>
                   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
                   <table class="table table-responsive table-striped table-bordered" style="width:100%;margin-top:10px">
                       <thead>
                           <tr>
                               <td>Tedavi edilen hastalıklar</td>
                               <td>Sil</td>
                           </tr>
                       </thead>
                       <tbody id="TextBoxContainer" style="width:100%">

                           @foreach($doctordisease as $doctordiseasekey)

                           <tr>
                               <td style="width:100%"><input type="text" name="diseases[]" placeholder="Tedavi edilen hastalıklar" class="form-control @error('
                               password ') is-invalid @enderror" value="{{ $doctordiseasekey->diseases }}"></td>
                               <td style="width:10%"><button type="button" class="btn btn-danger remove"><i class="far fa-trash-alt"></i></button></td>

                           </tr>
                           @endforeach
                       </tbody>
                       <tfoot>
                           <tr>
                               <th colspan="5">
                                   <button id="coronabtn" type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Ekle &nbsp;</button></th>
                           </tr>
                       </tfoot>
                       <script>
                           $(function() {
                               $("#coronabtn").bind("click", function() {
                                   var div = $("<tr />");
                                   div.html(GetDynamicTextBox(""));

                                   $("#TextBoxContainer").append(div);
                                   $('.custom-file input').change(function(e) {
                                       $(this).next('.custom-file-label').html(e.target.files[0].name);
                                   });
                               });
                               $("body").on("click", ".remove", function() {
                                   $(this).closest("tr").remove();
                               });
                           });

                           function GetDynamicTextBox(value) {
                               return '<td style="width:100%"><input type="text" name="diseases[]" placeholder="Tedavi edilen hastalıklar" class="form-control @error('
                               password ') is-invalid @enderror"></td>' + '<td style="width:10%"><button type="button" class="btn btn-danger remove"><i class="far fa-trash-alt"></i></button></td>'
                           }

                       </script>
                   </table>


                   <table class="table table-responsive table-striped table-bordered" style="width:100%;margin-top:10px">
                       <thead>
                           <tr>
                               <td>Okullar / Kurslar</td>
                               <td>Sil</td>
                           </tr>
                       </thead>
                       <tbody id="TextBoxSchoolContainer" style="width:100%">

                           @foreach($doctorschool as $doctorschoolkey)

                           <tr>
                               <td style="width:100%"><input type="text" name="schools[]" placeholder="Okullar / Kurslar" class="form-control @error('
                               password ') is-invalid @enderror" value="{{ $doctorschoolkey->schools }}"></td>
                               <td style="width:10%"><button type="button" class="btn btn-danger remove"><i class="far fa-trash-alt"></i></button></td>

                           </tr>
                           @endforeach
                       </tbody>
                       <tfoot>
                           <tr>
                               <th colspan="5">
                                   <button id="schoolbtn" type="button" class="btn btn-primary" data-toggle="tooltip" data-original-title="Add more controls"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Ekle &nbsp;</button></th>
                           </tr>
                       </tfoot>
                       <script>
                           $(function() {
                               $("#schoolbtn").bind("click", function() {
                                   var div = $("<tr />");
                                   div.html(GetDynamicTextSchoolBox(""));

                                   $("#TextBoxSchoolContainer").append(div);
                                   $('.custom-file input').change(function(e) {
                                       $(this).next('.custom-file-label').html(e.target.files[0].name);
                                   });
                               });
                               $("body").on("click", ".remove", function() {
                                   $(this).closest("tr").remove();
                               });
                           });

                           function GetDynamicTextSchoolBox(value) {
                               return '<td style="width:100%"><input type="text" name="schools[]" placeholder="Okullar / Kurslar" class="form-control @error('
                               password ') is-invalid @enderror"></td>' + '<td style="width:10%"><button type="button" class="btn btn-danger remove"><i class="far fa-trash-alt"></i></button></td>'
                           }

                       </script>



                   </table>



                   <div class="input-group mb-3" style="margin-top:10px">
                       <input type="text" name="doctor_date" class="form-control @error('doctor_date') is-invalid @enderror" id="daterange" value="{{ $doctorprojectkey->doctor_startdate }} - {{ $doctorprojectkey->doctor_enddate }}" />
                       <div class="input-group-append">
                           <span class="input-group-text" id="basic-addon2"><i class="far fa-calendar-alt"></i></span>
                       </div>
                   </div>


                   <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
                   <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
                   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
                   <script>
                       $('input[name="doctor_date"]').daterangepicker({


                           "timePicker24Hour": true
                           , "opens": "left"
                           , "drops": "up"
                           , "applyClass": "btn btn-xs btn-default"
                           , "cancelClass": "btn btn-xs btn-link"
                           , ranges: {
                               'Bugün': [moment(), moment()]
                               , 'Son 7 gün': [moment().subtract(6, 'days'), moment()]
                               , 'Son 30 gün': [moment().subtract(29, 'days'), moment()]
                               , 'Bu ay': [moment().startOf('month'), moment().endOf('month')]
                               , 'Son 1 yıl': [moment().startOf('year'), moment().endOf('year')]
                           }
                           , "locale": {
                               "format": "YYYY-MM-DD"
                               , "separator": " - "
                               , "applyLabel": "Uygula"
                               , "cancelLabel": "Vazgeç"
                               , "fromLabel": "Dan"
                               , "toLabel": "a"
                               , "customRangeLabel": "Sen seç"
                               , "daysOfWeek": [
                                   "Pt"
                                   , "Sl"
                                   , "Çr"
                                   , "Pr"
                                   , "Cm"
                                   , "Ct"
                                   , "Pz"
                               ]
                               , "monthNames": [
                                   "Ocak"
                                   , "Şubat"
                                   , "Mart"
                                   , "Nisan"
                                   , "Mayıs"
                                   , "Haziran"
                                   , "Temmuz"
                                   , "Ağustos"
                                   , "Eylül"
                                   , "Ekim"
                                   , "Kasım"
                                   , "Aralık"
                               ]
                               , "firstDay": 1
                           }

                       });

                   </script>


                   <div class="container" style="margin-top:10px">
                       <span style="font-family: Baloo Bhaijaan;">Hangi saatlerde hizmet vermek istiyorsun?</span>
                       <div class="row">

                           @foreach($houradd as $houraddkey)
                           <div class="col-md-2">
                               <div class="input-group mb-3">
                                   <div class="input-group-prepend">
                                       <div class="input-group-text">
                                           <input type="checkbox" name="time_add[]" value="{{ $houraddkey->doctor_time }}" aria-label="Checkbox for following text input">
                                       </div>
                                   </div>
                                   <input type="time" class="form-control" value="{{ $houraddkey->doctor_time }}">
                               </div>
                           </div>
                           @endforeach
                       </div>
                   </div>



                   <div class="container" style="margin-top:10px">
                       <span style="font-family: Baloo Bhaijaan;">Silmek istediğin zamanları seçin?</span>
                       <div class="row">

                           @foreach($doctortime as $doctortimekey)
                           <div class="col-md-2">
                               <div class="input-group mb-3">
                                   <div class="input-group-prepend">
                                       <div class="input-group-text">
                                           <input type="checkbox" name="time_delete[]" value="{{ $doctortimekey }}" aria-label="Checkbox for following text input">
                                       </div>
                                   </div>
                                   <input type="time" class="form-control" value="{{ $doctortimekey }}">
                               </div>
                           </div>
                           @endforeach
                       </div>
                   </div>



                   <div class="button-doctor-btn">
                       <button>İşlemini tamamla</button>
                   </div>

               </form>
               @endforeach
           </div>
       </div>
   </div>


   @endsection
