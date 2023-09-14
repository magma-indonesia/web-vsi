<?php

namespace App\Http\Controllers\Administration;

use App\Services\Sipeg\SipegService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use ReflectionClass;

class AdministrationController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private string $contentDirective;
    private string $routeDirective;

    public function __construct()
    {
        $this->contentDirective = 'dashboard.admin.employee';
        $this->routeDirective = 'dashboard.admin.employee';
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $contents = "$this->contentDirective.intra";
        $tableRouteName = "$this->routeDirective.get";
        return view('dashboard.index',
            compact(
                'contents',
                'tableRouteName'
            )
        );
    }

    public function indexSipeg(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $contents = "$this->contentDirective.sipeg";
        $tableRouteName = "$this->routeDirective.get-sipeg";

        return view('dashboard.index',
            compact(
                'contents',
                'tableRouteName'
            )
        );
    }

    public function getEmployeeSipeg(Request $request): \Illuminate\Http\JsonResponse
    {
        $sipeg = new SipegService();
        $page = $request['start'] == 0 ? 1 : ($request['start'] / $request['length']) + 1;

        $search = array();
        if ($request['search']['value'] != null) {
            try {
                new ReflectionClass('ReflectionClass' . ((int)$request['search']['value'] . "" !== $request['search']['value']));
                $search = array(
                    'nip' => $request['search']['value']
                );
            } catch (\Exception $e) {
                $search = array('nama' => $request['search']['value']);
            }
        }

        $data = $sipeg->employeeAll($page, $request['length'], $search);
        $prepared = array();

        foreach ($data['data'] as $v) {
            $prepared[] = array(
                'eid' => $v['employee_id'],
                'pid' => $v['person_id'],
                'name' => $v['nama_full'],
                'nip' => $v['nip'],
                'group' => $v['golongan'],
                'position' => $v['jabatan'],
                'segment' => $v['eselon'] == 'ES II' ? $v['es_2'] : $v['es_3'] . " - " . $v['es_4'],
                'email' => $v['email'],
                'json' => $v
            );
        }

        $dtObject = array(
            'draw' => (int)$request['draw'],
            // can't get total data in a filtered query since the api returned only the number of total filtered,
            // not total of all record, it's the api fault, not us
            'recordsTotal' => (int)$data['meta']['page']['total'],
            'recordsFiltered' => (int)$data['meta']['page']['total'],
            'data' => $prepared
        );
        return response()->json($dtObject);
    }

}
