<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\IndonesiaCity;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class AdministrationController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private string $globalContentDirective;

    public function __construct()
    {
        $this->globalContentDirective = 'dashboard.admin.finance.nominative';
    }

    public function financeRecap()
    {
        $contents = 'dashboard.template.body';
        return view('dashboard.index', compact('contents'));
    }

    public function masterNominative()
    {
        $contents = "$this->globalContentDirective.init";
        $nominativeRouteName = 'dashboard.admin.finance.get.nominative';
        $searchActivityRouteName = route('api.search-activity', Auth::user()->id_segment);
        return view('dashboard.index',
            compact(
                'contents',
                'nominativeRouteName',
                'searchActivityRouteName'
            )
        );
    }

    public function saveMasterNominative(Request $request)
    {
        $contents = "$this->globalContentDirective.nom";
        return view('dashboard.index', compact('contents'));
    }

    public function nominative(Request $request, $id)
    {
        $contents = "$this->globalContentDirective.nom";
        $searchCityRouteName = 'api.search-city';
        $searchEmployeeRouteName = 'api.search-employee';
        $activityCode = Activity::where('id', '=', $id)
            ->select(['code'])
            ->first()->code;
        return view('dashboard.index',
            compact(
                'contents',
                'searchCityRouteName',
                'searchEmployeeRouteName',
                'activityCode'
            )
        );
    }

    public function saveNominative(Request $request)
    {
        $contents = "$this->globalContentDirective.nom";
        return view('dashboard.index', compact('contents'));
    }

    public function searchCity(\Illuminate\Http\Request $request): JsonResponse
    {
        $query = $request->get('search');
        $filterResult = IndonesiaCity::where('name', 'ILIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }

    public function searchEmployee(\Illuminate\Http\Request $request): JsonResponse
    {
        $query = $request->get('search');
        $filterResult = User::where(DB::raw('lower(name)'), 'like', '%' . strtolower($query) . '%')
            ->select(['id', 'name', 'nip', 'group', 'class'])
            ->get();
        return response()->json($filterResult);
    }

    public function searchActivity(\Illuminate\Http\Request $request, $segment): JsonResponse
    {
        $query = $request->get('search');
        $filterResult = Activity::where(DB::raw('lower(code)'), 'like', '%' . strtolower($query) . '%')
            ->where('id_segment', '=', $segment)
            ->where('active', '=', '1')
            ->select(['id', 'code', 'name'])
            ->get();
        return response()->json($filterResult);
    }
}
