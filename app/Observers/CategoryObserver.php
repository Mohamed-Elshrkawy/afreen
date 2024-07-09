<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;



class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function creating(Category $category): void
    {
        if (request()->hasFile('image')) {
            $category->image = request()->file('image')->store('category', 'public');
        }

    }

    /**
     * Handle the Category "updated" event.
     */
    public function updating(Category $category): void
    {
        if (request()->hasFile('image')) {

            if ($category->getOriginal('image')) {
                Storage::disk('public')->delete($category->getOriginal('image'));
            }
            $category->image = request()->file('image')->store('category', 'public');
        }
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
