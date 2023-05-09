<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VolcanoActivity;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VolcanoActivityController extends Controller
{
    public function index(Request $request)
    {
        $contents = 'dashboard.template.body'; 
       
        return view("dashboard.gunung-api.tingkat-aktivitas.index", compact("contents"));    
    }

    public function get(Request $request)
    {
        try {
            $name = $request->query('name');
            $data = VolcanoActivity::when($name, function ($query) use ($name) {
                return $query->where('title', 'like', '%' . $name . '%');
            })->orderBy("created_at", "desc")
            ->paginate($request->pageSize);

            return response()->json([
                'message' => '',
                'serve' => $data,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }

    public function add(Request $request)
    {
        $contents = 'dashboard.template.body'; 
        return view("dashboard.gunung-api.tingkat-aktivitas.add", compact("contents"));
    }

    public function edit(Request $request)
    {
        $contents = 'dashboard.template.body'; 
        $id = $request->id;

        $retrieve = VolcanoActivity::where("id", $id)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("dashboard.gunung-api.tingkat-aktivitas.edit", compact("contents", "retrieve"));    
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
           
            if ($validator->fails()) {
                DB::commit();
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            $n = new VolcanoActivity();
            $n->content = $request->desc;
            $n->thumbnail = $request->thumbnail;
            $n->created_at = $request->created_at;
            $n->created_by = Auth::user()->name;

            $title = VolcanoActivity::where('route', strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title))))
                        ->get();
            if (count($title) > 0) {
                $n->title = $request->title;
                $n->route = strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title)))."-".(count($title)+1);
            } else {
                $n->title = $request->title;
                $n->route = strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title)));
            }

            $n->save();

            DB::commit();
            return response()->json([
                'message' => 'Data baru berhasil ditambahkan.',
                'serve' => [],
            ], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }

    public function retrieve(Request $request)
    {
        try {
            $data = VolcanoActivity::where("id", $request->id)->first();
            if (!$data) {
                return response()->json([
                    'message' => 'Data tidak valid.',
                    'serve' => []
                ], 400);
            }

            return response()->json([
                'message' => '',
                'serve' => $data,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
           
            if ($validator->fails()) {
                DB::commit();
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            $n = VolcanoActivity::where('id', $request->id)->first();
            if (!$n) {
                DB::commit();
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }

            
            $n->content = $request->desc;
            $n->thumbnail = $request->thumbnail;
            $n->created_at = $request->created_at;
            if ($n->title !== $request->title) {
                $title = VolcanoActivity::where('route', strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title))))
                            ->get();
                if (count($title) > 0) {
                    $n->title = $request->title;
                    $n->route = strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title)))."-".(count($title)+1);
                } else {
                    $n->title = $request->title;
                    $n->route = strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title)));
                }
            }
            $n->save();

            DB::commit();
            return response()->json([
                'message' => 'Data berhasil diubah.',
                'serve' => $n,
            ], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $vb = VolcanoActivity::where('id', $request->id)->first();
            if (!$vb) {
                DB::commit();
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }

            $vb->delete();
            DB::commit();
            return response()->json([
                'message' => 'Data berhasil dihapus.',
                'serve' => [],
            ], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }
}
