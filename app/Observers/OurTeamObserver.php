<?php

namespace App\Observers;

use App\Models\OurTeam;
use Illuminate\Support\Facades\Storage;

class OurTeamObserver
{
    /**
     * Handle the OurTeam "created" event.
     */
    public function creating(OurTeam $ourTeam): void
    {
        if (request()->hasFile('image')) {
            $ourTeam->image = request()->file('image')->store('OurTeam', 'public');
        }
    }

    /**
     * Handle the OurTeam "updated" event.
     */
    public function updating(OurTeam $ourTeam): void
    {
        if (request()->hasFile('image')) {

            if ($ourTeam->getOriginal('image')) {
                Storage::disk('public')->delete($ourTeam->getOriginal('image'));
            }
            $ourTeam->image = request()->file('image')->store('OurTeam', 'public');
        }
    }

    /**
     * Handle the OurTeam "deleted" event.
     */
    public function deleted(OurTeam $ourTeam): void
    {
        if ($ourTeam->image) {
            Storage::disk('public')->delete($ourTeam->image);
        }
    }

    /**
     * Handle the OurTeam "restored" event.
     */
    public function restored(OurTeam $ourTeam): void
    {
        //
    }

    /**
     * Handle the OurTeam "force deleted" event.
     */
    public function forceDeleted(OurTeam $ourTeam): void
    {
        //
    }
}
