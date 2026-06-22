<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Color;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Actions\ProductStoreAction;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $products = Product::with(['brand', 'colors'])
                ->select('products.*')
                ->orderBy('id', 'desc');

            // BRAND FILTER
            if ($request->filled('brand_id')) {
                $products->where('brand_id', $request->brand_id);
            }

            // COLOR FILTER
            if ($request->filled('color_id')) {
                $products->whereHas('colors', function ($q) use ($request) {
                    $q->where('colors.id', $request->color_id);
                });
            }

            return DataTables::of($products)
                ->addIndexColumn()

                ->addColumn('brand', function ($product) {
                    return $product->brand?->name ?? 'No Brand';
                })

                // COLORS
                ->addColumn('colors', function ($product) {
                    return $product->colors->count()
                        ? $product->colors->pluck('name')->join(', ')
                        : 'No Colors';
                })

                // IMAGE
                ->addColumn('image', function ($product) {
                    return $product->image
                        ? '<img src="'.asset('storage/'.$product->image).'" width="80" height="80">'
                        : 'No Image';
                })

                // PRICE (FIXED)
                ->addColumn('price', function ($product) {
                    return '₹' . number_format($product->price, 2);
                })

                // ACTIONS
                ->addColumn('action', function ($product) {

                    return '
                        <a href="'.route('admin.products.show',$product->id).'">View</a> |
                        <a href="'.route('admin.products.edit',$product->id).'">Edit</a> |
                        <form action="'.route('admin.products.destroy',$product->id).'" method="POST" style="display:inline;">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" onclick="return confirm(\'Delete this product?\')">
                                Delete
                            </button>
                        </form>
                    ';
                })

                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('admin.products.index', [
            'brands' => Brand::all(),
            'colors' => Color::all()
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'brands' => Brand::all(),
            'colors' => Color::all()
        ]);
    }

    public function store(ProductStoreRequest $request, ProductStoreAction $action)
    {
        $action->execute(
            $request->validated() + [
                'image' => $request->file('image')
            ]
        );

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product saved successfully!');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', [
            'product' => $product->load(['brand', 'colors'])
        ]);
    }

    public function edit(Product $product)
    {
        $product->load('colors');

        return view('admin.products.edit', [
            'product' => $product,
            'brands'  => Brand::all(),
            'colors'  => Color::all()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'brand_id'    => 'required|exists:brands,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'status'      => 'required',
            'stock'       => 'required|integer|min:0',
            'featured'    => 'nullable|boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'colors'      => 'nullable|array',
            'colors.*'    => 'exists:colors,id',
        ]);

        $product->update([
            'brand_id'    => $request->brand_id,
            'name'        => $request->name,
            'price'       => $request->price,
            'description' => $request->description,
            'status'      => $request->status,
            'stock'       => $request->stock,
            'featured'    => $request->featured,
            'image'       => $request->hasFile('image')
                ? $request->file('image')->store('products', 'public')
                : $product->image,
        ]);

        // COLORS SYNC
        if ($request->filled('colors')) {
            $product->colors()->sync($request->colors);
        } else {
            $product->colors()->detach();
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product Updated Successfully!');
    }

    public function destroy(Product $product)
    {
        $product->colors()->detach();
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product Deleted Successfully!');
    }
    public function newArrivals() {
    $products = Product::latest()->take(20)->get(); // Example: Get latest 20 products
    return view('new-arrivals', compact('products'));
}
}