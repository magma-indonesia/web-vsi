<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsPublishCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $contents = 'dashboard.template.body'; 
       
        return view("dashboard.layanan-publik.pengumuman.index", compact("contents"));    
    }

    public function get(Request $request)
    {
        try {
            $name = $request->query('name');
            $data = News::select("news.*")
            ->when($name, function ($query) use ($name) {
                return $query->where('title', 'like', '%' . $name . '%');
            })->where('news_publish_categories.news_category_id', 9)
            ->join('news_publish_categories','news_publish_categories.news_id','=','news.id')
            ->orderBy("news.created_at", "desc")
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
        return view("dashboard.layanan-publik.pengumuman.add", compact("contents"));
    }

    public function edit(Request $request)
    {
        $contents = 'dashboard.template.body'; 
        $id = $request->id;

        $retrieve = News::where("id", $id)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("dashboard.layanan-publik.pengumuman.edit", compact("contents", "retrieve"));    
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

            $n = new News();
            $n->content = $request->desc;
            $n->thumbnail = $request->thumbnail;
            $n->created_at = $request->created_at;
            $n->created_by = Auth::user()->name;

            $title = News::where('route', strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title))))
                        ->get();
            if (count($title) > 0) {
                $n->title = $request->title;
                $n->route = strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title)))."-".(count($title)+1);
            } else {
                $n->title = $request->title;
                $n->route = strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title)));
            }

            $n->save();

            $np = new NewsPublishCategory();
            $np->news_id = $n->id;
            $np->news_category_id = 9;
            $np->save();

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
            $data = News::where("id", $request->id)->first();
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

            $n = News::where('id', $request->id)->first();
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
                $title = News::where('route', strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title))))
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
            $vb = News::where('id', $request->id)->first();
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
