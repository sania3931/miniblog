@extends('templates.admin.main')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong>@lang('titlecard.formAddUser')</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ url('Admin/users') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
             @method('post')
             @csrf
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class=" form-control-label">@lang('form.name')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="text-input" name="name" placeholder="@lang('form.text')" class="form-control @error ('name') is-invalid @enderror" value="{{old('name')}}">
                        @error ('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="email-input" class=" form-control-label">@lang('form.email')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="email" id="email-input" name="email" placeholder="@lang('form.enterEmail')" class="form-control @error ('email') is-invalid @enderror" value="{{old('email')}}">
                        @error ('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="password-input" class=" form-control-label">@lang('form.password')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="password" id="password-input" name="password" placeholder="@lang('form.password')" class="form-control @error ('password') is-invalid @enderror" value="{{old('password')}}">
                        @error ('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="phone" class=" form-control-label" value="{{old('phone')}}">@lang('form.phone')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="text-input" name="phone" placeholder="@lang('form.text')" class="form-control @error ('phone') is-invalid @enderror">
                        @error ('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="select" class=" form-control-label">@lang('form.role')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="role" id="select" class="form-control @error ('role') is-invalid @enderror">
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> @lang('button.submit')
            </button>
            <a href="{{ url('Admin/users') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> @lang('button.cancel')
            </a>
        </div>
        </form>
    </div>
</div>
@endsection
