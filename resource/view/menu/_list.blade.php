@php
    $level = !empty($level) ? $level : 0;
@endphp

<li style="margin-left: {{ 1 * $level }}rem;">
    <span class="handle ui-sortable-handle">
        <i class="fas fa-ellipsis-v"></i>
        <i class="fas fa-ellipsis-v"></i>
    </span>
    <span class="text">{{ $item['title'] }}</span>&nbsp;&nbsp;&nbsp;
    <a href="/admin/menu/{{ $item['id'] }}/edit">{{ $item['uri'] }}</a>
    <span class="float-right">
        <a href="/admin/menu/{{ $item['id'] }}/edit"><i class="fas fa-edit"></i></a>
        <a href="javascript:void(0);" data-id="{{ $item['id'] }}" class="tree_branch_delete"><i class="fas fa-trash"></i></a>
    </span>
</li>
@if (!empty($item['children']))
    @php
        $temp_level1 = $level;
        $level += 2;
    @endphp
    @foreach($item['children'] as $item)
        <li style="margin-left: {{ $level }}rem;">
            <span class="handle ui-sortable-handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
            </span>
            <span class="text">{{ $item['title'] }}</span>&nbsp;&nbsp;&nbsp;
            <a href="/admin/menu/{{ $item['id'] }}/edit">{{ $item['uri'] }}</a>
            <span class="float-right">
                <a href="/admin/menu/{{ $item['id'] }}/edit"><i class="fas fa-edit"></i></a>
                <a href="javascript:void(0);" data-id="{{ $item['id'] }}" class="tree_branch_delete"><i class="fas fa-trash"></i></a>
            </span>
        </li>
        @if (!empty($item['children']))
            @php
                $temp_level2 = $level;
                $level += 2;
            @endphp
            @foreach($item['children'] as $item)
                @include('menu._list', $item)
            @endforeach
            @php
                $level = $temp_level2;
            @endphp
        @endif
    @endforeach
    @php
        $level = $temp_level1;
    @endphp
@endif
