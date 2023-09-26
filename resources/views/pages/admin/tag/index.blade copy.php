@extends('templates.admin.main')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <a href="{{ url('Admin/tag/create') }}" type="button" class="btn btn-primary mb-3"> @lang('button.add')</a>
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>@lang('table.name')</th>
                                    <th>@lang('table.slug')</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->slug }}</td>
                                        <td>
                                            {{-- <button type="button" action="{{ url('admin/users/'.$userss->id )}}" class="btn btn-success btn-sm mb-1 btn-edit" data-id="{{$userss->id}}">Edit</button> --}}
                                            <form id="form-delete-{{ $row->id }}" method="post"
                                                action="{{ url('Admin/tag/' . $row->id) }}">
                                                <a href="{{ route('tag.edit', $row->name) }}"
                                                    class="btn btn-success btn-sm">@lang('button.edit')</a>
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn-delete btn btn-danger btn-sm "
                                                    value="{{ $row->id }}">@lang('button.delete')</button>

                                            </form>
                                            {{-- <button class="btn btn-danger">Delete</button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-delete').click(function(e) {
                e.preventDefault();
                var id = $(this).val()
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
                        $('#form-delete-' + id).submit()
                        Swal.fire(
                            '@lang('alert.deleted')',
                            '@lang('alert.yourFileHasBeenDeleted')',
                            '@lang('alert.success')'
                        )
                    }
                })
            });
        })
    </script>
@endsection


{{-- <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Keywords</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $key => $item)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->keywords }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal-{{ $item->id }}">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{route('tags.destroy', [$item->id])}}" class="d-inline" onsubmit="return confirm('Delete this data permanently?')">
                                    @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Tag</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('tags.update', $item->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="PUT">
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
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="keywords">Keywords</label>
                            <input type="text" name="keywords" class="form-control" id="keywords" required>
                        </div>
                        <div class="form-group">
                            <label for="meta_desc">Meta Description</label>
                            <input type="text" name="meta_desc" class="form-control" id="meta_desc" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
