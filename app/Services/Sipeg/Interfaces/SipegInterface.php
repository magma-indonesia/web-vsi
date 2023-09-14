<?php

namespace App\Services\Sipeg\Interfaces;

use phpDocumentor\Reflection\Types\Integer;

interface SipegInterface
{
    /**
     * Daftar Jabatan Sipeg
     *
     * @param integer|null $limit
     * @param integer|null $page
     * @return array
     */
    public function daftarJabatan(?int $limit = null, ?int $page = null): array;

    /**
     * Daftar jabatan berdasarkan kode jabatan
     *
     * @param string $kodeJabatan
     * @return array
     */
    public function daftarJabatanByCode(string $kodeJabatan): array;

    /**
     * Mencari jabatan berdasarkan nama
     *
     * @param string $namaJabatan
     * @return array
     */
    public function filterJabatanByName(string $namaJabatan): array;

    /**
     * Mendapatkan seluruh daftar organisasi
     *
     * @param integer|null $limit
     * @param integer|null $page
     * @return array
     */
    public function daftarOrganisasi(?int $limit = null, ?int $page = null): array;

    /**
     * Mendapatkan daftar organisasi berdasarkan kode organisasi
     *
     * @param string $kodeOrganisasi
     * @return array
     */
    public function daftarOrganisasiByCode(string $kodeOrganisasi): array;

    /**
     * Mendapatkan daftar organisasi berdasarkan nama organisasi
     *
     * @param string $namaOrganisasi
     * @return array
     */
    public function filterOrganisasiByName(string $namaOrganisasi): array;

    /**
     * Mendapatkan data pegawai berdasarkan kode organisasi
     *
     * @param string $kodeOrganisasi
     * @return array
     */
    public function employeeByCodeOrganisasi(string $kodeOrganisasi): array;

    /**
     * Mendapatkan data pegawai berdasarkan NIP
     *
     * @param string $nip
     * @return array
     */
    public function employeeByNip(string $nip): array;

    /**
     * Mendapatkan URL untuk foto pegawai
     *
     * @param string $filename
     * @return string
     */
    public function employeePhotoUrl(string $filename): string;

    /**
     * Mendapatkan employee menggunakan nama
     *
     * @param string $nama
     * @return array
     */
    public function filterEmployeeByName(string $nama): array;

    public function employeeAll(int $page, int $limit, array $search): array;
}
