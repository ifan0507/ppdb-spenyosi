<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard-siswa') }}">Dashboard</a></li>

        @if (isset($breadcrumb))
            @foreach ($breadcrumb as $key => $link)
                @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">{{ $key }}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{ $link }}">{{ $key }}</a></li>
                @endif
            @endforeach
        @endif
    </ol>
</nav>