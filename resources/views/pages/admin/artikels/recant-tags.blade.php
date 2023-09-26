@foreach ($tags as $row)
    <li class="tag-recent d-inline-block m-1">
        <a href="javascript:void(0)" onclick="deletetags(event, {{ $row->id }}); return false;">
            <span><i class="fa fa-times text-white" aria-hidden="true" width="10px"></i></span>
        </a> {{ $row->name }}
    </li>
@endforeach
</ul>
<style>
    .tag-recent {
        background-color: orange;
        color: white;
        font-size: 12px;
        padding: 3px;
        border-radius: 7px;
    }
</style>
