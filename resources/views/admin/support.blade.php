   @extends('admin.welcome')

   @section('admin.seo')

   <title>Geri Bildirimde Bulun</title>
   <meta name="description" content="Geri bildirimde bulun" />
   @endsection

   @section('admin.contect')

   <div class="container-fluid">
       <div class="row">
           <div class="col-md-12">
               <div class="doctor-form-price" style="box-shadow: 0 2px 0.75rem -3px rgba(37, 51, 66, .5);" style="max-width:100%">

                   <form action="{{ route('feedbacksave') }}" method="post">
                       @csrf
                       <span>Ketogori</span>
                       <select class="js-example-disabled-results" style="width:100%;height:200px;overflow:scroll;font-family:normal" name="subject">
                           <option value="Site ilgili şikayetler" style="font-family:normal">Site ilgili şikayetler</option>
                           <option value="Site ilgili öneriler" style="font-family:normal">Site ilgili öneriler</option>
                           <option value="Yazılımsal hatalar" style="font-family:normal">Yazılımsal hatalar</option>
                           <option value="Site çalışanları ile ilgili sorunlar" style="font-family:normal">Site çalışanları ile ilgili sorunlar</option>
                           <option value="Doktor şikayetleri" style="font-family:normal">Doktor şikayetleri</option>
                       </select>
                       <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js">
                       </script>
                       <script>
                           var $disabledResults = $(".js-example-disabled-results");
                           $disabledResults.select2();
                           $('.js-example-basic-multiple').select2();

                       </script>

                       <div class="form-group">
                           <label for="text">Başlık</label>
                           <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"  placeholder="Destek talep başlığı">
                       </div>

                       <div class="form-group">
                           <label for="text">Mesaj içeriği</label>
                           <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" placeholder="Mesaj"></textarea>
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
