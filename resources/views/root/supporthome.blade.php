@extends('root.welcome')

@section('root.seo')

<title>Hoş Geldin | ROOT </title>
<meta name="description" content="Yönetilebilir sistem" />
@endsection
@section('root.contect')


@if(session('success'))
<div class="alert alert-warning" role="alert" style="max-width:450px;margin:20px">
    Başarılı bir şekilde gönderildi.
</div>
@endif




   <div class="container" style="overflow-y: scroll;max-height:400px;margin-top:70px">

       <table class="table-bordered table-striped table-condensed">
           <thead class="thead-dark">
               <tr style="text-align:center;">
                   <th scope="col" style="text-align:center;padding:10px">User_id</th>
                   <th scope="col" style="text-align:center;padding:10px">Başlık</th>
                   <th scope="col" style="text-align:center;padding:10px">Mesaj</th>
                   <th scope="col" style="text-align:center;padding:10px">Oluşturma tarihi</th>
                   
               </tr>
           </thead>
           <tbody>
               @foreach($supporthome as $supporthomekey)
               <tr style="margin-top: 20px;">
                   <td style="text-align:center;padding:10px;width:300px">{{ $supporthomekey->user_id }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $supporthomekey->title }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $supporthomekey->message }}</td>
                   <td style="text-align:center;padding:10px;width:300px">{{ $supporthomekey->created_at }}</td>
               </tr>
               @endforeach
           </tbody>
       </table>
   </div>




@endsection
