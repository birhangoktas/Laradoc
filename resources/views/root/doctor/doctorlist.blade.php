   @extends('root.welcome')

   @section('root.seo')

   <title>Hoş Geldin | ROOT </title>
   <meta name="description" content="Hello" />
   @endsection


   @section('root.contect')







   <div class="container" style="margin-top:70px">


       <div class="row">
           @foreach($doctorlist as $doctorlistkey)

           @if($doctorlistkey->is_active == 0)

           <div class="col-md-3">
               <div class="doctor-box-width" style="width:100%;border:1px solid red"  data-id={{ $doctorlistkey->id }}>
                   <div class="doctor-box-img">
                       <img src="/projectlogo/{{ $doctorlistkey->projectlogo }}" alt="Şirket resmi" width="150" height="150">
                   </div>

                   <div class="doctor-padding-20" style="padding: 20px;">
                       <div class="doctor-box-text">
                           <p>{{ $doctorlistkey->name.' '.$doctorlistkey->last }}</p>
                           <span class="text-limit-2" style="color:gold">{{ $doctorlistkey->my_about }}
                           </span>
                       </div>
                       <div class="doctor-home-btn">
                           <a href="{{ route('doctorhome',[$doctorlistkey->name_url,$doctorlistkey->project_url,$doctorlistkey->user_id]) }}"><button>İncele</button></a>
                       </div>

                       <div class="doctor-home-btn" id="doctorlistbtn" data-id={{ $doctorlistkey->id }}>
                          <button>Onayla</button>
                       </div>
                       <hr />
                       <span>{{ $doctorlistkey->profession }}</span>
                   </div>
               </div>
           </div>
           @else
           <div class="col-md-3">
               <div class="doctor-box-width" style="width:100%;border:1px solid gold">
                   <div class="doctor-box-img">
                       <img src="/projectlogo/{{ $doctorlistkey->projectlogo }}" alt="Şirket resmi" width="150" height="150">
                   </div>

                   <div class="doctor-padding-20" style="padding: 20px;">
                       <div class="doctor-box-text">
                           <p>{{ $doctorlistkey->name.' '.$doctorlistkey->last }}</p>
                           <span class="text-limit-2" style="color:gold">{{ $doctorlistkey->my_about }}
                           </span>
                       </div>
                       <div class="doctor-home-btn">
                           <a href="{{ route('doctorhome',[$doctorlistkey->name_url,$doctorlistkey->project_url,$doctorlistkey->user_id]) }}"><button>İncele</button></a>
                       </div>
                       <hr />
                       <span>{{ $doctorlistkey->profession }}</span>
                   </div>
               </div>
           </div>

           @endif
           @endforeach
       </div>
   </div>







   <script>
       $('#doctorlistbtn[data-id]').one("click", function() {
           id = $(this).attr("data-id");
           $.ajax({
               url: '/root/project-active/'+id, // need to create this route
               type: "GET"
               , cache: false
               , dataType: 'html'
               , success: function(data) {

                   $('.doctor-box-width[data-id="' + id + '"]').css('border', '1px solid gold');
               }
               , error: function(result) {
               }

           });
       });

   </script>






   @endsection
