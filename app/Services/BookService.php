<?php

namespace App\Services;

use App\Http\Requests\StoreBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use App\Models\Books;

class BookService
{
    /**
     * Gets a list of all the books in the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllBooks()
    {
        $books = Books::all();
        return $books;
    }

    /**
     * Creates a new book based on the data provided.
     *
     * @param array $data The book data to be created.
     * @return \App\Models\Books The object of the book created.
     */
    public function createBook(StoreBooksRequest $request)
    {
        // POST ["name", "isbn", "value"]
        $book = Books::create($request->all());
        return $book;
    }

    /**
     * Gets a specific book based on the ID provided.
     *
     * @param int $id The ID of the book to be obtained.
     * @return \App\Models\Books|null The object of the book or null if not found.
     */
    public function getBookById($id)
    {
        // GET by {id}
        $book = Books::find($id);
        return $book;
    }

    /**
     * Updates the data of an existing book based on the ID provided.
     *
     * @param int $id The ID of the book to be updated.
     * @param array $data The book data to be updated.
     * @return \App\Models\Books The subject of the book updated.
     */
    public function updateBook(UpdateBooksRequest $request, $bookId)
    {
        // PUT ["name", "isbn", "value"] by id
        $book = Books::find($bookId);
        if ($book) {
            $book->update($request->all());
            return $book;
        } else {
            return $book;
        }
    }

    /**
     * Delete a specific book based on the ID provided.
     *
     * @param int $id The ID of the book to be deleted.
     * @return \App\Models\Books The object of the book or null if not found.
     */
    public function deleteBook($bookId)
    {
        // DELETE by {id}
        $book = Books::find($bookId);
        if ($book) {
            $book->delete();
            return $book;
        } else {
            return $book;
        }
    }
}
