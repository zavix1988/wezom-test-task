@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Add News') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>News header</label>
                                <input type="text" class="form-control" name="header" value="{{ old('header') }}" required>
                            </div>
                            <div class="form-group">
                                <label>News body</label>
                                <textarea class="form-control" name="body" rows="15" required>{{ old('body') }}</textarea>
                            </div>
                            <div class="custom-file">
                                <label class="custom-file-label">Choose news image</label>
                                <input type="file" name="image" class="custom-file-input">
                            </div>
                            <div class="form-group">
                                <label>Published</label>
                                <select class="form-control" name="published">
                                    <option>Yes</option>
                                    <option selected>No</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add news</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
