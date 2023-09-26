@extends('templates.admin.main')
@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <form action="{{ url(Auth::user()->role . '/artikels') }}" method="post" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="row m-t-30">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <strong>@lang('titlecard.createNewArticle')</strong>
                            </div>
                            <div class="card-body card-block">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item active">
                                        <a class="nav-link active" id="indonesia-tab" data-toggle="tab" href="#indonesia"
                                            role="tab" aria-controls="indonesia" aria-selected="true">Indonesia</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="english-tab" data-toggle="tab" href="#english"
                                            role="tab" aria-controls="english" aria-selected="false">English</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent" style="margin-top: 2rem;">
                                    <div class="tab-pane fade active  show" id="indonesia" role="tabpanel"
                                        aria-labelledby="indonesia-tab">
                                        <div class="row form-group">
                                            <div class="col-12">
                                                <label class=" form-control-label">Judul</label>
                                            </div>

                                            <div class="col-12">
                                                <input type="text" id="text-input" name="title"
                                                    placeholder="Masukkan judul disini"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    value="{{ old('title') }}">
                                                @error('title')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <button type="button" class="btn btn-success mb-1 btn-add" data-toggle="modal"
                                                data-target="#largeModal">Tambahkan Gambar</button>
                                        </div>
                                        <div class="col-12">
                                            <textarea name="content" class="tinymce" id="" cols="90" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="english" role="tabpanel" aria-labelledby="english-tab">
                                        <div class="row form-group">
                                            <div class="col-12">
                                                <label class=" form-control-label">Title</label>
                                            </div>

                                            <div class="col-12">
                                                <input type="text" id="text-input" name="title_en"
                                                    placeholder="Enter title here"
                                                    class="form-control @error('title_en') is-invalid @enderror"
                                                    value="{{ old('title_en') }}">
                                                @error('title')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <button type="button" class="btn btn-success mb-1 btn-add" data-toggle="modal"
                                                data-target="#largeModal">Add Image</button>
                                        </div>
                                        <div class="col-12">
                                            <textarea name="content_en" class="tinymce" id="" cols="90" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button name="status" type="submit" class="btn btn-success btn-sm"
                                        value="1">@lang('button.save')
                                    </button>
                                    <button name="status" type="submit" class="btn btn-outline-success btn-sm"
                                        value="0">@lang('button.saveToDraft')
                                    </button>
                                    <a href="{{ url(Auth::user()->role . '/artikels') }}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-chevron-left"></i> @lang('button.back')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <strong>@lang('titlecard.featuredImage')</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="row row-form">
                                    <div class="col-12">
                                        <input type="file" id="file-input" name="featured_image"
                                            class="form-control-file @error('featured_image') is-invalid @enderror">
                                        @error('featured_image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 m-b-30">
                                <label for="">@lang('form.category')</label>
                                <select name="category_id" id="select" class="form-control">
                                    <option value="" hidden>Category Parent</option>
                                    @foreach ($category as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 m-b-30">
                                <label for="">@lang('form.tags')</label>
                                <select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="largeModal" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">@lang('titlecard.imageGallery')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-gallery" action=" " method="POST" enctype="multipart/form-data">
                    @method('post')
                    @csrf
                    <div class="modal-body">
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
                                <input type="file" id="file-input-gambar" name="image"
                                    class="form-control-file @error('image') is-invalid @enderror">
                                    <img src="" alt="" id="gambar" width="300px">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button class="btn btn-primary" type="button"
                                onclick="sendData();">@lang('button.upload')</button>
                        </div>
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
                    {{-- @foreach ($post_picture as $row)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="wrap-image">
                                            <img class="card-img-top" src="{{ asset('images/' . $row->image) }}"
                                                alt="Card image cap">
                                            <div class="overlay">
                                                @if (Auth::user()->role == 'Admin')
                                                    <form id="form-delete-{{ $row->id }}" method="post"
                                                        action="{{ route('post_pictures.destroy', $row->id) }}">
                                                    @else
                                                        <form id="form-delete-{{ $row->id }}" method="post"
                                                            action="{{ route('member.post_pictures.destroy', $row->id) }}">
                                                @endif
                                                @csrf
                                                @method('delete')
                                                <button class="btn-delete" type="button" value="{{ $row->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                                <a href="javascript:void(0);" class="btn btn-submit"
                                                    id="link{{ $row->id }}"
                                                    data-value="{{ asset('images/' . $row->image) }}">
                                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                </a>
                                                </form> --}}
                    {{-- <form id="form-add-{{ $row->id}}" method="post" action="{{ route('post_pictures.store', $row->id) }}">
                                                    @csrf
                                                    @method('post')
                                                    <div class="col-md-3">
                                                        <button class="btn-add" type="submit">
                                                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    </form> --}}
                    {{-- </div>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title mb-3">{{ $row->detail }}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .modal-xl {
            max-width: 1040px;
        }

        .wrap-image {
            position: relative;
        }

        .card-img-top {
            display: block;
            width: 100%;
            height: 250px;
        }

        .overlay {
            position: absolute;
            bottom: 0;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5);
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

        .btn-submit {
            color: white;
            font-size: 20px;
        }

        .fa-trash:hover {
            color: red;
        }

        .fa-plus-square:hover {
            color: green;
        }
    </style>
@endsection
@section('script')
    <script>
        var url = "{{ url(Auth::user()->role . '/gambar-artikel') }}"
        getGallery(url)

        function deleteGambar(e, id) {
            var url_del = "{{ url(Auth::user()->role . '/post_pictures') }}/" + id
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
                        success: function(response) {
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
                beforeSend: function() {
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

        $("#file-input-gambar").change(function(e) {
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
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(response) {
                    $("#form-gallery").trigger('reset');
                    $('#gambar').attr('src', '');
                    $('#loading').hide();
                    getGallery(url);
                }
            });
        }



        function addGambar(e, id) {
            var url_add = "{{ url('Admin/artikels/${id}/create') }}/"+id
            console.log(url_add);
            // var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: url_add,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                success: function(response) {
                    getGallery(url);
                    // $('.modal-content').html(response);
                    // $('#largeModal').modal('show');
                    // $('.modal-backdrop').hide()
                }
            });
        }

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "@lang('form.selectTag')",
                tags: true
            });
        });
    </script>
@endsection
