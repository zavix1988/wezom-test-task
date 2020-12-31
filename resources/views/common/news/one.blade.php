@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('News dashboard') }}</div>
                    <div class="card-body">
                        <h2>{{$news->header}}</h2>
                        @if($news->image!='')
                        <img src="{{\Illuminate\Support\Facades\Storage::url("public/newsImg/".$news->image)}}" class="rounded float-left mr-3">
                        @endif
                        <p class="">{{$news->body}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
