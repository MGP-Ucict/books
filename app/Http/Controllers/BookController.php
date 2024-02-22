<?php

namespace App\Http\Controllers;

use App\EnumConstants\S3DiscConstants;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;


class BookController extends Controller
{
    /** 
     * List of books
     * 
     * @param BookFilters $filters
     * @return Application|Factory|View
     */
    public function index(BookFilters $filters)
    {
        return view('books.index', [
            'books' => Book::filter($filters)->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

     /**
     * Show the form for creating a new book.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('books.create');
    }

     /**
     * Show the form for editing a book.
     * 
     * @param Book $book
     * @return Application|Factory|View
     */
    public function edit(Book $book)
    {
        return view('books.edit', [
            'book' => $book
        ]);
    }

    /**
     * Download an e-book
     * 
     * @param Book $book
     * @return RedirectResponse|StreamedResponse
     */
    public function download(Book $book)
    {
        return Storage::disk(S3DiscConstants::Book)->download($book->file_name);
    }
