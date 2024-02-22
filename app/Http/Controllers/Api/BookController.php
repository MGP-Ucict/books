<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    /** 
     * @param Request $request
     * @throws ValidationExcepion
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validated([
            'title' => 'required|string',
            'author' => 'required|string',
            'count_pages' => 'required|integer|gt:0',
            'price' => 'required|gt:0',
            'description' => 'nullable',
            'file_name' => 'nullable|file|mimes:pdf|max:10240'
        ]);
        
        $validated['file_name'] = BookService::saveBookFile($validated);
        $book = Book::create($validated);

        return response()->json([
            'success' => true,
            'book'    => new BookResource($book)
        ]);
    }

     /**
     * @param Request $request
     * @param Book|Model $book
     * @throws ValidationExcepion
     * @return JsonResponse
     */
    public function update(Request $request, Book $book): JsonResponse
    {
        $validated = $request->validated([
            'title' => 'required|string',
            'author' => 'required|string',
            'count_pages' => 'required|integer',
            'price' => 'required',
            'description' => 'nullable',
            'file_name' => 'nullable|file|mimes:pdf|max:10240'
        ]);
        
        $validated['file_name'] = BookService::saveBookFile($validated);
        $book->update($validated);

        return response()->json([
            'success' => true,
            'book'    => new BookResource($book)
        ]);
    
    }
}
