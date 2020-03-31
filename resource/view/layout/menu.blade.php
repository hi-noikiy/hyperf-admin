@if (empty($item['children']))
    <li class="nav-item">
        @if (is_valid_url($item['uri']))
            <a href="{{ $item['uri'] }}" class="_blank">
        @else
            <a href="{{ $item['uri'] }}" class="nav-link">
        @endif
            <i class="nav-icon fas {{ $item['icon'] }}"></i>
            <span>{{ $item['title'] }}</span>
        </a>
    </li>
@else
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas {{ $item['icon'] }}"></i>
            <p>
                <span>{{ $item['title'] }}</span>
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @foreach($item['children'] as $item)
                @include('layout.menu', $item)
            @endforeach
        </ul>
    </li>
@endif