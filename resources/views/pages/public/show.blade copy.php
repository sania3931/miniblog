@extends('templates.public.main')
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
                                    <td>{!! ($artikel->content ?? $artikel->content_en) !!}</td>
                                @else
                                    <td>{!! ($artikel->content_en ?? $artikel->content) !!}</td>
                                @endif
                                <div class="mt-5">
                                    <h5>
                                        @lang('showartikel.category'): {{ $artikel->category->name }}
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

                    <div class="card p-3">
                        <h4 class="font-italic">@lang('showartikel.relatedPost')</h4>
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
                            <div class="related-post d-flex">
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
                        <h4 class="font-italic">@lang('showartikel.elseWhere')</h4>
                        <ol class="list-unstyled">
                            <li><a href="#">GitHub</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Facebook</a></li>
                        </ol>
                    </div>
                </aside><!-- /.blog-sidebar -->

            </div><!-- /.row -->

        </main><!-- /.container -->
    </div>
@endsection
