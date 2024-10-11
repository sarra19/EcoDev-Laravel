<?php

namespace App\Http\Controllers;
use App\Models\SalesCenter; // Import SalesCenter model
use App\Models\RecycledProduct; // Make sure to import RecycledProduct model too
use Illuminate\Http\Request;

class RecycledProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $salesCenterId)
    {
        // Retrieve the sales center
        $salesCenter = SalesCenter::findOrFail($salesCenterId);
    
        // Start building the query for recycled products
        $query = RecycledProduct::where('sales_center_id', $salesCenterId);
    
        // Search functionality
        if ($request->filled('searchQuery')) {
            $searchQuery = $request->input('searchQuery');
            $query->where(function ($q) use ($searchQuery) {
                $q->where('name', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('description', 'LIKE', "%{$searchQuery}%");
            });
        }
    
        // Sort functionality
        if ($request->filled('sortBy')) {
            $sortBy = $request->input('sortBy');
            // You might want to add validation to ensure that only allowed fields can be sorted
            $query->orderBy($sortBy);
        }
    
        // Paginate the results
        $recycledProducts = $query->paginate(4); // Adjust the number of items per page as needed
    
        // Pass the data to the view
        return view('BackOffice.recycledProduct.index', [
            'salesCenter' => $salesCenter,
            'recycledProducts' => $recycledProducts,
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($salesCenterId)
    {
        $salesCenter = SalesCenter::findOrFail($salesCenterId);
        return view('BackOffice.RecycledProduct.create', compact('salesCenter'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $salesCenterId)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Optional image validation
        ]);
    
        // Create a new recycled product
        $recycledProduct = new RecycledProduct();
        $recycledProduct->name = $request->input('name');
        $recycledProduct->description = $request->input('description');
        $recycledProduct->quantity = $request->input('quantity');
        $recycledProduct->price = $request->input('price');
        $recycledProduct->sales_center_id = $salesCenterId; // Associate with the sales center
    
        // Handle the image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/recycled_products', 'public');
            $recycledProduct->image = $imagePath;
        }
    
        // Save the recycled product to the database
        $recycledProduct->save();
    
        // Redirect back to the recycled products index with a success message
        return redirect()->route('BackOffice.RecycledProduct.index', $salesCenterId)
            ->with('success', 'Recycled product created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($salesCenterId, $recycledProductId)
    {
        // Retrieve the sales center and recycled product
        $salesCenter = SalesCenter::findOrFail($salesCenterId);
        $recycledProduct = RecycledProduct::where('sales_center_id', $salesCenterId)
                                          ->findOrFail($recycledProductId);
    
        // Pass the data to the edit view
        return view('BackOffice.RecycledProduct.edit', [
            'salesCenter' => $salesCenter,
            'recycledProduct' => $recycledProduct,
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $salesCenterId, $recycledProductId)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Retrieve the recycled product
        $recycledProduct = RecycledProduct::where('sales_center_id', $salesCenterId)
                                          ->findOrFail($recycledProductId);
        // Update the product fields
        $recycledProduct->name = $request->input('name');
        $recycledProduct->description = $request->input('description');
        $recycledProduct->quantity = $request->input('quantity');
        $recycledProduct->price = $request->input('price');
    
        // Handle the image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/recycled_products', 'public');
            $recycledProduct->image = $imagePath;
        }
    
        // Save the updated product
        $recycledProduct->save();
    
        // Redirect back to the recycled products index with a success message
        return redirect()->route('BackOffice.RecycledProduct.index', $salesCenterId)
            ->with('success', 'Recycled product updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($salesCenterId, $productId)
    {
        $product = RecycledProduct::where('sales_center_id', $salesCenterId)->findOrFail($productId);
        $product->delete();
    
        return redirect()->route('BackOffice.RecycledProduct.index', $salesCenterId)
                         ->with('success', 'Product deleted successfully.');
    }
    
}
