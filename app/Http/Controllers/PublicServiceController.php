<?php

namespace App\Http\Controllers;

use App\Models\PublicService;
use App\Param;
use Illuminate\Http\Request;

class PublicServiceController extends Controller
{
    private $contents = 'dashboard.template.body';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {
        $category = $category ?? Param::PUBLIC_SERVICE_BUREAUCRATIC_REFORM;
        $pageTitle = 'Reformasi Birokrasi';
        if ($category == Param::PUBLIC_SERVICE_INFORMATION_DISSEMINATION) {
            $pageTitle = 'Diseminasi Informasi';
        }

        return view('dashboard.layanan-publik.index', [
            'contents' => $this->contents,
            'pageTitle' => $pageTitle,
            'category' => $category,
            'appUrl' => env('APP_URL'),
            'addUrl' => route('dashboard.layanan-publik.create', ['category' => $category]),
            'editUrl' => route('dashboard.layanan-publik.edit', ['category' => $category, 'id' => '##ID##']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category)
    {
        $category = $category ?? Param::PUBLIC_SERVICE_BUREAUCRATIC_REFORM;
        $pageTitle = 'Reformasi Birokrasi';
        if ($category == Param::PUBLIC_SERVICE_INFORMATION_DISSEMINATION) {
            $pageTitle = 'Diseminasi Informasi';
        }

        return view('dashboard.layanan-publik.form', [
            'contents' => $this->contents,
            'pageTitle' => $pageTitle,
            'category' => $category,
            'appUrl' => env('APP_URL'),
            'retrieve' => null,
            'isUpdate' => false,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($category, $id)
    {
        $data = PublicService::find($id);
        if (!$data) {
            abort(404);
        }
        $category = $data->category_id;
        $pageTitle = 'Reformasi Birokrasi';
        if ($category == Param::PUBLIC_SERVICE_INFORMATION_DISSEMINATION) {
            $pageTitle = 'Diseminasi Informasi';
        }

        return view('dashboard.layanan-publik.form', [
            'contents' => $this->contents,
            'pageTitle' => $pageTitle,
            'category' => $category,
            'appUrl' => env('APP_URL'),
            'retrieve' => $data,
            'isUpdate' => true,
        ]);
    }
}
