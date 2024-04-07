<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoresRequest;
use App\Http\Requests\UpdateStoresRequest;
use App\Services\StoreService;
use Illuminate\Http\Request;
use Exception;

/**
 * Class responsible for managing stores.
 */
class StoresController extends Controller
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    /**
     * Returns a list of all stores.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $stores = $this->storeService->getAllStores();
            return response()->json([
                "status" => true,
                "data" => $stores,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Error when searching the store list.",
            ], 500);
        }
    }

    /**
     * Creates a new store based on the data provided.
     *
     * @param \App\Http\Requests\StoreStoresRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreStoresRequest $request)
    {
        $store = $this->storeService->createStore($request);
        return response()->json([
            "status" => true,
            "data" => $store,
        ], 201);
    }

    /**
     * Displays the details of a specific store.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $store = $this->storeService->getStoreById($id);
            if ($store === null) {
                return response()->json([
                    "status" => false,
                    "message" => "Store not found.",
                ], 404);
            } else {
                return response()->json([
                    "status" => true,
                    "data" => $store,
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
     * Updates the data of an existing store based on the ID provided.
     *
     * @param  \App\Http\Requests\UpdateStoresRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStoresRequest $request, $id)
    {
        try {
            $store = $this->storeService->updateStore($request, $id);
            if ($store === null) {
                return response()->json([
                    "status" => false,
                    "message" => "Store not found.",
                ], 404);
            } else {
                return response()->json([
                    "status" => true,
                    "data" => $store,
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
     * Delete a specific store based on the ID provided.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $store = $this->storeService->deleteStore($id);

            if ($store) {
                return response()->json([
                    "status" => true,
                    "message" => "Successfully deleted store.",
                ], 200);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Store not found.",
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Error when deleting store.",
            ], 500);
        }
    }
}
