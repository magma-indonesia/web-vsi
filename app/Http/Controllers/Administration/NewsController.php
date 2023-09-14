<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\News;
use App\Models\New;
use App\Models\NewsFile;
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
        if ($path == '3') {
            return view("dashboard.gunung-api.press-release.index", compact("contents"));    
        }
        if ($path == '4') {
            return view("dashboard.gerakan-tanah.tanggapan-kejadian.index", compact("contents"));    
        }
        if ($path == '5') {
            return view("dashboard.gempa-bumi-tsunami.kajian-kejadian.index", compact("contents"));    
        }
        if ($path == '6') {
            return view("dashboard.gempa-bumi-tsunami.daftar-kejadian.index", compact("contents"));    
        }
        if ($path == '7') {
            return view("dashboard.gempa-bumi-tsunami.publikasi-mitigasi.index", compact("contents"));    
        }
        if ($path == '8') {
            return view("dashboard.gempa-bumi-tsunami.laporan-singkat.index", compact("contents"));    
        }
        if ($path == '9') {
            return view("dashboard.layanan-publik.pengumuman.index", compact("contents"));    
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

    public function add(Request $request)
    {
        $contents = 'dashboard.template.body'; 
        $path = $request->query('category');
        if ($path == '2') {
            return view("dashboard.gunung-api.tingkat-aktivitas.add", compact("contents"));    
        }
        if ($path == '3') {
            return view("dashboard.gunung-api.press-release.add", compact("contents"));    
        }
        if ($path == '4') {
            return view("dashboard.gerakan-tanah.tanggapan-kejadian.add", compact("contents"));    
        }
        if ($path == '5') {
            return view("dashboard.gempa-bumi-tsunami.kajian-kejadian.add", compact("contents"));    
        }
        if ($path == '6') {
            return view("dashboard.gempa-bumi-tsunami.daftar-kejadian.add", compact("contents"));    
        }
        if ($path == '7') {
            return view("dashboard.gempa-bumi-tsunami.publikasi-mitigasi.add", compact("contents"));    
        }
        if ($path == '8') {
            return view("dashboard.gempa-bumi-tsunami.laporan-singkat.add", compact("contents"));    
        }
        if ($path == '9') {
            return view("dashboard.layanan-publik.pengumuman.add", compact("contents"));    
        }
        return view("dashboard.gunung-api.data-dasar.add", compact("contents"));
    }

    public function edit(Request $request)
    {
        $contents = 'dashboard.template.body'; 
        $path = $request->query('category');
        $id = $request->id;

        $retrieve = News::where("id", $id)->first();
        if (!$retrieve) {
            abort(404);
        }

        if ($path == '2') {
            return view("dashboard.gunung-api.tingkat-aktivitas.edit", compact("contents", "retrieve"));    
        }
        if ($path == '3') {
            return view("dashboard.gunung-api.press-release.edit", compact("contents", "retrieve"));    
        }
        if ($path == '4') {
            return view("dashboard.gerakan-tanah.tanggapan-kejadian.edit", compact("contents", "retrieve"));    
        }
        if ($path == '5') {
            return view("dashboard.gempa-bumi-tsunami.kajian-kejadian.edit", compact("contents", "retrieve"));    
        }
        if ($path == '6') {
            return view("dashboard.gempa-bumi-tsunami.daftar-kejadian.edit", compact("contents", "retrieve"));    
        }
        if ($path == '7') {
            return view("dashboard.gempa-bumi-tsunami.publikasi-mitigasi.edit", compact("contents", "retrieve"));    
        }
        if ($path == '8') {
            return view("dashboard.gempa-bumi-tsunami.laporan-singkat.edit", compact("contents", "retrieve"));    
        }
        if ($path == '9') {
            return view("dashboard.layanan-publik.pengumuman.edit", compact("contents", "retrieve"));    
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

            $n = new News;
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

            foreach ($request->categories as $cat) {
                $np = new NewsPublishCategory();
                $np->news_id = $n->id;
                $np->news_category_id = $cat;
                $np->save();
            }

            foreach ($request->news_files as $file) {
                $nf = new NewsFile();
                $nf->news_id = $n->id;
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

            if(count($request->files) > 0){
                $validateCount = NewsFile::where('news_id', $n->id)->count();
                if($validateCount > 0){
                    NewsFile::where('news_id',$n->id)->delete();
                }

                foreach ($request->files as $file) {
                    $nf = new NewsFile;
                    $nf->news_id = $n->id;
                    $nf->file_id = $file;
                    $nf->save();
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
