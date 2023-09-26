@foreach ($post_picture as $row)
    <div class="col-md-4">
        <div class="post panel-body">
            <div class="wrap-image">
                <img class="media-image card-img-top img-responsive" src="{{ asset('images/' . $row->image) }}"
                    alt="Card image cap">
                <div class="overlay">
                        <button class="btn-delete" type="button" value="{{ $row->id }}" onclick="deleteGambar(event, {{$row->id}})">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                </div>
            </div>
            <div class="card-body">
                <h4 class="card-title mb-3">{{ $row->detail }}</h4>
            </div>
        </div>
    </div>
@endforeach
<div class="col-12">
    {{ $post_picture->appends($_GET)->links('vendor.pagination.bootstrap-4') }}
</div>
