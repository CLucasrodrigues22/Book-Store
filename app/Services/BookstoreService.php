<?php

namespace App\Services;

use App\Http\Requests\StoreBookstoreRequest;
use Illuminate\Http\Request;

use App\Http\Requests\UpdateBookstoreRequest;
use App\Models\Bookstore;

class BookstoreService
{
    /**
     * Displays the list of all relationships with store and book data relations
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllBookStoreRelationships()
    {
        $bookStore = BookStore::with('book', 'store')->get();
        return $bookStore;
    }

    /**
     * Create a new relationship between stores and books based on the data provided.
     *
     * @param array $data The book data to be created.
     * @return \App\Models\Bookstore The object of the relationship created.
     */
    public function createBookStore(StoreBookstoreRequest $request)
    {
        $bookStore = BookStore::create($request->all());

        return $bookStore;
    }
}
