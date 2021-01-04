   @extends('root.welcome')

   @section('root.seo')

   <title>Hoş Geldin | ROOT </title>
   <meta name="description" content="Yönetilebilir sistem" />
   @endsection


   @section('root.contect')

   @if(session('success'))
   <div class="alert alert-warning" role="alert" style="max-width:450px;margin:20px">
       Başarılı bir şekilde onaylandı.
   </div>
   @endif

   @if(session('error'))
   <div class="alert alert-danger" role="alert" style="max-width:450px;margin:20px">
       Hata alındı.
   </div>
   @endif

   @if(session('isactive'))
   <div class="alert alert-danger" role="alert" style="max-width:450px;margin:20px">
       Bu doktoru önceden onayladınız.
   </div>
   @endif

   <div class="container">
       <div class="row">

           <div class="col-md-4">
               <div class="card text-white" style="background:gold">
                   <div class="card-body">
                       <div class="d-flex justify-content-between pb-2 align-items-center">
                           <h2 class="font-weight-semibold mb-0">{{ $usercount }}</h2>
                           <div class="icon-holder">
                               <i class="mdi mdi-briefcase-outline"></i>
                           </div>
                       </div>
                       <div class="d-flex justify-content-between">
                           <h5 class="font-weight-semibold mb-0">Toplam Kullanıcı sayısı</h5>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-md-4">
               <div class="card text-white" style="background:gold">
                   <div class="card-body">
                       <div class="d-flex justify-content-between pb-2 align-items-center">
                           <h2 class="font-weight-semibold mb-0">{{ $doctorcount }}</h2>
                           <div class="icon-holder">
                               <i class="mdi mdi-briefcase-outline"></i>
                           </div>
                       </div>
                       <div class="d-flex justify-content-between">
                           <h5 class="font-weight-semibold mb-0">Toplam doktor sayısı</h5>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-md-4">
               <div class="card text-white" style="background:gold">
                   <div class="card-body">
                       <div class="d-flex justify-content-between pb-2 align-items-center">
                           <h2 class="font-weight-semibold mb-0">{{ $total }}</h2>
                           <div class="icon-holder">
                               <i class="mdi mdi-briefcase-outline"></i>
                           </div>
                       </div>
                       <div class="d-flex justify-content-between">
                           <h5 class="font-weight-semibold mb-0">Toplam kazanç</h5>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>






   <div class="container" style="overflow-y: scroll;max-height:400px;margin-top:70px">

       <table class="table-bordered table-striped table-condensed">
           <thead class="thead-dark">
               <tr style="text-align:center;">
                   <th scope="col" style="text-align:center;padding:10px">User_id</th>
                   <th scope="col" style="text-align:center;padding:10px">Konu</th>
                   <th scope="col" style="text-align:center;padding:10px">Başlık</th>
                   <th scope="col" style="text-align:center;padding:10px">Mesaj</th>
                   <th scope="col" style="text-align:center;padding:10px">Destek tarihi</th>
                   <th scope="col" style="text-align:center;padding:10px">Yanıt ver</th>
               </tr>
           </thead>
           <tbody>
               @foreach($mysupport as $mysupportkey)
               <tr style="margin-top: 20px;">
                   <td style="text-align:center;padding:10px;width:300px">{{ $mysupportkey->user_id }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $mysupportkey->subject }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $mysupportkey->title }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $mysupportkey->comment }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $mysupportkey->created_at }}</td>
                   <td style="text-align:center;padding:10px;width:300px">
                       <div class="doctor-header-btn" style="margin-top:0px">
                           <a href="/root/destek-talepleri" target="_blank"><button style="width:100%">Yanıtla</button></a>
                       </div>
                   </td>

               </tr>
               @endforeach
           </tbody>
       </table>
   </div>

   <div class="container" style="margin-top:70px">
       <div class="row">

           <div class="col-md-4">
               <div class="card text-white" style="background:gold">
                   <div class="card-body">
                       <div class="d-flex justify-content-between pb-2 align-items-center">
                           <h2 class="font-weight-semibold mb-0">{{ $projectcount }}</h2>
                           <div class="icon-holder">
                               <i class="mdi mdi-briefcase-outline"></i>
                           </div>
                       </div>
                       <div class="d-flex justify-content-between">
                           <h5 class="font-weight-semibold mb-0">Toplam doktor ilan sayısı</h5>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-md-4">
               <div class="card text-white" style="background:gold">
                   <div class="card-body">
                       <div class="d-flex justify-content-between pb-2 align-items-center">
                           <h2 class="font-weight-semibold mb-0">{{ $supportcount }}</h2>
                           <div class="icon-holder">
                               <i class="mdi mdi-briefcase-outline"></i>
                           </div>
                       </div>
                       <div class="d-flex justify-content-between">
                           <h5 class="font-weight-semibold mb-0">Toplam destek sayısı</h5>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-md-4">
               <div class="card text-white" style="background:gold">
                   <div class="card-body">
                       <div class="d-flex justify-content-between pb-2 align-items-center">
                           <h2 class="font-weight-semibold mb-0">{{ $paymentcount }}</h2>
                           <div class="icon-holder">
                               <i class="mdi mdi-briefcase-outline"></i>
                           </div>
                       </div>
                       <div class="d-flex justify-content-between">
                           <h5 class="font-weight-semibold mb-0">Toplam satın alma işlemi</h5>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>




   <div class="container" style="overflow-y: scroll;max-height:400px;margin-top:70px">

       <table class="table-bordered table-striped table-condensed">
           <thead class="thead-dark">
               <tr style="text-align:center;">
                   <th scope="col" style="text-align:center;padding:10px">User_id</th>
                   <th scope="col" style="text-align:center;padding:10px">Fotograf</th>
                   <th scope="col" style="text-align:center;padding:10px">İsim soyisim</th>
                   <th scope="col" style="text-align:center;padding:10px">E-mail</th>
                   <th scope="col" style="text-align:center;padding:10px">Telefon</th>
                   <th scope="col" style="text-align:center;padding:10px">T.C kimliği</th>
                   <th scope="col" style="text-align:center;padding:10px">Doktoru onayla</th>
               </tr>
           </thead>
           <tbody>
               @foreach($doctorlogin as $doctorloginkey)
               @if($doctorloginkey->is_active == 1)
               <tr class="left-border" data-id="{{ $doctorloginkey->id }}" style="margin-top: 20px;border-left:5px solid gold">
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorloginkey->user_id }}</td>
                   <td style="text-align:center;padding:10px;width:300px">
                       <img src="/profil/{{ $doctorloginkey->profil }}" width="72px" height="72px">
                   </td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorloginkey->name.' '.$doctorloginkey->last }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorloginkey->email }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorloginkey->phone }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorloginkey->tc }}</td>
                   <td style="text-align:center;padding:10px;width:300px">
                       <div class="doctor-header-btn" data-id="{{ $doctorloginkey->id }}" style="margin-top:0px">
                           <button style="width:100%">Onayla</button></a>
                       </div>
                   </td>
               </tr>

               @else
               <tr class="left-border" style="margin-top: 20px;" data-id="{{ $doctorloginkey->id }}">
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorloginkey->user_id }}</td>
                   <td style="text-align:center;padding:10px;width:300px">
                       <img src="/profil/{{ $doctorloginkey->profil }}" width="72px" height="72px">
                   </td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorloginkey->name.' '.$doctorloginkey->last }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorloginkey->email }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorloginkey->phone }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorloginkey->tc }}</td>
                   <td style="text-align:center;padding:10px;width:300px">
                       <div class="doctor-header-btn" data-id="{{ $doctorloginkey->id }}" style="margin-top:0px">
                           <button style="width:100%">Onayla</button></a>
                       </div>
                   </td>
               </tr>
               @endif
               @endforeach
           </tbody>
       </table>
   </div>

   <script>
       $('.doctor-header-btn[data-id]').one("click", function() {
           id = $(this).attr("data-id");
           $.ajax({
               url: '/root/doctor-active/' + id, // need to create this route
               type: "GET"
               , cache: false
               , dataType: 'html'
               , success: function(data) {

                   $('.left-border[data-id="' + id + '"]').css('border-left', '5px solid gold');
               }
               , error: function(result) {
                   $('.left-border[data-id="' + id + '"]').css('border-left', '5px solid red');
               }

           });
       });

   </script>


   @endsection
