<?php

namespace App\Observers;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;


class SliderObserver
{
    /**
     * Handle the Slider "created" event.
     */
    public function creating(Slider $slider): void
    {
        $request=request();
        if ($request->hasFile('image')) {
            $slider->image = request()->file('image')->store('slider', 'public');
        }
    }

    /**
     * Handle the Slider "updated" event.
     */
    public function updating(Slider $slider): void
    {
        if (request()->hasFile('image')) {

            if ($slider->getOriginal('image')) {
                Storage::disk('public')->delete($slider->getOriginal('image'));
            }
            $slider->image = request()->file('image')->store('slider', 'public');
        }
    }

    /**
     * Handle the Slider "deleted" event.
     */
    public function deleted(Slider $slider): void
    {
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
    }

    /**
     * Handle the Slider "restored" event.
     */
    public function restored(Slider $slider): void
    {
        //
    }

    /**
     * Handle the Slider "force deleted" event.
     */
    public function forceDeleted(Slider $slider): void
    {
        //
    }
}
