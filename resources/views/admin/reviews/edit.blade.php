@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Edit review') }}</div>
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
                        <form method="POST" action="{{ route('admin.reviews.update', $review) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $review->name ?? '' }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $review->email ?? '' }}" required>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label>Text</label>
                                <textarea class="form-control" name="text" rows="15" required>{{ $review->text ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Published</label>
                                <select class="form-control" name="published">
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/renewCaptcha.js') }}" defer></script>

    </div>
@endsection
