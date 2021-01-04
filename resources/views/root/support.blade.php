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


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="doctor-form-price" style="box-shadow: 0 2px 0.75rem -3px rgba(37, 51, 66, .5);" style="max-width:100%">

                <form action="{{ route('supportsave') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="text">User id</label>
                        <input type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" placeholder="Destek id'si">
                    </div>

                    <div class="form-group">
                        <label for="text">Başlık</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Destek talep başlığı">
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
