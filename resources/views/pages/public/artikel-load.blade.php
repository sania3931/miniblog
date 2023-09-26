@foreach ($artikel as $row)
                    @php
                        if (app()->getlocale() == 'id') {
                            $slug = $row->slug ? $row->slug : $row->slug_en;
                        } else {
                            $slug = $row->slug_en ? $row->slug_en : $row->slug;
                        }
                    @endphp
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="{{ asset('images/' . $row->featured_image) }}" class="img-fluid" />
                                {{-- <a href="#!">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </a> --}}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    @if (app()->getlocale() == 'id')
                                            <td>{{ $row->title ??  $row->title_en }}</td>
                                        @else
                                            <td>{{ $row->title_en ?? $row->title }}</td>
                                        @endif</h5>
                                <p class="card-text">
                                    @if (app()->getlocale() == 'id')
                                        <td>{!! substr($row->content ?? $row->content_en, 0, 100) !!}</td>
                                    @else
                                        <td>{!! substr($row->content_en ?? $row->content, 0, 100) !!}</td>
                                    @endif
                                </p>
                                <a href="{{ url('artikel/' .$slug) }}" class="btn btn-primary">@lang('button.more')</a>
                            </div>
                        </div>
                    </div>
                @endforeach
