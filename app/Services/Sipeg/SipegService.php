<?php

namespace App\Services\Sipeg;

use App\Services\Sipeg\Interfaces\SipegInterface;
use Illuminate\Support\Facades\Http;

class SipegService implements SipegInterface
{
    private string $contextPath = '/sipeg';

    /**
     * Daftar Jabatan Sipeg
     *
     * @param integer|null $limit
     * @param integer|null $page
     * @return array
     */
    public function daftarJabatan(?int $limit = null, ?int $page = null): array
    {
        return ['daftar_jabatan'];
    }

    /**
     * Daftar jabatan berdasarkan kode jabatan
     *
     * @param string $kodeJabatan
     * @return array
     */
    public function daftarJabatanByCode(string $kodeJabatan): array
    {
        return [];
    }

    /**
     * Mencari jabatan berdasarkan nama
     *
     * @param string $namaJabatan
     * @return array
     */
    public function filterJabatanByName(string $namaJabatan): array
    {
        return [];
    }

    /**
     * Mendapatkan seluruh daftar organisasi
     *
     * @param integer|null $limit
     * @param integer|null $page
     * @return array
     */
    public function daftarOrganisasi(?int $limit = null, ?int $page = null): array
    {
        return [];
    }

    /**
     * Mendapatkan daftar organisasi berdasarkan kode organisasi
     *
     * @param string $kodeOrganisasi
     * @return array
     */
    public function daftarOrganisasiByCode(string $kodeOrganisasi): array
    {
        return [];
    }

    /**
     * Mendapatkan daftar organisasi berdasarkan nama organisasi
     *
     * @param string $namaOrganisasi
     * @return array
     */
    public function filterOrganisasiByName(string $namaOrganisasi): array
    {
        return [];
    }

    /**
     * Mendapatkan data pegawai berdasarkan kode organisasi
     *
     * @param string $kodeOrganisasi
     * @return array
     */
    public function employeeByCodeOrganisasi(string $kodeOrganisasi): array
    {
        return [];
    }

    /**
     * Mendapatkan data pegawai berdasarkan NIP
     *
     * @param string $nip
     * @return array
     */
    public function employeeByNip(string $nip): array
    {
        return [];
    }

    /**
     * Mendapatkan URL untuk foto pegawai
     *
     * @param string $filename
     * @return string
     */
    public function employeePhotoUrl(string $filename): string
    {
        return '';
    }

    /**
     * Mendapatkan employee menggunakan nama
     *
     * @param string $nama
     * @return array
     */
    public function filterEmployeeByName(string $nama): array
    {
        return [];
    }

    public function employeeAll(int $page, int $limit, array $search): array
    {
        $defaultQueryParam = array(
            'kode_org' => config('sipeg.org_code'),
            'page' => $page,
            'limit' => $limit
        );

        $q = array_merge($defaultQueryParam, $search);

        $response = Http::withHeaders(config('sipeg.headers'))
            ->get(config('sipeg.url') . $this->contextPath . '/employee-all', $q);

        return $response->json();
    }
}
