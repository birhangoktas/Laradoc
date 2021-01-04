   @extends('doctor.welcome')

   @section('doctor.seo')
   <title>İşlem Geçmişi</title>
   <meta name="description" content="İşlem geçmişini görüntüle" />
   @endsection



   @section('doctor.contect')
   <div class="container" style="overflow-y: scroll;max-height:400px;margin-top:70px">




       <table class="table-bordered table-striped table-condensed">
           <thead class="thead-dark">
               <tr style="text-align:center;">
                   <th scope="col" style="text-align:center;padding:10px">Order_id</th>
                   <th scope="col" style="text-align:center;padding:10px">İsim soyisim</th>
                   <th scope="col" style="text-align:center;padding:10px">Email</th>
                   <th scope="col" style="text-align:center;padding:10px">Telefon</th>
                   <th scope="col" style="text-align:center;padding:10px">Ödeme tutarı</th>
                   <th scope="col" style="text-align:center;padding:10px">Satın alma tarihi</th>
               </tr>
           </thead>
           <tbody>
            @foreach($doctorhistory as $doctorhistorykey)
               <tr style="margin-top: 20px;">
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorhistorykey->order_id }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorhistorykey->doctor_name }} {{ $doctorhistorykey->doctor_last }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorhistorykey->doctor_email }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorhistorykey->doctor_phone }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorhistorykey->doctor_price }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $doctorhistorykey->created_at }}</td>
               </tr>
            @endforeach
         
           </tbody>
       </table>




   </div>


   @endsection
