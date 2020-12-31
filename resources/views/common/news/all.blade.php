@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('News dashboard') }}</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Header</th>
                                    <th scope="col"><a href="{{ route('common.news.sort', ['views', $direction]) }}">Views</a></th>
                                    <th scope="col"><a href="{{ route('common.news.sort', ['created_at', $direction]) }}">Data</a></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($news as $item)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td><a href="{{route('common.news.show', $item)}}" class="card-link">{{$item->header}}</a></td>
                                    <td>
                                        {{$item->views}}
                                    </td>
                                    <td>
                                        {{$item->created_at->format('Y-m-d')}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                {{ $news->links() }}
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
