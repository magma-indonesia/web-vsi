<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Segment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer as Writer;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
            'contents' => $this->contents,
            'pageTitle' => 'Pegawai',
            'createUrl' => route('settings.employee.create'),
            'exportExcelUrl' => route('settings.employee.export', ['type' => 'excel']),
            'exportCsvUrl' => route('settings.employee.export', ['type' => 'csv']),
            'users' => $users,
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
            'contents' => $this->contents,
            'pageTitle' => 'Pegawai',
            'saveUrl' => route('settings.employee.store'),
            'segments' => Segment::all(),
            'roles' => Role::all(),
            'input' => array_merge($request->input(), $request->old()),
            'isUpdate' => false
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
            'group' => request('class') == 'e' && request('group') != 'IV' ? '' : request('group'),
            'class' => request('class') == 'e' && request('group') != 'IV' ? '' : request('class'),
        ]);
        $this->validate(
            $request,
            [
                'segment_id' => ['required'],
                'nip' => ['required'],
                'name' => ['required'],
                'position' => ['required'],
                'group_class' => ['required'],
                'password' => ['required'],
            ],
            [
                'segment_id.required' => 'Bagian harus dipilih',
                'nip.required' => 'NIP harus diisi',
                'name.required' => 'Nama harus diisi',
                'position.required' => 'Jabatan harus diisi',
                'group_class.required' => 'Golongan harus dipilih',
                'password.required' => 'Password harus diisi',
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
        $roles = $user->roles()->pluck('role_id');
        $request->merge([
            'segment_id' => $user->id_segment,
            'nip' => $user->nip,
            'name' => $user->name,
            'position' => $user->position,
            'group' => $user->group,
            'class' => $user->class,
            'role_id' => count($roles) > 0 ? $roles[0] : '',
            'is_active' => $user->is_active,
        ]);

        return view('settings.user.form', [
            'contents' => $this->contents,
            'pageTitle' => 'Pegawai',
            'saveUrl' => route('settings.employee.update', $id),
            'segments' => Segment::all(),
            'roles' => Role::all(),
            'input' => array_merge($request->input(), $request->old()),
            'isUpdate' => true
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
            'group' => request('class') == 'e' && request('group') != 'IV' ? '' : request('group'),
            'class' => request('class') == 'e' && request('group') != 'IV' ? '' : request('class'),
        ]);
        $this->validate(
            $request,
            [
                'segment_id' => ['required'],
                'nip' => ['required'],
                'name' => ['required'],
                'position' => ['required'],
                'group_class' => ['required'],
            ],
            [
                'segment_id.required' => 'Bagian harus dipilih',
                'nip.required' => 'NIP harus diisi',
                'name.required' => 'Nama harus diisi',
                'position.required' => 'Jabatan harus diisi',
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

            if (empty($request->role_id)) {
                $user->roles()->detach();
            } else {
                $user->roles()->sync([$request->role_id]);
            }
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

    public function export(Request $request)
    {
        try {
            $data = User::all();
            $type = $request->type ?? 'excel';

            $fileName = 'user-'.date('YmdHis').($type == 'csv' ? '.csv' : '.xlsx');
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set Header
            $sheet->setCellValue('A1', 'id');
            $sheet->setCellValue('B1', 'id_segment');
            $sheet->setCellValue('C1', 'uuid');
            $sheet->setCellValue('D1', 'name');
            $sheet->setCellValue('E1', 'avatar');
            $sheet->setCellValue('F1', 'nip');
            $sheet->setCellValue('G1', 'position');
            $sheet->setCellValue('H1', 'group');
            $sheet->setCellValue('I1', 'class');
            $sheet->setCellValue('J1', 'ktp');
            $sheet->setCellValue('K1', 'phone');
            $sheet->setCellValue('L1', 'email');
            $sheet->setCellValue('M1', 'email_esdm');
            $sheet->setCellValue('N1', 'password');
            $sheet->setCellValue('O1', 'is_active');
            $sheet->setCellValue('P1', 'remember_token');
            $sheet->setCellValue('Q1', 'created_at');
            $sheet->setCellValue('R1', 'updated_at');
            $sheet->setCellValue('S1', 'current_team_id');

            // Set Body
            $rowStart = 2;
            foreach ($data as $item) {
                $sheet->setCellValue('A'.$rowStart, $item->id);
                $sheet->setCellValue('B'.$rowStart, $item->id_segment);
                $sheet->setCellValue('C'.$rowStart, $item->uuid);
                $sheet->setCellValue('D'.$rowStart, $item->name);
                $sheet->setCellValue('E'.$rowStart, $item->avatar);
                $sheet->setCellValueExplicit('F'.$rowStart, $item->nip, DataType::TYPE_STRING);
                $sheet->setCellValue('G'.$rowStart, $item->position);
                $sheet->setCellValue('H'.$rowStart, $item->group);
                $sheet->setCellValue('I'.$rowStart, $item->class);
                $sheet->setCellValue('J'.$rowStart, $item->ktp);
                $sheet->setCellValue('K'.$rowStart, $item->phone);
                $sheet->setCellValue('L'.$rowStart, $item->email);
                $sheet->setCellValue('M'.$rowStart, $item->email_esdm);
                $sheet->setCellValue('N'.$rowStart, $item->password);
                $sheet->setCellValue('O'.$rowStart, $item->is_active);
                $sheet->setCellValue('P'.$rowStart, $item->remember_token);
                $sheet->setCellValue('Q'.$rowStart, $item->created_at);
                $sheet->setCellValue('R'.$rowStart, $item->updated_at);
                $sheet->setCellValue('S'.$rowStart, $item->current_team_id);

                $rowStart++;
            }

            if ($type == 'csv') {
                $writer = new Writer\Csv($spreadsheet);
                $writer->setDelimiter(';');
    
                $response =  new StreamedResponse(
                    function () use ($writer) {
                        $writer->save('php://output');
                    }
                );
                $response->headers->set('Content-Type', 'text/csv');
                $response->headers->set('Content-Disposition', 'attachment;filename="'.$fileName.'"');
                $response->headers->set('Cache-Control','max-age=0');
            } else {
                $writer = new Writer\Xlsx($spreadsheet);
    
                $response =  new StreamedResponse(
                    function () use ($writer) {
                        $writer->save('php://output');
                    }
                );
                $response->headers->set('Content-Type', 'application/vnd.ms-excel');
                $response->headers->set('Content-Disposition', 'attachment;filename="'.$fileName.'"');
                $response->headers->set('Cache-Control','max-age=0');
            }
            return $response;
        } catch (Exception $e) {

        }
    }
}
