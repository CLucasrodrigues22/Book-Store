<?php

namespace App\Services;

use App\Http\Requests\StoreStoresRequest;
use App\Http\Requests\UpdateStoresRequest;
use App\Models\Stores;

class StoreService
{
    /**
     * Gets a list of all the stores in the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStores()
    {
        $stores = Stores::all();
        return $stores;
    }

    /**
     * Creates a new store based on the data provided.
     *
     * @param array $data The store data to be created.
     * @return \App\Models\Stores The object of the store created.
     */
    public function createStore(StoreStoresRequest $request)
    {
        // POST ["name", "address", "active"]
        $store = Stores::create($request->all());
        return $store;
    }

    /**
     * Gets a specific store based on the ID provided.
     *
     * @param int $id The ID of the store to be obtained.
     * @return \App\Models\Stores|null The object of the store or null if not found.
     */
    public function getStoreById($id)
    {
        // GET by {id}
        $store = Stores::find($id);
        return $store;
    }

    /**
     * Updates the data of an existing store based on the ID provided.
     *
     * @param int $id The ID of the store to be updated.
     * @param array $data The store data to be updated.
     * @return \App\Models\Stores The subject of the store updated.
     */
    public function updateStore(UpdateStoresRequest $request, $storeId)
    {
        // PUT ["name", "address", "active"] by id
        $store = Stores::find($storeId);
        if ($store) {
            $store->update($request->all());
            return $store;
        } else {
            return $store;
        }
    }

    /**
     * Delete a specific store based on the ID provided.
     *
     * @param int $id The ID of the store to be deleted.
     * @return \App\Models\Stores The object of the store or null if not found.
     */
    public function deleteStore($storeId)
    {
        // DELETE by {id}
        $store = Stores::find($storeId);
        if ($store) {
            $store->delete();
            return $store;
        } else {
            return $store;
        }
    }
}
