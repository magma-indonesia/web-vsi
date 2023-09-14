<?php

namespace App\Http\Controllers\Administration;

use App\Models\Activity;
use App\Models\BudgetPlan;
use App\Models\CostPlanDetail;
use App\Models\IndonesiaCity;
use App\Models\MasterBudgetPlan;
use App\Models\MasterNominative;
use App\Models\Nominative;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinanceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private string $nominativeContentDirective;
    private string $starterNsStatusId;

    public function __construct()
    {
        $this->nominativeContentDirective = 'dashboard.admin.finance.nominative';
        $this->starterNsStatusId = 1;
    }

    public function financeRecap()
    {
        $contents = 'dashboard.template.body';
        return view('dashboard.index', compact('contents'));
    }

    public function masterNominative(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $contents = "$this->nominativeContentDirective.init";
        $nominativeRouteName = 'dashboard.admin.finance.get.nominative';
        $searchActivityRouteName = route('api.search-activity', Auth::user()->id_segment);
        $saveMasterNominativeRouteName = 'dashboard.admin.finance.post.master-nominative';
        return view('dashboard.index',
            compact(
                'contents',
                'nominativeRouteName',
                'searchActivityRouteName',
                'saveMasterNominativeRouteName'
            )
        );
    }

    public function saveMasterNominative(Request $request): JsonResponse
    {
        $mn = MasterNominative::where('code', '=', $request->get('code'))
            ->first();

        if ($mn != null) {
            $mnId = $mn->first()->id;
        } else {
            $mn = new MasterNominative;
            $mn->id_activity = $request->get('id_activity');
            $mn->id_ns = $this->starterNsStatusId;
            $mn->code = $request->get('code');
            $mn->id_user = Auth::id();
            $mn->save();
            $mnId = $mn->id;
        }

        return response()->json(array('id' => $mnId));
    }

    public function nominative(Request $request, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $contents = "$this->nominativeContentDirective.nom";
        $searchCityRouteName = 'api.search-city';
        $searchEmployeeRouteName = 'api.search-employee';
        $saveNominativeRouteName = 'dashboard.admin.finance.post.nominative';
        $saveBudgetPlanRouteName = 'dashboard.admin.finance.post.bp';
        $saveCostPlanDetailRouteName = 'dashboard.admin.finance.post.cpd';
        $mn = MasterNominative::where('id', '=', $id)->select()->first();
        $activity = Activity::where('id', '=', $mn->id_activity)
            ->select(['code', 'name'])
            ->first();
        $activityCode = $activity->code;
        $activityName = $activity->name;
        $mnId = $id;
        $masterBudgetPlanRouteName = 'api.get-mbp';
        return view('dashboard.index',
            compact(
                'contents',
                'searchCityRouteName',
                'searchEmployeeRouteName',
                'activityCode',
                'activityName',
                'saveNominativeRouteName',
                'masterBudgetPlanRouteName',
                'mnId',
                'saveBudgetPlanRouteName',
                'saveCostPlanDetailRouteName'
            )
        );
    }

    public function viewNominative(Request $request, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $contents = "$this->nominativeContentDirective.nom-view";
        $searchCityRouteName = 'api.search-city';
        $searchEmployeeRouteName = 'api.search-employee';
        $saveNominativeRouteName = 'dashboard.admin.finance.post.nominative';
        $saveBudgetPlanRouteName = 'dashboard.admin.finance.post.bp';
        $saveCostPlanDetailRouteName = 'dashboard.admin.finance.post.cpd';
        $mn = MasterNominative::where('id', '=', $id)->select()->first();
        $activity = Activity::where('id', '=', $mn->id_activity)
            ->select(['code', 'name'])
            ->first();
        $activityCode = $activity->code;
        $activityName = $activity->name;
        $mnId = $id;
        $masterBudgetPlanRouteName = 'api.get-mbp';

        // data
        $nominative = Nominative::where('id_mn', '=', $id)->select()->get();
        $bp = BudgetPlan::where('id_mn', '=', $id)->select()->get();
        $cpd = CostPlanDetail::where('id_mn', '=', $id)->select()->first();
        $origin = IndonesiaCity::where('id', '=', $nominative[0]->origin_city)->select()->first()->name;
        $destination = IndonesiaCity::where('id', '=', $nominative[0]->destination_city)->select()->first()->name;
        $startDate = $nominative[0]->start_date;
        $endDate = $nominative[0]->end_date;

        return view('dashboard.index',
            compact(
                'contents',
                'searchCityRouteName',
                'searchEmployeeRouteName',
                'activityCode',
                'activityName',
                'saveNominativeRouteName',
                'masterBudgetPlanRouteName',
                'mnId',
                'saveBudgetPlanRouteName',
                'saveCostPlanDetailRouteName',
                'nominative',
                'bp',
                'cpd',
                'origin',
                'destination',
                'startDate',
                'endDate'
            )
        );
    }

    public function saveNominative(Request $request): JsonResponse
    {
        Nominative::where('id_mn', '=', $request->get('data')['id_mn'])->delete();

        $response = array();
        foreach ($request->get('data')['personnel'] as $k => $data) {
            $n = new Nominative();
            $n->id_mn = $request->get('data')['id_mn'];
            $n->id_employee = $data['id'];
            $n->origin_city = $request->get('data')['origin'];
            $n->destination_city = $request->get('data')['destination'];
            $n->start_date = $request->get('data')['start_date'];
            $n->end_date = $request->get('data')['end_date'];
            $n->oh = $data['oh'];
            $n->lodging = $data['lodging'];
            $n->transport = $data['transport'];
            $n->order = $k;
            $n->desc = "";

            $n->destination = IndonesiaCity::where('id', '=', (string)$n->destination_city)->first()->name;
            $user = User::where('id', '=', $n->id_employee)->first();
            $n->nip = $user->nip;
            $n->name = $user->name;
            $n->group = $user->group;
            $n->save();
            $response[] = $n;
        }
        return response()->json($response);
    }

    public function saveBudgetPlan(Request $request): JsonResponse
    {
        BudgetPlan::where('id_mn', '=', $request->get('idMn'))->delete();

        $response = array();
        foreach ($request->get('bp') as $data) {
            foreach ($data as $v) {
                $bp = new BudgetPlan();
                $bp->id_mbp = $v['idMbp'];
                $bp->id_mn = $request->get('idMn');
                $bp->desc = $v['desc'];
                $bp->qty1 = $v['qty1'];
                $bp->unit1 = str_replace(" x", "", $v['unit1']);
                $bp->qty2 = $v['qty2'] ?? null;
                $bp->unit2 = isset($v['unit2']) ? str_replace(" x", "", $v['unit2']) : null;
                $bp->nominal = $v['nominal'];
                $bp->save();
                $response[] = $bp;
            }
        }
        return response()->json($response);
    }

    public function saveCostPlanDetail(Request $request)
    {
        CostPlanDetail::where('id_mn', '=', $request->get('idMn'))->delete();

        $cpd = new CostPlanDetail();
        $cpd->id_mn = $request->get('idMn');
        $cpd->activity_desc = $request->get('activityDesc');
        $cpd->travel_total = $request->get('travelTotal');
        $cpd->materials_total = $request->get('materialTotal');
        $cpd->wages_total = $request->get('wagesTotal');
        $cpd->rent_total = $request->get('rentTotal');
        $cpd->labs_total = $request->get('labsTotal');
        $cpd->desc = $request->get('desc');
        $cpd->save();
        return response()->json($cpd);
    }

    public function searchCity(Request $request): JsonResponse
    {
        $query = $request->get('search');
        $filterResult = IndonesiaCity::where('name', 'ILIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }

    public function searchEmployee(Request $request): JsonResponse
    {
        $query = $request->get('search');
        $filterResult = User::where(DB::raw('lower(name)'), 'like', '%' . strtolower($query) . '%')
            ->select(['id', 'name', 'nip', 'group', 'class'])
            ->get();
        return response()->json($filterResult);
    }

    public function searchActivity(Request $request, $segment): JsonResponse
    {
        $query = $request->get('search');
        $filterResult = Activity::where(DB::raw('lower(code)'), 'like', '%' . strtolower($query) . '%')
            ->where('id_segment', '=', $segment)
            ->where('active', '=', '1')
            ->select(['id', 'code', 'name'])
            ->get();
        return response()->json($filterResult);
    }

    public function getMasterBudgetPlan(): JsonResponse
    {
        $response = MasterBudgetPlan::all();
        return response()->json($response);
    }

    public function trackSpd(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $contents = "dashboard.admin.finance.spd.body";
        $getDataTableRouteName = 'dashboard.admin.finance.post.get-spd';
        $viewNominativeRouteName = 'dashboard.admin.finance.view.nominative';
        return view('dashboard.index',
            compact(
                'contents',
                'getDataTableRouteName',
                'viewNominativeRouteName'
            )
        );
    }

    public function getDataSpd(): JsonResponse
    {
        $response = MasterNominative::with(['user', 'spdStatus'])->get();
        return response()->json($response);
    }
}
