<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Book;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookService
{
    use ApiResponse;

    public function getAllBooks()
    {
        return $this->success(Book::with('authors')->paginate(12));
    }

    public function createBook($data)
    {
        DB::beginTransaction();
        try {
            if (isset($data['image'])) {
                $imagePath = $this->storeImage($data['image']);
                $data['image'] = $imagePath;
            }

            $book = Book::create($data);

            $this->syncAuthors($book, $data['author_ids']);
            DB::commit();
            return $this->success($book->load('authors'));

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error(500);
        }

    }

    private function storeImage($image)
    {
        $path = Storage::disk('public')->put('books', $image);
        return $path;
    }

    public function getBookById($id)
    {
        return $this->success(Book::with('authors')->findOrFail($id));
    }

    public function updateBook($id, array $data)
    {
        try {
            DB::beginTransaction();

            $book = Book::findOrFail($id);

            $book->update($data);

            $this->syncAuthors($book, $data['author_ids']);

            DB::commit();

            return $this->success($book->load('authors'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Failed to update book.', 500);
        }
    }

    private function syncAuthors(Book $book, array $authorIds)
    {
        if (isset($authorIds) && is_array($authorIds)) {
            $book->authors()->sync($authorIds);
        } else {
            $book->authors()->detach();
        }
    }

    public function updateBookImage($data)
    {
        $book = Book::findOrFail($data['id']);

        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }
        $book->image = $this->storeImage($data['image']);
        $book->save();

        return $this->success($book->load('authors'));
    }


}

