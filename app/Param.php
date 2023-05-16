<?php

namespace App;

class Param
{
    public const GROUND_MOVEMENT_EVENT = '1';
    public const GROUND_MOVEMENT_EARLY_WARNING = '2';
    public const GROUND_MOVEMENT_EVENT_RECAP = '3';
    public const GROUND_MOVEMENT_MAP_ZKGT = '4';

    public const GROUND_MOVEMENT_EVENT_SLUG = 'daftar-kejadian';
    public const GROUND_MOVEMENT_EARLY_WARNING_SLUG = 'peringatan-dini';
    public const GROUND_MOVEMENT_EVENT_RECAP_SLUG = 'rekapitulasi-kejadian';

    public const PROFILE_ABOUT = '1';
    public const PROFILE_STRUCTURE = '2';
    public const PROFILE_HISTORY = '3';

    public const ROLE_SLUG_ADMIN = 'admin';
    public const ROLE_SLUG_MANAGER = 'manager';
    public const ROLE_SLUG_EDITOR = 'editor';
    public const ROLE_SLUG_USER = 'user';

    public const PUBLIC_SERVICE_BUREAUCRATIC_REFORM = '1';
    public const PUBLIC_SERVICE_INFORMATION_DISSEMINATION = '2';

    public const PUBLIC_SERVICE_BUREAUCRATIC_REFORM_SLUG = 'reformasi-birokrasi';
    public const PUBLIC_SERVICE_INFORMATION_DISSEMINATION_SLUG = 'diseminasi-informasi';
}
