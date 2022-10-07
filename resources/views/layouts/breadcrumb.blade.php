@php
    $prefix = Request::route()->getName();
    $title = explode('.', $prefix);
    $t = str_replace('-', ' ', $title[0]);
    $titulo = ucwords($t);
@endphp

<div class="pagetitle">
    {{-- <h1>{{ ucfirst($title[0]) }}</h1> --}}
    <nav>
        <ol class="breadcrumb p-2" style="background: rgba(235, 235, 235, 0.795); border-radius: 2px;">
            <li class="breadcrumb-item"><a style="color:#0073bb" href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $titulo }}</li>
        </ol>
    </nav>
</div>