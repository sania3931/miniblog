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
                                    <td>{!! $artikel->content ?? $artikel->content_en !!}</td>
                                @else
                                    <td>{!! $artikel->content_en ?? $artikel->content !!}</td>
                                @endif
                                <div class="mt-5">
                                    <h5>
                                        @lang('showartikel.category'): {{ $artikel->category->name }}
                                    </h5>
                                </div>
                                <div class="mt-2">
                                    <h6>
                                        @lang('sidebar.tags'):
                                        <span class="tag-recent">
                                            @foreach ($artikel->tag()->get() as $tag)
                                                {{ $tag->name }},
                                            @endforeach
                                        </span>
                                    </h6>
                                    @if (Auth::check())
                                        @php
                                            $user_id = Auth::user()->id;
                                            $like_check = $artikel
                                                ->WhereHas('like', function ($q) use ($user_id) {
                                                    $q->where('user_id', $user_id);
                                                })
                                                ->count();
                                        @endphp
                                        <button type="button" onclick="btnLike({{ $artikel->id }});"  id="idPosts" class="text-black btn @if ($like_check == 1) btn-danger @else btn-white @endif btn-xs go-like">
                                            <i class="fas fa-heart"></i>
                                            @if ($like_check == 1)
                                                @lang('button.liked')
                                            @else
                                                @lang('button.like')
                                            @endif | {{ $artikel->like()->count() }}
                                        </a>
                                    @else
                                        <a href="{{ url('login') }}" id="btn-like-login" class="btn btn-white btn-xs">
                                            <span class="fas fa-heart"></span> @lang('button.like')| {{ $artikel->like()->count() }}
                                        </a>
                                    @endif
                                </div>



                                <!-- Add Comment -->
                                {{-- <div class="card my-5">
                                        <h5 class="card-header">Add Comment</h5>
                                        <div class="card-body">
                                            <form method="post" action="{{ url('save-comment') }}">
                                                @csrf
                                                @method('post')
                                                <div class="form-group">
                                                    <label>@lang('form.username')</label>
                                                    <input class="form-control  @error('name') is-invalid @enderror"
                                                        type="text" name="name" value="{{ old('name') }}"
                                                        placeholder="@lang('form.name')">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>@lang('form.emailAdress')</label>
                                                    <input class="form-control @error('email') is-invalid @enderror"
                                                        type="email" name="email" value="{{ old('email') }}"
                                                        placeholder="@lang('form.email')">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="captcha"
                                                        class="col-md-4 col-form-label text-md-right">Captcha</label>
                                                    <div class="col-md-6 captcha">
                                                        <span>{!! captcha_img('flat') !!}</span>
                                                        <button type="button" class="btn btn-danger" class="reload"
                                                            id="reload">
                                                            &#x21bb;
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="captcha" class="col-md-4 col-form-label text-md-right">Enter
                                                        Captcha</label>
                                                    <div class="col-md-6">
                                                        <input id="captcha" type="text" class="form-control"
                                                            placeholder="Enter Captcha" name="captcha">
                                                    </div>
                                                </div>
                                                <div class="form-group card-body">
                                                    <textarea name="comment" class="form-control"></textarea>
                                                    <input type="submit" class="btn btn-dark mt-2" placeholder="Message" />
                                                </div>
                                            </form>
                                        </div>
                                    </div> --}}
                                <form id="comment-form" class="form-comment" method="post"
                                    action="{{ url('save-comment') }}">
                                    @csrf
                                    @method('post')
                                    <div class="col-md-12">
                                        <h3 class="card-header">@lang('titlecard.addComment')</h3>
                                    </div>
                                    @if (Auth::check())
                                        @if (Auth::user()->role == 'Member')
                                            <input type="hidden" name="post_id" value="{{ $artikel->id }}">
                                            <input type="hidden" name="parent_id" value="0">
                                            {{-- <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> --}}
                                            <input type="hidden" id="user_email" name="email" class="form-control"
                                                required="" value="{{ Auth::user()->email }}">
                                            <input type="hidden" id="user_name" name="name" class="form-control"
                                                required="" value="{{ Auth::user()->name }}">
                                            <div class="col-md-12">
                                                <div class="comment-detail m-2">
                                                    <img src="{{ asset('images/profile.png') }}" alt=""
                                                        style="width: 45px; border-radius: 50%; margin-right: 15px; margin-bottom: 5px;" />
                                                    <a href="#"
                                                        class="primary"><strong>{{ Auth::user()->name }}</strong></a>
                                                </div>
                                            </div>
                                        @else
                                            <input type="hidden" name="post_id" value="{{ $artikel->id }}">
                                            <input type="hidden" name="parent_id" value="0">
                                            <div class="row mb-4 mt-2">
                                                <div class="col">
                                                  <div class="form-outline">
                                                    <input type="text" id="user_name" name="name" value=""
                                                    placeholder="@lang('form.name')" class="form-control" required=""/>
                                                  </div>
                                                </div>
                                                <div class="col">
                                                  <div class="form-outline">
                                                    <input type="email" id="user_email" name="email" value=""
                                                    placeholder="@lang('form.email')" class="form-control" required="" />
                                                  </div>
                                                </div>
                                              </div>
                                            {{-- <div class="col-md-6">
                                                <input type="text" id="user_name" name="name" value=""
                                                    placeholder="@lang('form.name')" class="form-control" required="">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" id="user_email" name="email" value=""
                                                    placeholder="@lang('form.email')" class="form-control" required="">
                                            </div> --}}
                                        @endif
                                        <div class="form-outline w-100">
                                            <textarea class="form-control" id="textAreaExample" rows="4" style="background: #fff;" name="comment"></textarea>
                                            <label class="form-label" for="textAreaExample">@lang('form.message')</label>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="captcha"
                                                class="col-md-4 col-form-label text-md-right">Captcha</label>
                                            <div class="col-md-6 captcha">
                                                <span>{!! captcha_img('flat') !!}</span>
                                                <button type="button" class="btn btn-danger" class="reload" id="reload">
                                                    &#x21bb;
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="captcha" class="col-md-4 col-form-label text-md-right">@lang('form.enterCaptcha')</label>
                                            <div class="col-md-6">
                                                <input id="captcha" type="text" class="form-control"
                                                    placeholder="@lang('form.enterCaptcha')" name="captcha">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="btn form-control btn btn-dark mt-2" onclick="sendData({{$artikel->id }});">@lang('button.submit')</button>
                                        </div>
                                    @else
                                        <input type="hidden" name="post_id" value="{{ $artikel->id }}">
                                        <input type="hidden" name="parent_id" value="0">
                                        <div class="row mb-4 mt-2">
                                            <div class="col">
                                              <div class="form-outline">
                                                <input type="text" id="user_name" name="name" value=""
                                                placeholder="@lang('form.name')" class="form-control" required=""/>
                                              </div>
                                            </div>
                                            <div class="col">
                                              <div class="form-outline">
                                                <input type="email" id="user_email" name="email" value=""
                                                placeholder="@lang('form.email')" class="form-control" required="" />
                                              </div>
                                            </div>
                                          </div>
                                        <div class="form-outline w-100">
                                            <textarea class="form-control" id="textAreaExample" rows="4" style="background: #fff;" name="comment"></textarea>
                                            <label class="form-label" for="textAreaExample"@lang('form.message')</label>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="captcha"
                                                class="col-md-4 col-form-label text-md-right">Captcha</label>
                                            <div class="col-md-6 captcha">
                                                <span>{!! captcha_img('flat') !!}</span>
                                                <button type="button" class="btn btn-danger" class="reload"
                                                    id="reload">
                                                    &#x21bb;
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="captcha" class="col-md-4 col-form-label text-md-right">@lang('form.enterCaptcha')</label>
                                            <div class="col-md-6">
                                                <input id="captcha" type="text" class="form-control"
                                                    placeholder="@lang('form.enterCaptcha')" name="captcha">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="btn form-control btn btn-dark mt-2"  onclick="sendData({{$artikel->id}});">@lang('button.submit')</button>
                                        </div>
                                        <div class="col-md-12">
                                            <div id="comment-success" class="alert alert-success" style="display: none">
                                                Comment</div>
                                            <div id="loading-comment" style="display: none"><img
                                                    src="{{ asset('images/admin.png') }}"> <span class="color-primary">
                                                    loading...</span></div>
                                        </div>
                                    @endif
                                </form>
                                <div id="content-comment"></div>


                                {{-- <!-- Fetch Comments -->
                                <div class="card my-4">
                                    <h5 class="card-header">Comments <span class="badge badge-dark">{{count($artikel->comment)}}</span></h5>
                                    <div class="card-body">
                                        @if ($detail->comments)
                                            @foreach ($detail->comments as $comment)
                                                <blockquote class="blockquote">
                                                    <p class="mb-0">{{$comment->comment}}</p>
                                                    @if ($comment->user_id == 0)
                                                    <footer class="blockquote-footer">Admin</footer>
                                                    @else
                                                    <footer class="blockquote-footer">{{ $comment->user->name }}</footer>
                                                    @endif
                                                </blockquote>
                                                <hr/>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div> --}}


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
                            <div class="related-post d-flex">
                                <img width="150px" height="100px" src="{{ asset('images/' . $row->featured_image) }}"
                                    alt="">
                                <div class="ms-3">
                                    <a href="{{ url('artikel/' . $slug) }}"
                                        style="text-decoration: none; text-transform: capitalize; color: #656565; font-weight: 600;font-family: Lato, helvetica, sans-serif;">
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
                                <a href="https://www.instagram.com/niah.sh_/" class="social-instagram">
                                    <i class="fab fa-instagram"></i>
                                    <span>45.2 K<br>Followers</span>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/channel/UCPYlV5B34Q1b_3pOnYFz57w" class="social-youtube">
                                    <i class="fab fa-youtube"></i>
                                    <span>10.3 M<br>Subscribe</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    {{-- <h4 class="font-italic">@lang('showartikel.elseWhere')</h4>
                        <ol class="list-unstyled">
                            <li><a href="#">GitHub</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Facebook</a></li>
                        </ol> --}}
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
            left: 169px;
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

        .fa-youtube:before {
            content: \f167;
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
@section('script')
    {{-- INI BUAT LIKE POST --}}

    <script>
        function btnLike(idPosts) {
            console.log(idPosts);
            $.ajax({
                type: 'POST',
                url: "{{ route('saveLike')}}",
                cache: false,
                data: {id: idPosts},
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
                success: function(response) {
                    if ($('.go-like').hasClass('btn-danger')) {
                            $('.go-like').removeClass('btn-danger');
                            $('.go-like').addClass('btn-white');
                            $('.go-like').html('<span class="fas fa-heart"></span>@lang('button.like') | '+response);
                        } else {
                            $('.go-like').removeClass('btn-white');
                            $('.go-like').addClass('btn-danger');
                            $('.go-like').html('<span class="fas fa-heart"></span>@lang('button.liked') | '+response);
                        }
                }
            });


        }


    // {{-- FINISH LIKE POST --}}



        var url = "{{ url('get-comment/' . $artikel->id) }}"
        getComment(url)
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: '{{ route('reloadCaptcha') }}',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });

        function getComment(url) {
            $.ajax({
                type: "GET",
                url: url,
                cache: false,
                success: function(response) {
                    $('#loading').hide();
                    $('#content-comment').html(response);
                    $('.pagination a').on('click', function(e) {
                        e.preventDefault();
                        var url_page = $(this).attr('href');
                        getComment(url_page);
                    });
                }
            })
        }

        function sendData() {
        var data = new FormData($("#comment-form")[0])

        $.ajax({
            type: "POST",
            url: "{{ route('storeComment') }}",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                // console.log(response);
                getComment(url)
            }
        });
    }

        // function btnLike(idPosts) {
        //     // console.log(idPosts);
        //     $.ajax({
        //         url: "{{ route('saveLike') }},
        //         cache: false,
        //         data: idPosts,
        //         success: function(response) {
        //             console.log(response);
        //             // $('#loading').hide();
        //             // $('#content-comment').html(response);
        //             // $('.pagination a').on('click', function(e) {
        //             //     e.preventDefault();
        //             //     var url_page = $(this).attr('href');
        //             //     getComment(url_page);
        //             // });
        //         }
        //     });
        // function btnLike(e, id) {
        // e.preventDefault();
        // $.ajax({
        //     url: "{{ route('saveLike') }}",
        //     cache: false,
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('post_id')
        //     },
        //     success: function(response) {
        //         console.log(response);
        //     }
        // });
    // }
    </script>
@endsection
