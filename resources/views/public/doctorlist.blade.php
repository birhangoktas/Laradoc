@extends('welcome')

@section('welmome.seo')
<title>Doktorlar</title>
<meta name="description" content="Doktorlarımız ile görüşebilmek için lütfen kayıt olun." />
@endsection
@section('welmome.contect')

@if(session('error_web'))
<div class="alert alert-warning" role="alert" style="max-width:450px;margin:20px">
    {{session('error_web') }}
</div>

@endif



@if(session('error-card'))
<div class="alert alert-warning" role="alert" style="max-width:450px;margin:20px">
    {{session('error-card') }}
</div>

@endif




<div class="container" style="margin-top: 50px;">
    <div class="row" id="md-">

        @foreach($doctorlist as $doctorlistkey)


        <div class="col-md-6">
            <div class="mentorlist-page-box">
            <a href="doktor/{{ $doctorlistkey->name_url}}/{{ $doctorlistkey->project_url }}/{{ $doctorlistkey->user_id }}">
                <div class="row">
                    <div class="col-2/2">
                        <div class="mentorlist-page-logo">
                            <img src="/projectlogo/{{ $doctorlistkey->projectlogo }}" alt="">
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="mentorlist-page-text">
                            <span style="color:#000">{{ $doctorlistkey->profession }}</span>
                            <p style="color:#000">{{ $doctorlistkey->name.' '.$doctorlistkey->last }}</p>

                        </div>
                    </div>
                </div>
                <span style="max-width: 100%;color:#000" class="text-limit-2">{{ $doctorlistkey->my_about }}</span>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection
