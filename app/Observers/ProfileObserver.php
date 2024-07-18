<?php

namespace App\Observers;

use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class ProfileObserver
{
    /**
     * Handle the Profile "created" event.
     */
    public function creating(Profile $profile): void
    {
        if (request()->hasFile('image')) {
            $profile->image = request()->file('image')->store('profile', 'public');
        }
    }
    public function created(Profile $profile): void
    {

        Auth::user()->wallet()->create();
    }

    /**
     * Handle the Profile "updated" event.
     */
    public function updating(Profile $profile): void
    {
        if (request()->hasFile('image')) {

            if ($profile->getOriginal('image')) {
                Storage::disk('public')->delete($profile->getOriginal('image'));
            }
            $profile->image = request()->file('image')->store('profile', 'public');
        }
    }

    /**
     * Handle the Profile "deleted" event.
     */
    public function deleted(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "restored" event.
     */
    public function restored(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "force deleted" event.
     */
    public function forceDeleted(Profile $profile): void
    {
        //
    }
}
