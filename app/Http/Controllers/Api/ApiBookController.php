<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateBookImageRequest;
use App\Services\BookService;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

class ApiBookController extends ApiController
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        return $this->bookService->getAllBooks();
    }

    public function store(BookRequest $request)
    {
        return $this->bookService->createBook($request->validated());
    }

    public function show($id)
    {
        return $this->bookService->getBookById($id);
    }

    public function update(BookRequest $request, $id)
    {
        return $this->bookService->updateBook($id, $request->validated());
    }

    public function updateImage(UpdateBookImageRequest $request)
    {
        $book = $this->bookService->updateBookImage($request->validated());
        return response()->json($book, 200);
    }

    public function searchByAuthorLastName(Request $request)
    {
        $authorLastName = $request->query('query');

        $books = $this->bookService->searchByAuthorLastName($authorLastName);

        return response()->json($books, 200);
    }




}
