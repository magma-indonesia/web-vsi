<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Segment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
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
    public function index()
    {
        return view('dashboard.user.index', [
            'contents' => $this->contents,
            'pageTitle' => 'Pegawai',
            'appUrl' => env('APP_URL'),
            'addUrl' => route('dashboard.pegawai.create'),
            'editUrl' => route('dashboard.pegawai.edit', '##ID##'),
            'exportExcelUrl' => route('dashboard.pegawai.export', ['type' => 'excel']),
            'exportCsvUrl' => route('dashboard.pegawai.export', ['type' => 'csv']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groupClasses = [
            [
                'id' => 'I/a',
                'name' => 'I/a',
            ],
            [
                'id' => 'I/b',
                'name' => 'I/b',
            ],
            [
                'id' => 'I/c',
                'name' => 'I/c',
            ],
            [
                'id' => 'I/d',
                'name' => 'I/d',
            ],
            [
                'id' => 'II/a',
                'name' => 'II/a',
            ],
            [
                'id' => 'II/b',
                'name' => 'II/b',
            ],
            [
                'id' => 'II/c',
                'name' => 'II/c',
            ],
            [
                'id' => 'II/d',
                'name' => 'II/d',
            ],
            [
                'id' => 'III/a',
                'name' => 'III/a',
            ],
            [
                'id' => 'III/b',
                'name' => 'III/b',
            ],
            [
                'id' => 'III/c',
                'name' => 'III/c',
            ],
            [
                'id' => 'III/d',
                'name' => 'III/d',
            ],
            [
                'id' => 'IV/a',
                'name' => 'IV/a',
            ],
            [
                'id' => 'IV/b',
                'name' => 'IV/b',
            ],
            [
                'id' => 'IV/c',
                'name' => 'IV/c',
            ],
            [
                'id' => 'IV/d',
                'name' => 'IV/d',
            ],
            [
                'id' => 'IV/e',
                'name' => 'IV/e',
            ],
        ];

        return view('dashboard.user.form', [
            'contents' => $this->contents,
            'pageTitle' => 'Pegawai',
            'segments' => Segment::all(),
            'roles' => Role::all(),
            'groupClasses' => $groupClasses,
            'appUrl' => env('APP_URL'),
            'retrieve' => null,
            'isUpdate' => false
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        $groupClasses = [
            [
                'id' => 'I/a',
                'name' => 'I/a',
            ],
            [
                'id' => 'I/b',
                'name' => 'I/b',
            ],
            [
                'id' => 'I/c',
                'name' => 'I/c',
            ],
            [
                'id' => 'I/d',
                'name' => 'I/d',
            ],
            [
                'id' => 'II/a',
                'name' => 'II/a',
            ],
            [
                'id' => 'II/b',
                'name' => 'II/b',
            ],
            [
                'id' => 'II/c',
                'name' => 'II/c',
            ],
            [
                'id' => 'II/d',
                'name' => 'II/d',
            ],
            [
                'id' => 'III/a',
                'name' => 'III/a',
            ],
            [
                'id' => 'III/b',
                'name' => 'III/b',
            ],
            [
                'id' => 'III/c',
                'name' => 'III/c',
            ],
            [
                'id' => 'III/d',
                'name' => 'III/d',
            ],
            [
                'id' => 'IV/a',
                'name' => 'IV/a',
            ],
            [
                'id' => 'IV/b',
                'name' => 'IV/b',
            ],
            [
                'id' => 'IV/c',
                'name' => 'IV/c',
            ],
            [
                'id' => 'IV/d',
                'name' => 'IV/d',
            ],
            [
                'id' => 'IV/e',
                'name' => 'IV/e',
            ],
        ];

        return view('dashboard.user.form', [
            'contents' => $this->contents,
            'pageTitle' => 'Pegawai',
            'segments' => Segment::all(),
            'roles' => Role::all(),
            'groupClasses' => $groupClasses,
            'appUrl' => env('APP_URL'),
            'retrieve' => $user,
            'isUpdate' => true
        ]);
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

                $response = new StreamedResponse(
                    function () use ($writer) {
                        $writer->save('php://output');
                    }
                );
                $response->headers->set('Content-Type', 'text/csv');
                $response->headers->set('Content-Disposition', 'attachment;filename="'.$fileName.'"');
                $response->headers->set('Cache-Control', 'max-age=0');
            } else {
                $writer = new Writer\Xlsx($spreadsheet);

                $response = new StreamedResponse(
                    function () use ($writer) {
                        $writer->save('php://output');
                    }
                );
                $response->headers->set('Content-Type', 'application/vnd.ms-excel');
                $response->headers->set('Content-Disposition', 'attachment;filename="'.$fileName.'"');
                $response->headers->set('Cache-Control', 'max-age=0');
            }

            return $response;
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }

    public function editPassword($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }

        return view('dashboard.user.form-change-password', [
            'contents' => $this->contents,
            'pageTitle' => 'Change Password',
            'appUrl' => env('APP_URL'),
            'retrieve' => $user,
        ]);
    }
}
