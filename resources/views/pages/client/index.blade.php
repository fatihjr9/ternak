@extends('layouts.client')
@section('content')
<div class="flex flex-col space-y-2">
    <h5 class="text-lg font-bold">Hewan ternak</h5>
    <div class="grid grid-cols-2 lg:grid-cols-4 2xl:grid-cols-6 gap-4">
        @foreach($data as $item)
            <x-card :data="$item"/>
        @endforeach    
    </div>
</div>
@endsection