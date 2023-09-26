@extends('templates.admin.main')
@section('content')
    <div class="container">
        <div class="page-header">
            <h2 class="pageheader-title mb-3">@lang('sidebar.about')</h2>

        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong>@lang('sidebar.about')</strong>
                </div>
                <div class="card-body card-block">
                    <form action="{{ url('Admin/about') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook"
                                value="{{ old('facebook') }}">
                            @error('facebook')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram"
                                value="{{ old('instagram') }}">
                            @error('instagram')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" class="form-control" id="twitter" name="twitter"
                                value="{{ old('twitter') }}">
                            @error('twitter')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editor">@lang('form.content')</label>
                            <textarea class="form-control" id="editor" rows="10" name="content"></textarea>
                            @error('content')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">@lang('button.edit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
