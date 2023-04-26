<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\News;
use App\Models\NewsPublishCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $contents = 'dashboard.template.body'; 
        $path = $request->query('category');
        if ($path == '2') {
            return view("dashboard.gunung-api.tingkat-aktivitas.index", compact("contents"));    
        }
        return view("dashboard.gunung-api.data-dasar.index", compact("contents"));
    }

    public function get(Request $request)
    {
        try {
            $name = $request->query('name');
            $category_id = $request->query('category_id');
            $data = News::select("news.*")
            ->when($name, function ($query) use ($name) {
                return $query->where('title', 'like', '%' . $name . '%');
            })->when($category_id, function($query) use ($category_id){
                return $query->where('news_publish_categories.news_category_id',$category_id)
                ->join('news_publish_categories','news_publish_categories.news_id','=','news.id');
            })->orderBy("news.created_at", "desc")
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

            $n = new News;
            $n->title = $request->title;
            $n->content = $request->desc;
            $n->thumbnail = $request->thumbnail;
            $n->created_at = $request->created_at;
            $n->created_by = Auth::user()->name;
            $n->save();

            foreach ($request->categories as $cat) {
                $np = new NewsPublishCategory();
                $np->news_id = $n->id;
                $np->news_category_id = $cat;
                $np->save();
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

            $n->title = $request->title;
            $n->content = $request->desc;
            $n->thumbnail = $request->thumbnail;
            $n->created_at = $request->created_at;
            $n->save();

            if(count($request->categories) > 0){
                $validateCount = NewsPublishCategory::where('news_id', $n->id)->count();
                if($validateCount > 0){
                    NewsPublishCategory::where('news_id',$n->id)->delete();
                }

                foreach ($request->categories as $cat) {
                    $np = new NewsPublishCategory;
                    $np->news_id = $n->id;
                    $np->news_category_id = $cat;
                    $np->save();
                }
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