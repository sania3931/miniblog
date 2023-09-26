<div class="modal-header">
    <h5 class="modal-title" id="mediumModalLabel">@lang('titlecard.updateCategory')</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="{{ url('Admin/categories/'.$category->id)}}" method="POST" id="form-edit-category">
    @method('put')
    @csrf
    <div class="modal-body">
            <div class="form-group ">
                <label class=" form-control-label">@lang('table.categoryName')</label>
                <input type="text" id="name" name="name" placeholder="@lang('table.categoryName')" class="form-control mb-3 @error ('name') is-invalid @enderror" required value="{{( $category->name )}}">
                @error ('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">@lang('form.categoryParent')</label>
                <select name="cat_parent_id" id="cat_parent_id" class="form-control">
                    @foreach ( $parent as $option)
                        <option value="{{ $option->id }}"@if($option->id == $category->cat_parent_id) selected @endif>{{ $option->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">@lang('form.parent')</label>
                <select name="is_parent" id="is_parent" class="form-control">
                    <option value="1" @if($category->is_parent == '1') selected @endif>Yes</option>
                    <option value="0" @if($category->is_parent == '0') selected @endif>No</option>
                </select>
            </div>
        </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">@lang('button.cancel')</button>
        <button class="btn btn-primary btn-sm" type="button" onclick="saveData({{$category ->id }});">@lang('button.save')</button>
        {{-- <button type="submit" class="btn btn-primary">@lang('button.save')</button> --}}
    </div>
</form>
