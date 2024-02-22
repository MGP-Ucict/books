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
                    <a href="{{route('book.show', $book)}}" class="link">
                        <i class="las la-file-alt"></i>
                        {{ __('Create Book') }}
                    </a>
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
                                {{ __('Опции') }}
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
                                    <dropdown-button arrow="true" button="
                                        <span class='link'>
                                            <img width='15px' style='margin: -2px 5px 0 0;'src='{{asset('images/icons/icon-settings.png')}}'/>{{__('Опции')}}
                                        </span>">
                                        <div>
                                            <ul>
                                                <li>
                                                    <a href="{{route('book.show', $book)}}"
                                                       class="link">
                                                        <i class="las la-file-alt"></i>
                                                        {{ __('Book Details') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('book.edit', $book)}}"
                                                       class="link">
                                                        <i class="las la-edit"></i>
                                                        {{ __('Book Edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{route('book.show', $book)}}"
                                                       class="link">
                                                        <i class="las la-download"></i>
                                                        {{ __('Book Download') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </dropdown-button>
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