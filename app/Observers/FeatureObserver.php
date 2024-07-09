<?php

namespace App\Observers;

use App\Models\Feature;
use Illuminate\Support\Facades\Storage;


class FeatureObserver
{
    /**
     * Handle the Feature "created" event.
     */
    public function creating(Feature $feature): void
    {
        if(request()->hasFile('image')){
            $feature->image=request()->file('image')->store('feature','public');
        }
    }

    /**
     * Handle the Feature "updated" event.
     */
    public function updating(Feature $feature): void
    {
        if (request()->hasFile('image')) {

            if ($feature->getOriginal('image')) {
                Storage::disk('public')->delete($feature->getOriginal('image'));
            }
            $feature->image = request()->file('image')->store('feature', 'public');
        }
    }


    /**
     * Handle the Feature "deleted" event.
     */
    public function deleted(Feature $feature): void
    {
        if ($feature->image) {
            Storage::disk('public')->delete($feature->image);
        }
    }

    /**
     * Handle the Feature "restored" event.
     */
    public function restored(Feature $feature): void
    {
        //
    }

    /**
     * Handle the Feature "force deleted" event.
     */
    public function forceDeleted(Feature $feature): void
    {
        //
    }
}
