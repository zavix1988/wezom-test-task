@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Reviews dashboard') }}</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col" >Text</th>
                                <th scope="col">Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $item)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{ $item->text }}</td>
                                    <td>
                                        {{$item->created_at->format('Y-m-d')}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            {{ $reviews->links() }}
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
