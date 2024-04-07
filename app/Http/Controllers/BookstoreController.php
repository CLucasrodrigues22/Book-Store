<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookstoreRequest;
use App\Services\BookstoreService;
use Illuminate\Http\Request;

/**
 * Class responsible for store and book relationship management.
 */
class BookstoreController extends Controller
{
    protected $bookstoreService;

    public function __construct(BookstoreService $bookstoreService)
    {
        $this->bookstoreService = $bookstoreService;
    }

    /**
     * Displays a list of all relationships between stores and books.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $bookstoreService = $this->bookstoreService->getAllBookStoreRelationships();
            return response()->json([
                "status" => true,
                "data" => $bookstoreService,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
            ], 500);
        }
    }

    /**
     * Creates a new relationship between book and store based on the data provided.
     *
     * @param \App\Http\Requests\StoreBookstoreRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBookstoreRequest $request)
    {
        $bookstoreService = $this->bookstoreService->createBookStore($request);
        return response()->json([
            "status" => true,
            "data" => $bookstoreService,
        ], 201);
    }
}
