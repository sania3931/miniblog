@extends('templates.admin.main')
@section('content')
    <div class="section__content section__content--p30">
        <main role="main" class="container">
            <div class="row">
                <div class="col-md-8 blog-main">
                    <div class="card">
                        <div class="card-body card-block p-5">
                            <div class="row">
                                <div class="col">
                                    <h3 class="pb-3 mb-4 font-italic border-bottom">
                                        @lang('showartikel.articleDetail')
                                    </h3>
                                </div>
                                <div class="col ">
                                    <a href="{{ url(Auth::user()->role . '/artikels') }}"
                                        class="btn btn-danger btn-sm float-right">
                                        <i class="fa fa-chevron-left"></i> @lang('button.back')
                                    </a>
                                </div>
                            </div>

                            <div class="blog-post">
                                <h2 class="blog-post-title">
                                    @if (app()->getlocale() == 'id')
                                        <td>{{ $artikel->title ?? $artikel->title_en }}</td>
                                    @else
                                        <td>{{ $artikel->title_en ?? $artikel->title }}</td>
                                    @endif
                                </h2>
                                <p class="blog-post-meta">{{ $artikel->date }} by <a
                                        href="#">{{ $artikel->user->name }}</a></p>
                                <div class='col-12 text-center mb-3 mt-3'>
                                    <img class='img-fluid' style='margin-left: auto; margin-right: auto;'
                                        src='{{ asset('images/' . $artikel->featured_image) }}' />
                                </div>
                                @if (app()->getlocale() == 'id')
                                    <td>{!!($artikel->content ?? $artikel->content_en) !!}</td>
                                @else
                                    <td>{!! ($artikel->content_en ?? $artikel->content) !!}</td>
                                @endif
                                <div class="mt-5">
                                    <h5>
                                        @lang('showartikel.category') : {{ $artikel->category->name }}
                                    </h5>
                                </div>
                                <div class="mt-2">
                                    <h5>
                                        @lang('sidebar.tags'):
                                        <span class="tag-recent">
                                            @foreach ($artikel->tag()->get() as $tag)
                                                {{$tag->name}},
                                            @endforeach
                                        </span>
                                    </h5>
                                </div>


                            </div><!-- /.blog-post -->
                        </div>
                    </div>

                </div><!-- /.blog-main -->

                <aside class="col-md-4 blog-sidebar">
                    {{-- <div class="p-3 mb-3 bg-light rounded">
                        <h4 class="font-italic">About</h4>
                        <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur
                            purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                    </div> --}}

                    <div class="p-3">
                        <h4 class="font-italic title section-title">@lang('showartikel.relatedPost')</h4>
                        @foreach ($related_post as $row)
                        @php
                        if (app()->getlocale() == 'id') {
                            $slug = $row->slug ? $row->slug : $row->slug_en;
                        } else {
                            $slug = $row->slug_en ? $row->slug_en : $row->slug;
                        }
                        @endphp
                            <div class="underline"></div>
                            <div class="panel-body no-padding"></div>
                            <div class="related-post">
                                <img width="150px" height="100px" src="{{ asset('images/' . $row->featured_image) }}"
                                    alt="">
                                <div class="ms-3">
                                    <a href="{{ url('artikel/' . $slug) }}"
                                        style="text-decoration: none; text-transform: capitalize; color: #656565; font-weight: 600">
                                        @if (app()->getlocale() == 'id')
                                            <td>{{ $row->title ?? $row->title_en }}</td>
                                        @else
                                            <td>{{ $row->title_en ?? $row->title }}</td>
                                        @endif
                                    </a>
                                    <br>
                                    <span>{{ $row->date }}</span>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    </div>
                    <div class="p-3">
                        <h4 class="font-italic title section-title">
                            @lang('showartikel.category')
                        </h4>
                        <ol class="list-unstyled">
                            <li><a href="#">{{ $artikel->category->name }}</a></li>
                        </ol>
                    </div>
                    <div class="p-2">
                            <h4 class="font-italic title section-title">@lang('showartikel.elseWhere')</h4>
                          </div>
                          <div class="social-widget">
                            <ul class="list-unstyled">
                              <li>
                                <a href="#" class="social-facebook">
                                  <i class="fab fa-facebook-f"></i>
                                  <span>21.2 K<br>Followers</span>
                                </a>
                              </li>
                              <li>
                                <a href="#" class="social-instagram">
                                  <i class="fab fa-instagram"></i>
                                  <span>45.2 K<br>Followers</span>
                                </a>
                              </li>
                              <li>
                                <a href="https://www.youtube.com/channel/UCSU_al9Rti8l4" class="social-youtube">
                                  <i class="fab fa-youtube"></i>
                                  <span>10.3 M<br>Subscribe</span>
                                </a>
                              </li>
                            </ul>
                          </div>
                </aside><!-- /.blog-sidebar -->

            </div><!-- /.row -->

        </main><!-- /.container -->
    </div>
@endsection
@section('style')
    <style>
        .section-title {
    position: relative;
    margin-bottom: 20px;
}
.section-title:after {
    content: "";
    display: inline-block;
    height: 2px;
    background-color: #e8eaed;
    position: absolute;
    left: 166px;
    right: 0;
    top: 14px;
    z-index: 10;
    width: 218px;
}
    .section-title .title {
    position: relative;
    display: inline-block;
    background-color: #fff;
    font-size: 16px;
    text-transform: uppercase;
    margin-top: 0px;
    margin-bottom: 0px;
    padding-right: 10px;
    z-index: 20;
}
.social-facebook {
  background: #225b99 !important;
}

.social-whatsapp {
  background: #58e870 !important;
}

.social-youtube {
  background: #cc2127 !important;
}

.social-pinterest {
  background: #cc2127 !important;
}

.social-instagram {
  background: #d341b2 !important;
}
.social-widget ul {
  overflow: auto;
}

.social-widget ul li {
  float: left;
  width: 33.33%;
}

.social-widget ul li a {
  display: block;
  text-align: center;
  padding: 30px 15px;
  color: #fff;
  -webkit-transition: 0.2s opacity;
  transition: 0.2s opacity;
}

.social-widget ul li a:hover {
  opacity: 0.9;
}

.social-widget ul li a span {
  font-weight: 700;
  font-size: 14px;
}

.social-widget ul li a i {
  display: block;
  font-size: 30px;
  margin-bottom: 10px;
}
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.fa-youtube:before{
    content:\f167;
}
.tag-recent {
        background-color: orange;
        color: white;
        font-size: 12px;
        padding: 3px;
        border-radius: 7px;
    }
    </style>

@endsection

