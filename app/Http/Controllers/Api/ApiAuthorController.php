<?php

namespace App\Http\Controllers\Api;

use App\Services\AuthorService;
use App\Http\Requests\AuthorRequest;

class ApiAuthorController extends ApiController
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        return $this->authorService->getAllAuthors();
    }

    public function store(AuthorRequest $request)
    {
        return $this->authorService->createAuthor($request->validated());
    }

    public function show($id)
    {
        return $this->authorService->getAuthorById($id);
    }

    public function update(AuthorRequest $request, $id)
    {
        return $this->authorService->updateAuthor($id, $request->validated());
    }

}
