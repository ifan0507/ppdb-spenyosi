<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach ($breadcrumb->list as $key => $value)
            @if ($key == count($breadcrumb->list) - 1)
                <li class="breadcrumb-item active">{{ $value }}</li>
            @else
                <li class="breadcrumb-item ">{{ $value }}</li>
            @endif
        @endforeach
    </ol>
</nav>
