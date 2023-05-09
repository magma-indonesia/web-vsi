<?php

namespace App\Services;

use App\Http\Controllers\Landing\LandingController;

class ActivityLevelService
{
    public function get()
    {
        $landing = new LandingController();
        return $landing->getTingkatAktivitas();
    }
}