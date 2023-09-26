@extends('templates.public.main')
@section('content')
<div class="container">
    <div class="card mt-4 shadow-sm about-blog">
         <div class="card-body">
             <h1 class="card-title">@lang('privacy.privacyPolicy')</h1>
             <p class="card-text">@lang('privacy.genius')</p>

             <p>@lang('privacy.thisPage')</p>

             <p>@lang('privacy.IfYouChoose ')</p>

             <p>@lang('privacy.theTerms')</p>

             <h2>@lang('privacy.information')</h2>

             <p>@lang('privacy.foraBetter')</p>

             <h2>@lang('privacy.logData')</h2>

             <p>@lang('privacy.weWant')</p>

             <h2>Cookies</h2>

             <p>@lang('privacy.cookiesAre')</p>

             <p>@lang('privacy.ourWebsite')</p>

             <h2>@lang('privacy.serviceProviders')</h2>

             <p>@lang('privacy.weMay')</p>

             <ul>
                 <li>@lang('privacy.toFacilitate')</li>
                 <li>@lang('privacy.toProvide')</li>
                 <li>@lang('privacy.toPerform')</li>
                 <li>@lang('privacy.toAssist')</li>
             </ul>

             <p>@lang('privacy.weWantTo')</p>

             <h2>@lang('privacy.security')</h2>

             <p>@lang('privacy.weValue')</p>

             <h2>@lang('privacy.linksTo')</h2>

             <p>@lang('privacy.ourService')</p>

             <p>@lang('privacy.childrenPrivacy')</p>

             <p>@lang('privacy.ourServices')</p>

             <h2>@lang('privacy.changesTo')</h2>

             <p>@lang('privacy.weMayUpdate')</p>

             <h2>@lang('privacy.contactUs')</h2>

             <p>@lang('privacy.ifYou')</p></p>
         </div>
    </div>
@endsection
<style>
    .about-blog {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    }
</style>
