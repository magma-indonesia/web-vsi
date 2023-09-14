<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $contents = 'dashboard.template.body';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.role.index', [
            'contents' => $this->contents,
            'pageTitle' => 'Role',
            'appUrl' => env('APP_URL'),
            'addUrl' => route('dashboard.role.create'),
            'editUrl' => route('dashboard.role.edit', '##ID##'),
            'policyUrl' => route('dashboard.role.policy', '##ID##'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.role.form', [
            'contents' => $this->contents,
            'pageTitle' => 'Role',
            'appUrl' => env('APP_URL'),
            'retrieve' => null,
            'isUpdate' => false
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        if (!$role) {
            abort(404);
        }

        return view('dashboard.role.form', [
            'contents' => $this->contents,
            'pageTitle' => 'Role',
            'appUrl' => env('APP_URL'),
            'retrieve' => $role,
            'isUpdate' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function policy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            abort(404);
        }
        $policy = [];
        foreach (config('pvmbg.policies') as $key => $value) {
            $policy[] = [
                'value' => $key,
                'label' => $value,
            ];
        }

        return view('dashboard.role.form-policy', [
            'contents' => $this->contents,
            'pageTitle' => 'Role Policy',
            'appUrl' => env('APP_URL'),
            'retrieve' => $role,
            'policy' => $policy,
            'isUpdate' => true
        ]);
    }
}
