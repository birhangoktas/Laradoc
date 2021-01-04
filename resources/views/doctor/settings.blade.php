   @extends('doctor.welcome')

   @section('doctor.seo')

   <title>Kullanıcı ayarları</title>
   <meta name="description" content="Ayarlarını güncelleyebilir veya inceleyebilirsin." />
   @endsection

   @section('doctor.contect')

@if(session('success'))
<div class="alert alert-warning" role="alert">
  Başarılı bir şekilde profil değiştirildi.
</div>
@endif


@if(session('company-success'))
<div class="alert alert-warning" role="alert">
  Başarılı bir şekilde şifre değiştirildi.
</div>
@endif

@if(session('company-error'))
<div class="alert alert-warning" role="alert">
  Hay aksi! eski şifreyi unuttun. Haydi! hafızanı zorunla eski şifreni bulmaya çalış.
</div>
@endif

@if(session('company-twopassword'))
<div class="alert alert-warning" role="alert">
  Şifreler uyuşmuyor.
</div>
@endif

   <div class="container-fluid">
       <div class="row">
           <div class="col-md-12">
               <div class="doctor-form-price" style="box-shadow: 0 2px 0.75rem -3px rgba(37, 51, 66, .5);" style="max-width:100%">

                   <form action="{{ route('doctorpasswordupdate') }}" method="post">
                       @csrf

                       <div class="form-group">
                           <label for="text">Eski şifre</label>
                           <input type="password" class="form-control" name="oldpassword" id="text" placeholder="****">
                       </div>

                       <div class="form-group">
                           <label for="text">Yeni şifre</label>
                           <input type="password" class="form-control" name="newpassword1" id="text" placeholder="****">
                       </div>

                       <div class="form-group">
                           <label for="text">Yeni şifre</label>
                           <input type="password" class="form-control" name="newpassword2" id="text" placeholder="****">
                       </div>

                       <div class="doctor-header-btn">
                           <button style="width:100%">İşlemi tamamla</button>
                       </div>

                   </form>
               </div>
           </div>
       </div>
   </div>


   <div class="container-fluid" style="margin-top:30px">
       <div class="row">
           <div class="col-md-12">
               <div class="doctor-form-price" style="box-shadow: 0 2px 0.75rem -3px rgba(37, 51, 66, .5);" style="max-width:100%">

                   <form action="{{ route('doctorprofilupdate') }}" method="post" enctype="multipart/form-data">
                       @csrf

                       <div class="custom-file">
                           <input type="file" name="profil" class="custom-file-input @error('profil') is-invalid @enderror" id="customFile">
                           <label class="custom-file-label" for="customFile">Profil fotografını güncelle</label>
                       </div>

                       <div class="doctor-header-btn">
                           <button style="width:100%">İşlemi tamamla</button>
                       </div>

                   </form>
               </div>
           </div>
       </div>
   </div>






   @endsection
