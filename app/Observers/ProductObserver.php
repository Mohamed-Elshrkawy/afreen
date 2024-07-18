<?php

namespace App\Observers;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\Storage;


class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {

        $request = request();

        $colors =$request->color;
        if ($colors){
            $color =[];
            foreach ($colors as $color){
                $color_id=Color::create([
                    'color'=>$color,
                ]);
                $product->colors()->attach($color_id->id);
            }
        }
        $images = $request->images;
        if ($images) {

            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images');
                $imagespath[] = $path;
            }
            $imagespath=[];
            foreach ($imagespath as $imagepath) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'color_id'=>$color->id,
                    'image' => $imagepath,
                ]);
            }
        }
        $sizes = $request->size;
        if ($sizes) {
            $size=[];
            foreach ($sizes as $size) {
                $size_id=Size::create([
                    'size' => $size,
                ]);
                $product->sizes()->attach($size_id->id);

            }
        }


    }

    /**
     * Handle the Product "updated" event.
     */

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
