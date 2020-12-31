@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('News dashboard') }}</div>
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{route('admin.news.create')}}" role="button">Add news</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Header</th>
                                    <th scope="col">Published</th>
                                    <th scope="col">Views</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($news as $item)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$item->header}}</td>
                                    <td>
                                        @if($item->published)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td></td>
                                    <td>
                                        {{$item->views}}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="submit"
                                                    onclick="event.preventDefault(); document.getElementById('publish-form-{{$item->id}}').submit();"
                                                    class="btn btn-outline-primary"
                                            ><i class="mdi mdi-publish"></i></button>
                                            <button type="submit"
                                                    onclick="event.preventDefault(); document.getElementById('delete-form--{{$item->id}}').submit();"
                                                    class="btn btn-danger"
                                            ><i class="mdi mdi-trash-can-outline"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <form id="publish-form-{{$item->id}}" method="post" action="{{route('admin.news.update', $item)}}">
                                    @method('PUT')
                                    @csrf
                                </form>
                                <form id="delete-form--{{$item->id}}" method="post" action="{{ route( 'admin.news.destroy', $item) }}">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>{{ $news->links() }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
