<?php

namespace App\Http\Controllers;

use App\Models\GroundMovement;
use App\Param;
use Illuminate\Http\Request;

class GroundMovementController extends Controller
{
    private $contents = 'dashboard.template.body';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {
        $category = $category ?? Param::GROUND_MOVEMENT_EVENT;
        $pageTitle = 'Daftar Kejadian';
        if ($category == Param::GROUND_MOVEMENT_EARLY_WARNING) {
            $pageTitle = 'Peringatan Dini';
        } elseif ($category == Param::GROUND_MOVEMENT_EVENT_RECAP) {
            $pageTitle = 'Rekapitulasi Kejadian';
        }

        return view('dashboard.gerakan-tanah.index', [
            'contents' => $this->contents,
            'pageTitle' => $pageTitle,
            'category' => $category,
            'appUrl' => env('APP_URL'),
            'addUrl' => route('dashboard.gerakan-tanah.create', ['category' => $category]),
            'editUrl' => route('dashboard.gerakan-tanah.edit', ['category' => $category, 'id' => '##ID##']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category)
    {
        $category = $category ?? Param::GROUND_MOVEMENT_EVENT;
        $pageTitle = 'Daftar Kejadian';
        if ($category == Param::GROUND_MOVEMENT_EARLY_WARNING) {
            $pageTitle = 'Peringatan Dini';
        } elseif ($category == Param::GROUND_MOVEMENT_EVENT_RECAP) {
            $pageTitle = 'Rekapitulasi Kejadian';
        }

        return view('dashboard.gerakan-tanah.form', [
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
        $data = GroundMovement::find($id);
        if (!$data) {
            abort(404);
        }
        $category = $data->category_id;
        $pageTitle = 'Daftar Kejadian';
        if ($category == Param::GROUND_MOVEMENT_EARLY_WARNING) {
            $pageTitle = 'Peringatan Dini';
        } elseif ($category == Param::GROUND_MOVEMENT_EVENT_RECAP) {
            $pageTitle = 'Rekapitulasi Kejadian';
        }

        return view('dashboard.gerakan-tanah.form', [
            'contents' => $this->contents,
            'pageTitle' => $pageTitle,
            'category' => $category,
            'appUrl' => env('APP_URL'),
            'retrieve' => $data,
            'isUpdate' => true,
        ]);
    }
}
