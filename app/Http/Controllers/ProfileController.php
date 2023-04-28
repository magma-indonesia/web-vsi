<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Param;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $contents = 'dashboard.template.body';

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Profile::where('category_id', $id)->first();
        $category = $id;
        $pageTitle = 'Tentang PVMBG';
        if ($category == Param::PROFILE_STRUCTURE) {
            $pageTitle = 'Struktur Organisasi';
        } elseif ($category == Param::PROFILE_HISTORY) {
            $pageTitle = 'Sejarah';
        }

        return view('dashboard.profile.form', [
            'contents' => $this->contents,
            'pageTitle' => $pageTitle,
            'category' => $category,
            'appUrl' => env('APP_URL'),
            'retrieve' => $data,
            'isUpdate' => !empty($data),
        ]);
    }
}
