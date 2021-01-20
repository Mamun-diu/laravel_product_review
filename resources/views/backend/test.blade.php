@extends('backend/master')
@section('content')
    <div class="container">

        @foreach ($product as $item)
        <img src="{{ asset('public/images')}}/{{ $item->image }}" alt="">
        <h1>{{ $item->name }}</h1>
        <h2>{{ $item->brand }}</h2>

        <div>
            <?php
            echo $item->details
        ?>
        </div>

        @endforeach

    </div>

@endsection
