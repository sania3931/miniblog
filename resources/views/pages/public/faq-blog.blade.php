@extends('templates.public.main')
@section('content')
<!--Section: FAQ-->
<section class="about-blog">
    <h3 class="text-center mb-4 pb-2 text-primary fw-bold">FAQ</h3>
    <p class="text-center mb-5">@lang('faq-artikel.findThe')
    </p>

    <div class="row">
      <div class="col-md-6 col-lg-4 mb-4">
        <h6 class="mb-3 text-primary"><i class="far fa-paper-plane text-primary pe-2"></i>@lang('faq-artikel.aSimplequestion?')</h6>
        <p>
          <strong><u>@lang('faq-artikel.absolutely!')</u></strong>@lang('faq-artikel.weWork')
        </p>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <h6 class="mb-3 text-primary"><i class="fas fa-pen-alt text-primary pe-2"></i> @lang('faq-artikel.aQuestion')</h6>
        <p>
          <strong><u>@lang('faq-artikel.yesItIs')</u></strong>@lang('faq-artikel.youCan')
        </p>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <h6 class="mb-3 text-primary"><i class="fas fa-user text-primary pe-2"></i>@lang('faq-artikel.aQuestion')
        </h6>
        <p>
            @lang('faq-artikel.currently')
        </p>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <h6 class="mb-3 text-primary"><i class="fas fa-rocket text-primary pe-2"></i>@lang('faq-artikel.question')
        </h6>
        <p>
          @lang('faq-artikel.yesGo')
        </p>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <h6 class="mb-3 text-primary"><i class="fas fa-home text-primary pe-2"></i>@lang('faq-artikel.question')
        </h6>
        <p><strong><u>@lang('faq-artikel.unfortunatelyNo')</u>.</strong> @lang('faq-artikel.weDo')</p>
      </div>

      <div class="col-md-6 col-lg-4 mb-4">
        <h6 class="mb-3 text-primary"><i class="fas fa-book-open text-primary pe-2"></i> @lang('faq-artikel.anotherQuestion')
        </h6>
        <p>
          @lang('faq-artikel.ofCourse')
        </p>
      </div>
    </div>
  </section>
  <!--Section: FAQ-->
  @endsection
  <style>
    .about-blog {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    }
</style>
