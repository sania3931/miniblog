<div class="container my-5 py-5">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col">
                            @foreach ($comment as $row)
                                <div class="d-flex flex-start">
                                    <img class="rounded-circle m-1"
                                        src="{{ asset('images/profile.png') }}" alt="avatar"
                                        width="65" height="65">
                                    <div class="flex-grow-1 flex-shrink-1">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-1 text-name">
                                                    {{ $row->name }} <span class="small">-
                                                        {{ $row->created_at }}</span>
                                                </p>
                                                <a class="btn btn-primary" data-mdb-toggle="collapse"
                                                    href="#collapseExample-{{ $row->id }}" role="button"
                                                    aria-expanded="false" aria-controls="collapseExample"><i
                                                        class="fas fa-reply fa-xs"></i><span class="small">
                                                        @lang('button.replay')</span></a>
                                            </div>
                                            <p class="small mb-0">
                                                {{ $row->comment }}
                                            </p>
                                        </div>
                                        @foreach ($replay->where('parent_id', $row->id) as $replayer)
                                            <div class="d-flex flex-start mt-4">
                                                <a class="me-3" href="#">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('images/profile2.png') }}"
                                                        alt="avatar" width="65" height="65">
                                                </a>
                                                <div class="flex-grow-1 flex-shrink-1">
                                                    <div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-1 text-name">
                                                                {{ $replayer->name }} <span class="small">-
                                                                    {{ $replayer->created_at }}</span>
                                                            </p>
                                                        </div>
                                                        <p class="small mb-0">
                                                            {{ $replayer->comment }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="collapse mt-3" id="collapseExample-{{ $row->id }}">
                                            <form id="replay-form-{{ $row->id }}" class="form-comment"
                                                method="post" action="{{ url('save-comment') }}">
                                                @csrf
                                                @method('post')
                                                @if (Auth::check())
                                                    @if (Auth::user()->role == 'Member')
                                                        <input type="hidden" name="post_id"
                                                            value="{{ $row->post_id }}">
                                                        <input type="hidden" name="parent_id"
                                                            value="{{ $row->id }}">
                                                        <input type="hidden" id="user_email" name="email"
                                                            class="form-control" required=""
                                                            value="{{ Auth::user()->email }}">
                                                        <input type="hidden" id="user_name" name="name"
                                                            class="form-control" required=""
                                                            value="{{ Auth::user()->name }}">
                                                        <div class="card-footer py-3 border-0"
                                                            style="background-color: #f8f9fa;">
                                                            <div class="d-flex flex-start w-100">
                                                                <img src="{{ asset('images/profile.png') }}"
                                                                    alt="" class="rounded-circle me-3"
                                                                    style="width: 45px; border-radius: 50%; margin-right: 15px; margin-bottom: 5px;" />
                                                                <a href="#"
                                                                    class="fw-bold text-primary m-1"><strong>{{ Auth::user()->name }}</strong></a>
                                                                <p class="text-muted small m-1">
                                                                    {{ $row->created_at }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <input type="hidden" name="post_id"
                                                            value="{{ $row->post_id }}">
                                                        <input type="hidden" name="parent_id"
                                                            value="{{ $row->id }}">
                                                        <div class="row mb-4 mt-2">
                                                            <div class="col">
                                                              <div class="form-outline">
                                                                <input type="text" id="user_name" name="name" value=""
                                                                placeholder="@lang('form.name')" class="form-control" required=""/>
                                                                <label class="form-label">@lang('form.name')</label>
                                                              </div>
                                                            </div>
                                                            <div class="col">
                                                              <div class="form-outline">
                                                                <input type="email" id="user_email" name="email" value=""
                                                                placeholder="@lang('form.email')" class="form-control" required="" />
                                                                <label class="form-label">@lang('form.email')</label>
                                                              </div>
                                                            </div>
                                                          </div>
                                                    @endif
                                                    <div class="form-outline w-100">
                                                        <textarea class="form-control" id="textAreaExample" rows="4" style="background: #fff;" name="comment"></textarea>
                                                        <label class="form-label"
                                                            for="textAreaExample">@lang('form.message')</label>
                                                    </div>
                                                    <div class="float-end mt-2 p-10">
                                                        <button type="button"
                                                            class="btn form-control btn btn-dark mt-2"
                                                            onclick="sendReplay({{ $row->id }});">@lang('button.submit')</button>
                                                    </div>
                                                @else
                                                    <input type="hidden" name="post_id"
                                                        value="{{ $row->post_id }}">
                                                    <input type="hidden" name="parent_id"
                                                        value="{{ $row->id }}">
                                                        <div class="row mb-4 mt-2">
                                                            <div class="col">
                                                              <div class="form-outline">
                                                                <input type="text" id="user_name" name="name" value=""
                                                                placeholder="@lang('form.name')" class="form-control" required=""/>
                                                                <label class="form-label">@lang('form.name')</label>
                                                              </div>
                                                            </div>
                                                            <div class="col">
                                                              <div class="form-outline">
                                                                <input type="email" id="user_email" name="email" value=""
                                                                placeholder="@lang('form.email')" class="form-control" required="" />
                                                                <label class="form-label">@lang('form.email')</label>
                                                              </div>
                                                            </div>
                                                          </div>
                                                    <div class="form-outline w-100">
                                                        <textarea class="form-control" id="textAreaExample" rows="4" style="background: #fff;" name="comment"></textarea>
                                                        <label class="form-label"
                                                            for="textAreaExample">@lang('form.message')</label>
                                                    </div>
                                                    <div class="col-md-6 float-end mt-2 pt-1">
                                                        <button type="button"
                                                            class="btn form-control btn btn-dark mt-2"
                                                            onclick="sendReplay({{ $row->id }});">@lang('button.submit')</button>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div id="comment-success" class="alert alert-success"
                                                            style="display: none">
                                                            Comment</div>
                                                        <div id="loading-comment" style="display: none"><img
                                                                src="{{ asset('images/admin.png') }}"> <span
                                                                class="color-primary">
                                                                loading...</span></div>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    <div id="replay-comment"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    {{ $comment->appends($_GET)->links('vendor.pagination.bootstrap-4') }}
</div>
<style>
    .text-name {
        font-family: Arial, Helvetica, sans-serif;
        color: black;
        text-transform: capitalize;
    }
</style>

<script>
    function sendReplay(id) {
        var data = new FormData($("#replay-form-" + id)[0])
        console.log('ok');
        $.ajax({
            type: "POST",
            url: "{{ route('storeReplay') }}",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                // console.log(response);
                getComment(url)
            }
        });
    }
</script>
