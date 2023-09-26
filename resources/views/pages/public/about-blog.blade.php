@extends('templates.public.main')
@section('content')
<div class="container">
    <div class="card mt-4 shadow-sm about-blog">
         <div class="card-body">
             <h3 class="card-title">@lang('contact.aboutUs')</h3>
             <p class="card-text">{!! $abouts->content !!}</p>
         </div>

         <div class="row">
             <div class="col-md-4">
                 <a href="{{$abouts->facebook}}">
                     <div class="card-body text-center m-3" style="background-color: #3b5998;;">
                         <i class="fab fa-facebook-f fa-3x text-white"></i>
                     </div>
                 </a>
             </div>
             <div class="col-md-4">
                <a href="{{$abouts->instagram}}">
                     <div class="card-body text-center m-3" style="background-color: #ac2bac;">
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
     </div>
</div>
@endsection
@section('style')
<style>
    .about-blog {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    }
</style>
@endsection

