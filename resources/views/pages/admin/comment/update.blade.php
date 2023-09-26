<div class="modal-header">
    <h5 class="modal-title" id="mediumModalLabel">@lang('titlecard.updateTag')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="" method="POST" id="form-edit-tag">
    @method('put')
    @csrf
    <div class="modal-body">
            <div class="form-group ">
                <label class=" form-control-label">@lang('form.nameTag')</label>
                <input type="hidden" name="tag_id" value="{{$comment ->id }}">
                <input type="text" id="name" name="name" placeholder="@lang('table.name')" class="form-control mb-3 @error ('name') is-invalid @enderror" required value="{{ $tags ->name }}">
                @error ('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
    <div class="modal-footer">
        {{-- <a href="{{ url('pages.admin.tag.index') }}" class="btn btn-success">@lang('button.cancel')</a> --}}
        <button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">@lang('button.cancel')</button>
        <button class="btn btn-primary btn-sm" type="button" onclick="saveData({{$tags ->id }});">@lang('button.edit')</button>
        {{-- <button type="submit" class="btn btn-primary">@lang('button.save')</button> --}}

    </div>
</form>
