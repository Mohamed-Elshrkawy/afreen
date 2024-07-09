<?php

namespace App\Observers;

use App\Models\About;
use Illuminate\Support\Facades\Storage;

class AboutObserver
{
    /**
     * Handle the About "created" event.
     */
    public function creating(About $about): void
    {
        if (request()->hasFile('l_image')){
            $about->l_image=request()->file('l_image')->store('about','public');
        }
        if (request()->hasFile('s_image')){
            $about->s_image=request()->file('s_image')->store('about','public');
        }
    }

    /**
     * Handle the About "updated" event.
     */
    public function updating(About $about): void
    {
        if (request()->hasFile('l_image')) {

            if ($about->getOriginal('l_image')) {
                Storage::disk('public')->delete($about->getOriginal('l_image'));
            }
            $about->l_image = request()->file('l_image')->store('about', 'public');
        }
        if (request()->hasFile('s_image')) {

            if ($about->getOriginal('s_image')) {
                Storage::disk('public')->delete($about->getOriginal('s_image'));
            }
            $about->s_image = request()->file('s_image')->store('about', 'public');
        }
    }

    /**
     * Handle the About "deleted" event.
     */
    public function deleted(About $about): void
    {
        //
    }

    /**
     * Handle the About "restored" event.
     */
    public function restored(About $about): void
    {
        if ($about->l_image) {
            Storage::disk('public')->delete($about->l_image);
        }
        if ($about->s_image) {
            Storage::disk('public')->delete($about->s_image);
        }
    }

    /**
     * Handle the About "force deleted" event.
     */
    public function forceDeleted(About $about): void
    {
        //
    }
}
