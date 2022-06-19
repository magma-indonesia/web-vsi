<?php

namespace App\Services\Magma\Interfaces;

interface MagmaVenInterface
{
    public function index();
    public function latest();
    public function show(int $id);
    public function filter(string $code, string $startDate, string $endDate);
}
