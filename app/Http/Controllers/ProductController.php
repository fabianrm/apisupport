<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$products = Product::all();
        $products = Product::with(['category', 'brand', 'sunatUnit'])->get();
        return new ProductCollection($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->except('image'); // Excluye la imagen del resto de los datos

        Log::info('Creando');
        Log::info($validatedData);

        $product = Product::create($validatedData);

        // Verifica si se ha subido un archivo de imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $product->id . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images/products', $imageName, 'public');
            $product->update(['image' => $imagePath]); // Actualiza la ruta de la imagen en la BD
        }else{
            $product->update(['image' => 'images/products/no-image.jpg']);
        }

        $product->load(['brand', 'sunatUnit', 'category']);
        return new ProductResource($product);
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'sunatUnit']); // Carga las relaciones necesarias
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateProductRequest $request, Product $product)
    // {
    //     $validatedData = $request->except('image'); // Excluye la imagen del resto de los datos
    //     // Actualiza los datos del producto
    //     $product->update($validatedData);
    //     // Elimina la imagen anterior si existe
    //     if (
    //         $product->image &&
    //         $product->image !== 'images/products/no-image.jpg' &&
    //         Storage::exists('public/' . $product->image)
    //     ) {
    //         Storage::delete('public/' . $product->image);
    //     }
    //     // Verifica si se ha subido un archivo de imagen
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         // Genera un nuevo nombre para la imagen
    //         $imageName = $product->id . '.' . $image->getClientOriginalExtension();
    //         // Guarda la imagen en el directorio público
    //         $imagePath = $image->storeAs('images/products', $imageName, 'public');
    //         // Actualiza la ruta de la imagen en la base de datos
    //         $product->update(['image' => $imagePath]);
    //     } else {
    //         $product->update(['image' => 'images/products/no-image.jpg']);
    //         Log::info('No se detectó ningún archivo de imagen.');
    //     }
    //     // Carga relaciones (si es necesario)
    //     $product->load(['brand', 'sunatUnit', 'category']);
    //     return new ProductResource($product);
    // }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->except('image');
        $product->update($validatedData);

        // Verifica si se ha subido un archivo de imagen
        if ($request->hasFile('image')) {
            // Elimina la imagen anterior solo si no es "no-image.jpg"
            if (
                $product->image &&
                $product->image !== 'images/products/no-image.jpg' &&
                Storage::exists('public/' . $product->image)
            ) {
                Storage::delete('public/' . $product->image);
            }

            $image = $request->file('image');
            $imageName = $product->id . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images/products', $imageName, 'public');
            $product->update(['image' => $imagePath]);
        }

        $product->load(['brand', 'sunatUnit', 'category']);
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
