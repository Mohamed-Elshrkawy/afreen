<?php

namespace App\Observers;

use App\Models\Review;
use Illuminate\Support\Facades\Storage;



class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function creating(Review $review): void
    {
        if (request()->hasFile('image')) {
            $review->image = request()->file('image')->store('review', 'public');
        }

    }

    /**
     * Handle the Category "updated" event.
     */
    public function updating(Review $review): void
    {
        if (request()->hasFile('image')) {

            if ($review->getOriginal('image')) {
                Storage::disk('public')->delete($review->getOriginal('image'));
            }
            $review->image = request()->file('image')->store('review', 'public');
        }
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Review $review): void
    {
        if ($review->image) {
            Storage::disk('public')->delete($review->image);
        }
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Review $review): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Review $review): void
    {
        //
    }
}
