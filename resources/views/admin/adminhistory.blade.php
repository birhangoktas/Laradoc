   @extends('admin.welcome')

   @section('admin.seo')
   <title>İşlemc Geçmişi</title>
   <meta name="description" content="Ödeme geçmişini incele" />
   @endsection


   @section('admin.contect')
   @if(session('success_doctor'))
   <div class="alert alert-success" role="alert" style="max-width:450px;margin:20px">
       Doktorunuza para iadesi yapıldı
   </div>

   @endif


   @if(session('active_money'))
   <div class="alert alert-warning" role="alert" style="max-width:450px;">
       Doktorunuza saten para iadesi yaptınız
   </div>

   @endif




   <div class="container">
       <div class="row">
           <div class="alert alert-warning" role="alert" style="width:100%">

               <p><b>UYARI!</b></p>
               Görüşme işlemini iptal etmek istiyorsanız lütfen bizim ile iletişime geçin.<br />
               Görüşme tamamladıktan sonra lütfen ücreti doktorunuza iade etmeyi unutmayınız.<br />
               Görüşme tamamlanır, ücret geri iade edilmez ise ekibimiz ücreti iade etme hakkı bulunmaktadır.<br />
               Olumsuz bir görüşme gerçekleştirseniz, lütfen bu durumu bizim ile iletişime geçerek bildiriniz.

               <hr>
               Ücreti gönder butonuna tıkladıktan sonra ücreti doktorunuza iade etmiş olursunuz.
           </div>
       </div>
   </div>





   <div class="container" style="overflow-y: scroll;max-height:400px;margin-top:70px">




       <table class="table-bordered table-striped table-condensed">
           <thead class="thead-dark">
               <tr style="text-align:center;">
                   <th scope="col" style="text-align:center;padding:10px">Order_id</th>
                   <th scope="col" style="text-align:center;padding:10px">İsim soyisim</th>
                   <th scope="col" style="text-align:center;padding:10px">Email</th>
                   <th scope="col" style="text-align:center;padding:10px">Telefon</th>
                   <th scope="col" style="text-align:center;padding:10px">Ödeme tutarı</th>
                   <th scope="col" style="text-align:center;padding:10px;">Mesaj</th>
                   <th scope="col" style="text-align:center;padding:10px">Görüşme zamanı</th>
                   <th scope="col" style="text-align:center;padding:10px">Görüşme saati</th>
                   <th scope="col" style="text-align:center;padding:10px">Oluşturma zamanı</th>
                   <th scope="col" style="text-align:center;padding:10px">Ücreti gönder</th>
                   <th scope="col" style="text-align:center;padding:10px">Doktoru şikayet et</th>
               </tr>
           </thead>
           <tbody>
               @foreach($adminhistory as $adminhistorykey)
               <tr style="margin-top: 20px;">
                   <td style="text-align:center;padding:10px;width:300px">{{ $adminhistorykey->order_id }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $adminhistorykey->name }} {{ $adminhistorykey->last }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $adminhistorykey->email }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $adminhistorykey->phone }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $adminhistorykey->appointment_price }}</td>
                   <td style="text-align:center;padding:10px;width:100%">{{ $adminhistorykey->doctor_message }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ Carbon\Carbon::parse($adminhistorykey->doctor_date)->format('d-m-Y')}}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ Carbon\Carbon::parse($adminhistorykey->doctor_time)->format('H:i') }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $adminhistorykey->created_at }}</td>
                   @if($adminhistorykey->is_money == 1)
                   <td style="text-align:center;padding:10px;width:300px"><button type="button" class="btn btn-success">Ücreti iade ettiniz</button></td>
                   @else
                   <td style="text-align:center;padding:10px;width:300px"><a href="{{ route('doctoraddmoney',$adminhistorykey->order_id) }}"><button type="button" class="btn btn-primary">Ücreti gönder</button></a></td>
                   @endif
                   <td style="text-align:center;padding:10px;width:300px"><a href="{{ route('doctoraddmoney',$adminhistorykey->order_id) }}"><button type="button" class="btn btn-danger">Doktoru şikayet et</button></a></td>

               </tr>
               @endforeach

           </tbody>
       </table>




   </div>


   @endsection
