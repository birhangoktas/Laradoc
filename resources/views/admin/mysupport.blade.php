   @extends('admin.welcome')

   @section('admin.seo')
   <title>Destek geçmişim</title>
   <meta name="description" content="Destek geçmişim" />
   @endsection




@section('admin.contect')
   <div class="container" style="overflow-y: scroll;max-height:400px;margin-top:70px">

       <table class="table-bordered table-striped table-condensed">
           <thead class="thead-dark">
               <tr style="text-align:center;">
                   <th scope="col" style="text-align:center;padding:10px">Konu</th>
                   <th scope="col" style="text-align:center;padding:10px">Başlık</th>
                   <th scope="col" style="text-align:center;padding:10px">Mesaj</th>
                   <th scope="col" style="text-align:center;padding:10px">Destek tarihi</th>
               </tr>
           </thead>
           <tbody>
               @foreach($mysupport as $mysupportkey)
               <tr style="margin-top: 20px;">
                   <td style="text-align:center;padding:10px;width:300px">{{ $mysupportkey->subject }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $mysupportkey->title }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $mysupportkey->comment }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $mysupportkey->created_at }}</td>
               </tr>
               @endforeach

           </tbody>
       </table>




   </div>


   @endsection
