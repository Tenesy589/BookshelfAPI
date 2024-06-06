<?php

namespace App\Services;

use App\Models\Author;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class AuthorService
{
    use ApiResponse;

    public function getAllAuthors()
    {
        return $this->success(Author::with('books')->paginate(12));
    }

    public function getAuthorById($id)
    {
        return $this->success(Author::with('books')->findOrFail($id));
    }

    public function createAuthor($data)
    {
        DB::beginTransaction();
        try {
            $author = Author::create($data);
            $this->attachBooks($author, $data['book_ids'] ?? []);
            DB::commit();
            return $author->load('books');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }
    }

    public function updateAuthor($id, array $data)
    {
        $author = Author::findOrFail($id);

        DB::beginTransaction();
        try {
            $author->update($data);
            $this->syncBooks($author, $data['book_ids'] ?? []);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }

        return $this->success($author->load('books'));
    }

    private function attachBooks(Author $author, array $bookIds)
    {
        if (!empty($bookIds)) {
            $author->books()->attach($bookIds);
        }
    }

    private function syncBooks(Author $author, array $bookIds)
    {
        if (!empty($bookIds)) {
            $author->books()->sync($bookIds);
        } else {
            $author->books()->detach();
        }
    }
}
