@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Books') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('book.create')}}" class="link">
                        <i class="las la-file-alt"></i>
                        {{ __('Create Book') }}
                    </a>
                    <div class="flex mb-3">
                            <form method="GET" action="{{ route('books.index') }}">
                                <input name="q" type="text" class="form-control" 
                                       value="{{ request()->has('q') ? request()->get('q') : '' }}"
                                       placeholder="{{ __('Search by name of the author or title of the book') }}">
                                <button type="submit" class="btn btn-primary form-control">{{ __('Search') }}</button>
                            </form>
                        </div>
                    @if(count($books))
                    <div class="table-content container mb-5">
                        <div class="table-row header row">
                            <div class="col-md-3 px-4 py-3 hyphens">
                                {{ __('Title')  }}
                            </div>
                            <div class="col-md-3 px-4 py-3 hyphens">
                                {{ __('Author')  }}
                            </div>
                            <div class="col-md-3 px-4 py-3 hyphens">
                                {{ __('Price')  }}
                            </div>
                            <div class="col-md-3 px-4 py-3 name">
                                {{ __('Options') }}
                            </div>
                        </div>
                        @foreach($books as $book)
                            <div class="table-row row">
                                <div class="col-md-3  py-3" style="padding-left: 10px ; padding-right: 10px">
                                    {{ $book->title }}
                                </div>
                                <div class="col-md-3  py-3" style="padding-left: 10px ; padding-right: 10px">
                                    {{ $book->author }}
                                </div>
                                <div class="col-md-3  py-3" style="padding-left: 10px ; padding-right: 10px">
                                    {{ $book->price }} BGN
                                </div>
                                <div class="col-md-3 px-4 py-3">
                                    <a href="{{route('book.show', $book)}}"
                                       class="btn btn-success">
                                        <i class="las la-file-alt"></i>
                                        {{ __('Book Details') }}
                                    </a>
                            
                                    <a href="{{route('book.edit', $book)}}"
                                       class="btn btn-warning">
                                        <i class="las la-edit"></i>
                                        {{ __('Book Edit') }}
                                    </a>
                            
                                    <a href="{{route('book.download', $book)}}"
                                       class="btn btn-primary">
                                        <i class="las la-download"></i>
                                        {{ __('Book Download') }}
                                    </a>
                                            
                                </div>
                            </div>
                        @endforeach
                </div>
            @else
                <div class="my-3 text-center">
                    {{ __('No books yet') }}
                </div>
            @endif
        </div>
    </div>
    <div class="pagination-container mt-4 mb-5">
        <div class="custom-box">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection