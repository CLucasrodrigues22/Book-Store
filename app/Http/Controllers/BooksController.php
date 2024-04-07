<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use App\Services\BookService;
use Illuminate\Http\Request;
use Exception;

/**
 * Class responsible for managing books.
 */

class BooksController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Returns a list of all books.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $books = $this->bookService->getAllBooks();
            return response()->json([
                "status" => true,
                "data" => $books,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Error when searching the book list.",
            ], 500);
        }
    }

    /**
     * Creates a new book based on the data provided.
     *
     * @param \App\Http\Requests\StoreBooksRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBooksRequest $request)
    {
        $book = $this->bookService->createBook($request);
        return response()->json([
            "status" => true,
            "data" => $book,
        ], 201);
    }

    /**
     * Displays the details of a specific book.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $book = $this->bookService->getBookById($id);
            if ($book === null) {
                return response()->json([
                    "status" => false,
                    "message" => "Book not found.",
                ], 404);
            } else {
                return response()->json([
                    "status" => true,
                    "data" => $book,
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "A server error has occurred.",
            ], 500);
        }
    }

    /**
     * Updates the data of an existing book based on the ID provided.
     *
     * @param  \App\Http\Requests\UpdateBooksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBooksRequest $request, $id)
    {
        try {
            $book = $this->bookService->updateBook($request, $id);
            if ($book === null) {
                return response()->json([
                    "status" => false,
                    "message" => "Book not found.",
                ], 404);
            } else {
                return response()->json([
                    "status" => true,
                    "data" => $book,
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "A server error has occurred.",
            ], 500);
        }
    }

    /**
     * Delete a specific book based on the ID provided.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $book = $this->bookService->deleteBook($id);

            if ($book) {
                return response()->json([
                    "status" => true,
                    "message" => "Successfully deleted book.",
                ], 200);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Book not found.",
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Error when deleting book.",
            ], 500);
        }
    }
}
