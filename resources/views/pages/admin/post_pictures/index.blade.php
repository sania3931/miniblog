@extends('templates.admin.main')
@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="page-header">
                <h4 class="pageheader-title">@lang('titlecard.gallery')</h4>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <strong>@lang('titlecard.gallery')</strong>
                        </div>
                        <div class="card-body card-block">
                            <form id="form-gallery" action=" " method="post"
                                enctype="multipart/form-data" class="form-horizontal">
                                @method('post')
                                @csrf
                                <div class="row row-form">
                                    <div class="col-12">
                                        <label class=" form-control-label">@lang('form.detailImage')</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="name" name="detail" placeholder="@lang('form.detailImage')"
                                            class="form-control mb-3 @error('name') is-invalid @enderror" required
                                            value="{{ old('detail') }}">
                                        @error('detail')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="file-input" class=" form-control-label">@lang('form.fileImage')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" id="file-input" name="image"
                                            class="form-control-file @error('image') is-invalid @enderror">
                                            <img src="" alt="" id="gambar" width="300px">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <button class="btn btn-primary" type="button" onclick="sendData();">@lang('button.upload')</button>
                                </div>
                            </form>
                            <div class="container dashboard-content">
                                <div class="col-12 text-center" id="loading" style="display: none;">
                                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                                </div>
                                <div class="col-md-12">
                                    <div class="row m-t-30" id="content-gallery">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .wrap-image {
            position: relative;
        }

        /* .card-img-top {
            display: block;
            width: 100%;
            height: auto;
        } */

        .overlay {
            position: absolute;
            bottom: 0;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5);
            /* Black see-through */
            color: #f1f1f1;
            width: 100%;
            transition: .5s ease;
            opacity: 0;
            color: white;
            font-size: 20px;
            padding: 20px;
            text-align: center;
        }

        .wrap-image:hover .overlay {
            opacity: 1;
        }

        .btn-delete {
            color: white;
            font-size: 20px;
        }

        .fa-trash:hover {
            color: red;
        }

        .post {
            font-family: 'sfns_displayregular', sans-serif;
            display: block;
            margin: 0 auto 20px auto;
            margin-bottom: 20px;
            padding: 0;
            border: 1px solid #f1f1f1;
            border-radius: 3px;
            background: #fff;
            -webkit-box-shadow: 0 0 2px rgba(0, 0, 0, .1);
            -moz-box-shadow: 0 0 2px rgba(0, 0, 0, .1);
            box-shadow: 0 0 2px rgba(0, 0, 0, .1);
        }

        .panel-body {
            padding: 15px;
        }

        .img-responsive {
            display: block;
            max-width: 100%;
            height: 250px;
        }
        .media-image {
            display: block;
        }

        .media {
            position: relative;
            display: inline-block;
            vertical-align: top;
        }
        .pageheader-title h4 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 15px;
        }
    </style>
@endsection
@section('script')
    <script>
        var url ="{{ url(Auth::user()->role . '/post_pictures') }}"
        getGallery(url)

            function deleteGambar(e, id) {
                var url_del = "{{ url(Auth::user()->role . '/post_pictures') }}/"+id
                console.log(url_del);
                // e.preventDefault();
                Swal.fire({
                    title: '@lang('alert.areYouSure?')',
                    text: "@lang('alert.youWillDeleteThisData!')",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '@lang('alert.yesDeleteIt')',
                    cancelButtonText: '@lang('alert.noCancelIt')',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: url_del,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                            },
                            success: function (response) {
                                getGallery(url);
                            }
                        });
                        Swal.fire(
                            '@lang('alert.deleted')',
                            '@lang('alert.yourFileHasBeenDeleted')',
                            '@lang('alert.success')'
                        )
                    }
                })
            }

        function getGallery(url) {
            $.ajax({
                type: "GET",
                url: url,
                cache: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function(response) {
                    $('#loading').hide();
                    $('#content-gallery').html(response);
                    $('.pagination a').on('click', function(e) {
                        e.preventDefault();
                        var url_page = $(this).attr('href');
                        getGallery(url_page);
                    });
                }
            })
        }

        function readUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gambar').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }

        }

        $("#file-input").change(function (e) {
            e.preventDefault();
              readUrl(this);
        });

        function sendData() {
            var data = new FormData($("#form-gallery")[0])
            $.ajax({
                type: "POST",
                url: "{{ url(Auth::user()->role . '/post_pictures') }}",
                data: data,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function (){
                    $('#loading').show();
                },
                success: function (response) {
                        $("#form-gallery").trigger('reset');
                        $('#gambar').attr('src', '');
                        $('#loading').hide();
                        getGallery(url);
                }
            });
        }
    </script>
@endsection
