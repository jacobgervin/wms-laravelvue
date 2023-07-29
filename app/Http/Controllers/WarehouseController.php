<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    // Fetch all warehouse items
    public function index()
    {
        $warehouseItems = Warehouse::all();
        return response()->json(['data' => $warehouseItems]);
    }

    // Show the form to create a new warehouse item
    public function create()
    {
        // Your implementation here (if needed)
    }

    // Store a new warehouse item
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer' => 'required|string|max:255',
            'type' => 'required|string',
            'measure' => 'required|string|min:0',
            'amount' => 'required|integer|min:0',
        ]);

        $warehouseItem = Warehouse::create($validatedData);

        return response()->json(['message' => 'Warehouse item created successfully', 'data' => $warehouseItem]);
    }

    // Show a specific warehouse item
    public function show($id)
    {
        $warehouseItem = Warehouse::find($id);

        if (!$warehouseItem) {
            return response()->json(['error' => 'Warehouse item not found'], 404);
        }

        return response()->json(['data' => $warehouseItem]);
    }

    // Show the form to edit a warehouse item
    public function edit($id)
    {
        // Your implementation here (if needed)
    }

    // Update a warehouse item
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer' => 'required|string|max:255',
            'type' => 'required|string',
            'measure' => 'required|string|min:0',
            'amount' => 'required|integer|min:0',
        ]);

        $warehouseItem = Warehouse::find($id);

        if (!$warehouseItem) {
            return response()->json(['error' => 'Warehouse item not found'], 404);
        }

        $warehouseItem->update($validatedData);

        return response()->json(['message' => 'Warehouse item updated successfully', 'data' => $warehouseItem]);
    }

    // Delete a warehouse item
    public function destroy($id)
    {
        $warehouseItem = Warehouse::find($id);

        if (!$warehouseItem) {
            return response()->json(['error' => 'Warehouse item not found'], 404);
        }

        $warehouseItem->delete();

        return response()->json(['message' => 'Warehouse item deleted successfully']);
    }
}
