@extends('layouts.index')
@section('title', 'Homepage')

@section('content')
    <div class="container">
        {{-- Hero Page --}}
        <div class="flex justify-center items-center h-[100vh]">
            <h1 class="text-center text-5xl font-bold">[Hero Page]</h1>
        </div>
        <div class="divider px-20"></div>
        {{-- Chart --}}
        <div class="h-[90vh] px-14">
            <h1 class="text-4xl font-bold">[Chart Page]</h1>
        </div>

        <div class="divider px-20"></div>
    </div>
@endsection
