@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Book Details') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-md-12 row p-4 mb-2">
                        <div class="label">{{ __('Title') }}</div>
                        <div class="text">
                            {{ $book->title }}
                        </div>
                    </div>
                    <div class="col-md-12 row p-4 mb-2">
                        <div class="label">{{ __('Author') }}</div>
                        <div class="text">
                            {{ $book->author }}
                        </div>
                    </div>
                    <div class="col-md-12 row p-4 mb-2">
                        <div class="label">{{ __('Count pages') }}</div>
                        <div class="text">
                            {{ $book->count_pages }}
                        </div>
                    </div>
                    <div class="col-md-12 row p-4 mb-2">
                        <div class="label">{{ __('Price') }}</div>
                        <div class="text">
                            {{ $book->price }}
                        </div>
                    </div>
                    <div class="col-md-12 row p-4 mb-2">
                        <div class="label">{{ __('Description') }}</div>
                        <div class="text">
                            {{ $book->description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection