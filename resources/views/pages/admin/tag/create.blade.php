@extends('templates.admin.main')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong>@lang('titlecard.formAddUser')</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ url(Auth::user()->role . '/tag') }}" method="POST">
                @method('post')
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}" required>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" class="form-control" id="slug" value="{{ $item->slug }}" required>
                </div>
                <div class="form-group">
                    <label for="keywords">Keywords</label>
                    <input type="text" name="keywords" class="form-control" id="keywords" value="{{ $item->keywords }}" required>
                </div>
                <div class="form-group">
                    <label for="meta_desc">Meta Description</label>
                    <input type="text" name="meta_desc" class="form-control" id="meta_desc" value="{{ $item->meta_desc }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection


