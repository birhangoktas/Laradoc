   @extends('doctor.welcome')

   @section('doctor.seo')
   <title>Kazançlarım</title>
   <meta name="description" content="Kazançlarım" />
   @endsection



   @section('doctor.contect')
   <div class="container" style="overflow-y: scroll;max-height:400px;margin-top:70px">




       <table class="table-bordered table-striped table-condensed">
           <thead class="thead-dark">
               <tr style="text-align:center;">
                   <th scope="col" style="text-align:center;padding:10px">Hasta id</th>
                   <th scope="col" style="text-align:center;padding:10px">İsim soyisim</th>
                   <th scope="col" style="text-align:center;padding:10px">Email</th>
                   <th scope="col" style="text-align:center;padding:10px">Telefon</th>
                   <th scope="col" style="text-align:center;padding:10px">Görüşme tarihi</th>
                   <th scope="col" style="text-align:center;padding:10px">Görüşme zamanı</th>
                   <th scope="col" style="text-align:center;padding:10px">Kullanıcı mesajı </th>
                   <th scope="col" style="text-align:center;padding:10px">Ödeme tutarı</th>
                   <th scope="col" style="text-align:center;padding:10px">Ücretinizi alındı mı?</th>
                   <th scope="col" style="text-align:center;padding:10px">işlem tarihi</th>
               </tr>
           </thead>
           <tbody>
               @foreach($userhistory as $userhistorykey)
               <tr style="margin-top: 20px;">
                   <td style="text-align:center;padding:10px;width:300px">{{ $userhistorykey->user_id }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $userhistorykey->name }} {{ $userhistorykey->last }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $userhistorykey->email }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $userhistorykey->phone }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $userhistorykey->doctor_date }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $userhistorykey->doctor_time }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $userhistorykey->doctor_message }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $userhistorykey->appointment_price }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $userhistorykey->is_money }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $userhistorykey->created_at }}</td>
               </tr>
               @endforeach

           </tbody>
       </table>




   </div>


   @endsection
