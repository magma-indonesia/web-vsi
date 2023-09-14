<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GenerateUUID
{

    /**
     * Generate UUID
     *
     * @return void
     */
    public static function bootGenerateUUID(): void
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

}
