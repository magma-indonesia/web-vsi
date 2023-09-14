<?php

namespace App\Services\Magma\Interfaces;

use Illuminate\Support\Collection;

interface MagmaVenInterface
{
    /**
     * Daftar letusan gunung api
     *
     * @return Collection
     */
    public function index();

    /**
     * Daftar letusan terkini gunung api
     *
     * @return array
     */
    public function latest();

    /**
     * Menampilkan informasi letusan gunung api
     *
     * @param integer $id
     * @return array
     */
    public function show(int $id);

    /**
     * Melakukan filter data letusan gunung api
     *
     * @param string $code
     * @param string $startDate
     * @param string $endDate
     * @return Collection
     */
    public function filter(string $code, string $startDate, string $endDate);
}
