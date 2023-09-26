@extends('templates.admin.main')
@section('content')
   <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h3 class="card-title">Tentang Kami</h3>
            @foreach ($about $obouts)
            <p class="card-text">{{ $abouts->content }}</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <a href="{{$abouts->facebook}}">
                    <div class="card-body bg-primary text-center m-3">
                        <i class="fab fa-facebook-f fa-3x text-white"></i>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
               <a href="{{$abouts->instagram}}">
                    <div class="card-body bg-danger text-center m-3">
                        <i class="fab fa-instagram fa-3x text-white"></i>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{$abouts->twitter}}">
                    <div class="card-body bg-info text-center m-3">
                        <i class="fab fa-twitter fa-3x text-white"></i>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endsection
