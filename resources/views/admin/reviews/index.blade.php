@extends('layouts.admin')

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
                                <th scope="col">Email</th>
                                <th scope="col">Text</th>
                                <th scope="col">Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reviews as $item)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->text}}</td>
                                    <td>
                                        @if($item->published)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td></td>
                                    <td>
                                        <div class="btn-group">
                                            <button
                                                onclick="event.preventDefault(); document.getElementById('publish-form-{{$item->id}}').submit();"
                                                type="submit" class="btn btn-outline-primary"
                                            ><i class="mdi mdi-publish"></i></button>
                                            <a class="btn btn-secondary" href="{{route('admin.reviews.edit', $item)}}"><i class="mdi mdi-pencil-outline"></i></a>
                                            <button
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{$item->id}}').submit();"
                                                type="submit" class="btn btn-danger"
                                            ><i class="mdi mdi-trash-can-outline"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <form id="publish-form-{{$item->id}}" method="post" action="{{route('admin.reviews.publish', $item)}}">
                                    @method('PUT')
                                    @csrf
                                </form>
                                <form id="delete-form-{{$item->id}}" method="post"  action="{{ route( 'admin.reviews.destroy', $item) }}">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>{{ $reviews->links() }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
