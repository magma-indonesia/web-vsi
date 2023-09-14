<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VolcanoBase;
use App\Models\VolcanoBaseFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VolcanoBaseController extends Controller
{
    public function index(Request $request)
    {
        $contents = 'dashboard.template.body'; 
       
        return view("dashboard.gunung-api.data-dasar.index", compact("contents"));    
    }

    public function get(Request $request)
    {
        try {
            $isPublished = $request->query('is_published');
            $name = $request->query('name');
            $data = VolcanoBase::when($name, function ($query) use ($name) {
                return $query->where('title', 'like', '%' . $name . '%');
            })->when($isPublished, function ($query) {
                return $query->where('status', 1);
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
        return view("dashboard.gunung-api.data-dasar.add", compact("contents"));
    }

    public function edit(Request $request)
    {
        $contents = 'dashboard.template.body'; 
        $id = $request->id;

        $retrieve = VolcanoBase::where("id", $id)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("dashboard.gunung-api.data-dasar.edit", compact("contents", "retrieve"));    
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

            $n = new VolcanoBase();
            $n->intro = $request->intro;
            $n->history = $request->history;
            $n->geology = $request->geology;
            $n->geophysic = $request->geophysic;
            $n->geochemistry = $request->geochemistry;
            $n->disaster_area = $request->disaster_area;
            $n->reference = $request->reference;
            $n->thumbnail = $request->thumbnail;
            $n->created_at = $request->created_at;
            $n->status = $request->status;
            $n->created_by = Auth::user()->name;

            $title = VolcanoBase::where('route', strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title))))
                        ->get();
            if (count($title) > 0) {
                $n->title = $request->title;
                $n->route = strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title)))."-".(count($title)+1);
            } else {
                $n->title = $request->title;
                $n->route = strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title)));
            }

            $n->save();

            foreach ($request->news_files as $file) {
                $nf = new VolcanoBaseFile();
                $nf->volcano_base_id = $n->id;
                $nf->file_id = $file;
                $nf->save();
            }

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
            $data = VolcanoBase::where("id", $request->id)->first();
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

            $n = VolcanoBase::where('id', $request->id)->first();
            if (!$n) {
                DB::commit();
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }

            
            $n->intro = $request->intro;
            $n->history = $request->history;
            $n->geology = $request->geology;
            $n->geophysic = $request->geophysic;
            $n->geochemistry = $request->geochemistry;
            $n->disaster_area = $request->disaster_area;
            $n->reference = $request->reference;
            $n->thumbnail = $request->thumbnail;
            $n->created_at = $request->created_at;
            if ($n->title !== $request->title) {
                $title = VolcanoBase::where('route', strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title))))
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

            $vf = VolcanoBaseFile::where("volcano_base_id", $n->id)->get();
            if (count($vf) > 0) {
                VolcanoBaseFile::where("volcano_base_id", $n->id)->delete();
            }

            foreach ($request->news_files as $file) {
                $nf = new VolcanoBaseFile();
                $nf->volcano_base_id = $n->id;
                $nf->file_id = $file;
                $nf->save();
            }

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
            $vb = VolcanoBase::where('id', $request->id)->first();
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
