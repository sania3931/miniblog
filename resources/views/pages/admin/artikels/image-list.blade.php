@foreach ($post_picture as $row)
<div class="col-md-4">
    <div class="card">
        <div class="wrap-image">
            <img class="card-img-top" src="{{ asset('images/' . $row->image) }}"
                alt="Card image cap">
            <div class="overlay">
                {{-- @if (Auth::user()->role == 'Admin')
                    <form id="form-delete-{{ $row->id }}" method="post"
                        action="{{ route('post_pictures.destroy', $row->id) }}">
                    @else
                        <form id="form-delete-{{ $row->id }}" method="post"
                            action="{{ route('member.post_pictures.destroy', $row->id) }}">
                @endif
                @csrf
                @method('delete') --}}
                <button class="btn-delete" type="button" value="{{ $row->id }}" onclick="deleteGambar(event, {{$row->id}})">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
                {{-- <button class="btn-submit" type="button" value="{{ $row->id }}" onclick="addGambar(event, {{$row->id}})">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                </button> --}}
                <a href="javascript:void(0);" class="btn btn-submit"
                    id="link{{ $row->id }}"
                    data-value="{{ asset('images/' . $row->image) }}">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                </a>
                {{-- <form id="form-add-{{ $row->id}}" method="post" action="{{ route('post_pictures.store', $row->id) }}">
                    @csrf
                    @method('post')
                    <div class="col-md-3">
                        <button class="btn-add" type="submit">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </button>
                    </div>
                    </form> --}}
            </div>
        </div>
        <div class="card-body">
            <h4 class="card-title mb-3">{{ $row->detail }}</h4>
        </div>
    </div>
</div>
@endforeach
<div class="col-12 mb-3">
    {{ $post_picture->appends($_GET)->links('vendor.pagination.bootstrap-4') }}
</div>
<script>
    $(".btn-submit").click(function() {
            var dataLink = $(this).attr('data-value');
            var id = $('.active').find('textarea')[0].id;
            var isi =
                "<div class='col-12 text-center mb-3 mt-3'><img class='img-fluid' style='margin-left: auto; margin-right: auto;' src='" +
                dataLink + "'/></div>"
            tinymce.get(id).execCommand('mceInsertContent', false, isi);
            $('#largeModal').modal('hide');
        });
</script>
