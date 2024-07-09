<?php

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;


class SettingObserver
{
    /**
     * Handle the Setting "created" event.
     */
    public function creating(Setting $setting): void
    {
        if (request()->hasFile('logo')) {
            $setting->logo = request()->file('logo')->store('setting', 'public');
        }
    }

    /**
     * Handle the Setting "updated" event.
     */
    public function updating(Setting $setting): void
    {
        if (request()->hasFile('logo')) {

            if ($setting->getOriginal('logo')) {
                Storage::disk('public')->delete($setting->getOriginal('logo'));
            }
            $setting->logo = request()->file('logo')->store('setting', 'public');
        }
    }

    /**
     * Handle the Setting "deleted" event.
     */
    public function deleted(Setting $setting): void
    {
        if ($setting->logo) {
            Storage::disk('public')->delete($setting->logo);
        }
    }

    /**
     * Handle the Setting "restored" event.
     */
    public function restored(Setting $setting): void
    {
        //
    }

    /**
     * Handle the Setting "force deleted" event.
     */
    public function forceDeleted(Setting $setting): void
    {
        //
    }
}
