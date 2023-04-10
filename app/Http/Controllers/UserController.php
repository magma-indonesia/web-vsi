<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    private $contents = 'dashboard.template.body';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query
                    ->where('name', 'like', '%'.$search.'%')
                    ->orWhere('nip', 'like', '%'.$search.'%');
            })
            ->orderBy('nip', 'asc')
            ->paginate(10);

        return view('settings.user.index', [
            'contents'  => $this->contents,
            'pageTitle' => 'Pegawai',
            'users'     => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('settings.user.form', [
            'contents'  => $this->contents,
            'pageTitle' => 'Pegawai',
            'saveUrl'   => route('settings.employee.store'),
            'segments'  => Segment::all(),
            'input'     => array_merge($request->input(), $request->old()),
            'isUpdate'  => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'group_class' => request('class') == 'e' && request('group') != 'IV' ? '' : request('group').request('class'),
            'group'       => request('class') == 'e' && request('group') != 'IV' ? '' : request('group'),
            'class'       => request('class') == 'e' && request('group') != 'IV' ? '' : request('class'),
        ]);
        $this->validate($request,
            [
                'segment_id'  => ['required'],
                'nip'         => ['required'],
                'name'        => ['required'],
                'position'    => ['required'],
                'group_class' => ['required'],
                'password'    => ['required'],
            ],
            [
                'segment_id.required'  => 'Bagian harus dipilih',
                'nip.required'         => 'NIP harus diisi',
                'name.required'        => 'Nama harus diisi',
                'position.required'    => 'Jabatan harus diisi',
                'group_class.required' => 'Golongan harus dipilih',
                'password.required'    => 'Password harus diisi',
            ]
        );
        try {
            $user = new User();
            $user->id_segment = $request->segment_id;
            $user->nip = $request->nip;
            $user->name = $request->name;
            $user->position = $request->position;
            $user->group = $request->group;
            $user->class = $request->class;
            $user->password = $request->password;
            $user->is_active = 1;
            $user->save();
        } catch (Exception $e) {
            return $this->errorRedirectBack($e);
        }

        return $this->successRedirect('settings.employee.index', 'Data Pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $request->merge([
            'segment_id' => $user->id_segment,
            'nip'        => $user->nip,
            'name'       => $user->name,
            'position'   => $user->position,
            'group'      => $user->group,
            'class'      => $user->class,
            'is_active'  => $user->is_active,
        ]);

        return view('settings.user.form', [
            'contents'  => $this->contents,
            'pageTitle' => 'Pegawai',
            'saveUrl'   => route('settings.employee.update', $id),
            'segments'  => Segment::all(),
            'input'     => array_merge($request->input(), $request->old()),
            'isUpdate'  => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->merge([
            'group_class' => request('class') == 'e' && request('group') != 'IV' ? '' : request('group').request('class'),
            'group'       => request('class') == 'e' && request('group') != 'IV' ? '' : request('group'),
            'class'       => request('class') == 'e' && request('group') != 'IV' ? '' : request('class'),
        ]);
        $this->validate($request,
            [
                'segment_id'  => ['required'],
                'nip'         => ['required'],
                'name'        => ['required'],
                'position'    => ['required'],
                'group_class' => ['required'],
            ],
            [
                'segment_id.required'  => 'Bagian harus dipilih',
                'nip.required'         => 'NIP harus diisi',
                'name.required'        => 'Nama harus diisi',
                'position.required'    => 'Jabatan harus diisi',
                'group_class.required' => 'Golongan harus dipilih',
            ]
        );
        try {
            $user = User::find($id);
            $user->id_segment = $request->segment_id;
            $user->nip = $request->nip;
            $user->name = $request->name;
            $user->position = $request->position;
            $user->group = $request->group;
            $user->class = $request->class;
            if ($request->password) {
                $user->password = $request->password;
            }
            $user->is_active = $request->is_active;
            $user->save();
        } catch (Exception $e) {
            return $this->errorRedirectBack($e);
        }

        return $this->successRedirect('settings.employee.index', 'Data Pegawai berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
        } catch (Exception $e) {
            return $this->errorRedirectBack($e);
        }

        return $this->successRedirect('settings.employee.index', 'Data Pegawai berhasil dihapus.');
    }
}
