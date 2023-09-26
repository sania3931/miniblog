@extends('templates.public.main')
@section('content')
    <div class="container">
        <!--Section: Content-->
        <section class="text-center hero">
            <h4 class="mb-5"><strong> @lang('nav.articles')</strong></h4>
            <div class="row">
                @foreach ($artikel->take(6)->get() as $row)
                    @php
                        if (app()->getlocale() == 'id') {
                            $slug = $row->slug ? $row->slug : $row->slug_en;
                        } else {
                            $slug = $row->slug_en ? $row->slug_en : $row->slug;
                        }
                    @endphp
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="{{ asset('images/' . $row->featured_image) }}" class="img-fluid" />
                                {{-- <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </a> --}}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    @if (app()->getlocale() == 'id')
                                            <td>{{ $row->title ??  $row->title_en }}</td>
                                        @else
                                            <td>{{ $row->title_en ?? $row->title }}</td>
                                        @endif</h5>
                                <p class="card-text">
                                    @if (app()->getlocale() == 'id')
                                        <td>{!! substr($row->content ?? $row->content_en, 0, 100) !!}</td>
                                    @else
                                        <td>{!! substr($row->content_en ?? $row->content, 0, 100) !!}</td>
                                    @endif
                                </p>
                                <a href="{{ url('artikel/' .$slug) }}" class="btn btn-primary">@lang('button.more')</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div id="more-artikel" class="row">
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <input type="hidden" name="limit" id="limit" value="3" />
                        <input type="hidden" name="offset" id="offset" value="6" />
                        <input type="hidden" name="allpost" id="allpost" value="{{ $artikel->count() }}" />
                        <button id="btn-load" class="btn btn-outline-dark btn-reload"><i class="fas fa-angle-double-down"></i></button>
                        <div id="icon-loading" style="display: none">
                            <i class="fas fa-spinner fa-pulse fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
<script>
    $(window).scroll(function() {
        console.log($(window).scrollTop() == $(document).height(), $(window).height());
        if($(window).scrollTop() == $(document).height() - $(window).height()) {
            $('#btn-load').trigger('click');
            }
        });

    $('#btn-load').click(function() {
    $(this).hide();
    $("#icon-loading").show();
    var offset = parseInt($('#offset').val());
    var allpost = parseInt($('#allpost').val());

    var result = "";

    $.ajax({
        url: "{{ url('ajax_load_project') }}",
        type: 'GET',
        data: {
            skip: $('#offset').val(),
            take: $('#limit').val(),
        },
    }).done(function(data) {
        offset = offset + 3;
        if (offset > allpost) {
            $("#icon-loading").hide();
        } else {
            $('#offset').val(offset);
            $("#icon-loading").hide();
            $("#btn-load").show();
        }
        $('#more-artikel').append(data);
    });
    });

</script>
@endsection
