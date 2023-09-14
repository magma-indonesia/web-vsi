<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Api\FileController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\PressRelease;
use App\Models\PressReleaseCategory;
use App\Models\PressReleaseFile;
use App\Models\PressReleaseMountain;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PressReleaseController extends Controller
{
    public function index(Request $request)
    {
        $contents = 'dashboard.template.body'; 
       
        return view("dashboard.press-release.index", compact("contents"));    
    }

    public function get(Request $request)
    {
        try {
            $isPublished = $request->query('is_published');
            $name = $request->query('name');
            $data = PressRelease::when($name, function ($query) use ($name) {
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
        return view("dashboard.press-release.add", compact("contents"));
    }

    public function edit(Request $request)
    {
        $contents = 'dashboard.template.body'; 
        $id = $request->id;

        $retrieve = PressRelease::where("id", $id)->first();
        if (!$retrieve) {
            abort(404);
        }

        return view("dashboard.press-release.edit", compact("contents", "retrieve"));    
    }

    public function uploadDocument(Request $request, $id) {
        if ($request->count_document > 0) {
            for ($i=0;$i<$request->count_document;$i++) {
                if ($request->hasFile('document-'.$i)) {
                    $tags = explode(',', $request->tags);
                    $fileTags = [];
                    foreach ($tags as $tag) {
                        $tag = trim($tag);
                        $tag = ucwords($tag);
                        $dataTag = Tag::query()
                            ->where('name', $tag)
                            ->first();
                        if (empty($dataTag)) {
                            $dataTag = new Tag();
                            $dataTag->name = $tag;
                            $dataTag->save();
                        }
        
                        $fileTags[] = $dataTag->id;
                    }
        
                    $responseFile = [];
                    $fileUpload = $request->file('document-'.$i);
                    $fileName = $fileUpload->getClientOriginalName();
                    $fileNameExist = File::query()
                        ->where('user_id', $this->user()->id)
                        ->where('name', $fileName)
                        ->get();
                    if ($fileNameExist->count() > 0) {
                        $ext = '.'.$fileUpload->getClientOriginalExtension();
                        $fileName = str_replace($ext, '('.$fileNameExist->count().')'.$ext, $fileName);
                    }
                    $filePath = 'files/'.$this->user()->nip;
                    Storage::putFileAs(
                        $filePath,
                        $fileUpload,
                        $fileName
                    );
    
                    $file = new File();
                    $file->user_id = $this->user()->id;
                    $file->name = $fileName;
                    $file->path = $filePath.'/'.$fileName;
                    $file->label = $request->label;
                    $file->notes = $request['document-notes-'.$i];
                    $file->is_press_release = 1;
                    $file->save();
                    
                    $pFile = new PressReleaseFile();
                    $pFile->type = 1;
                    $pFile->press_release_id = $id;
                    $pFile->file_id = $file->id;
                    $pFile->save();

                    $file->tags()->sync($fileTags);
                    array_push($responseFile, $file->id);
                }
            }
        }
    }

    public function uploadMap(Request $request, $id) {
        if ($request->count_map > 0) {
            for ($i=0;$i<$request->count_map;$i++) {
                if ($request->hasFile('map-'.$i)) {
                    $tags = explode(',', $request->tags);
                    $fileTags = [];
                    foreach ($tags as $tag) {
                        $tag = trim($tag);
                        $tag = ucwords($tag);
                        $dataTag = Tag::query()
                            ->where('name', $tag)
                            ->first();
                        if (empty($dataTag)) {
                            $dataTag = new Tag();
                            $dataTag->name = $tag;
                            $dataTag->save();
                        }
        
                        $fileTags[] = $dataTag->id;
                    }
        
                    $responseFile = [];
                    $fileUpload = $request->file('map-'.$i);
                    $fileName = $fileUpload->getClientOriginalName();
                    $fileNameExist = File::query()
                        ->where('user_id', $this->user()->id)
                        ->where('name', $fileName)
                        ->get();
                    if ($fileNameExist->count() > 0) {
                        $ext = '.'.$fileUpload->getClientOriginalExtension();
                        $fileName = str_replace($ext, '('.$fileNameExist->count().')'.$ext, $fileName);
                    }
                    $filePath = 'files/'.$this->user()->nip;
                    Storage::putFileAs(
                        $filePath,
                        $fileUpload,
                        $fileName
                    );
    
                    $file = new File();
                    $file->user_id = $this->user()->id;
                    $file->name = $fileName;
                    $file->path = $filePath.'/'.$fileName;
                    $file->label = $request->label;
                    $file->notes = $request['map-notes-'.$i];
                    $file->is_press_release = 1;
                    $file->save();
                    
                    $pFile = new PressReleaseFile();
                    $pFile->type = 2;
                    $pFile->press_release_id = $id;
                    $pFile->file_id = $file->id;
                    $pFile->save();

                    $file->tags()->sync($fileTags);
                    array_push($responseFile, $file->id);
                }
            }
        }
    }

    public function uploadThumbnail(Request $request, $id) {
        if ($request->count_thumbnail > 0) {
            for ($i=0;$i<$request->count_thumbnail;$i++) {
                if ($request->hasFile('thumbnail-'.$i)) {
                    $tags = explode(',', $request->tags);
                    $fileTags = [];
                    foreach ($tags as $tag) {
                        $tag = trim($tag);
                        $tag = ucwords($tag);
                        $dataTag = Tag::query()
                            ->where('name', $tag)
                            ->first();
                        if (empty($dataTag)) {
                            $dataTag = new Tag();
                            $dataTag->name = $tag;
                            $dataTag->save();
                        }
        
                        $fileTags[] = $dataTag->id;
                    }
        
                    $responseFile = [];
                    $fileUpload = $request->file('thumbnail-'.$i);
                    $fileName = $fileUpload->getClientOriginalName();
                    $fileNameExist = File::query()
                        ->where('user_id', $this->user()->id)
                        ->where('name', $fileName)
                        ->get();
                    if ($fileNameExist->count() > 0) {
                        $ext = '.'.$fileUpload->getClientOriginalExtension();
                        $fileName = str_replace($ext, '('.$fileNameExist->count().')'.$ext, $fileName);
                    }
                    $filePath = 'files/'.$this->user()->nip;
                    Storage::putFileAs(
                        $filePath,
                        $fileUpload,
                        $fileName
                    );
    
                    $file = new File();
                    $file->user_id = $this->user()->id;
                    $file->name = $fileName;
                    $file->path = $filePath.'/'.$fileName;
                    $file->label = $request->label;
                    $file->notes = $request['thumbnail-notes-'.$i];
                    $file->is_press_release = 1;
                    $file->save();
                    
                    $pFile = new PressReleaseFile();
                    $pFile->type = 3;
                    $pFile->press_release_id = $id;
                    $pFile->file_id = $file->id;
                    $pFile->save();

                    $file->tags()->sync($fileTags);
                    array_push($responseFile, $file->id);
                }
            }
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'created_at' => 'required',
                'categories' => 'required',
                'tags' => 'required'
            ]);
           
            if ($validator->fails()) {
                DB::commit();
                return response()->json([
                    'message' => $validator->errors()->first(),
                    'serve' => []
                ], 400);
            }

            $n = new PressRelease();
            $n->letter_number = $request->letter_number;
            $n->content = $request->desc;
            $n->created_at = $request->created_at;
            $n->created_by = Auth::user()->name;
            $n->status = $request->status;

            $title = PressRelease::where('route', strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title))))
                        ->get();
            if (count($title) > 0) {
                $n->title = $request->title;
                $n->route = strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title)))."-".(count($title)+1);
            } else {
                $n->title = $request->title;
                $n->route = strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title)));
            }

            $n->save();
            
            if ($request->is_manual_document == '2') {
                $this->uploadDocument($request, $n->id);
            } else {
                if ($request->count_document_media > 0) {
                    for ($i=0;$i<$request->count_document_media;$i++) {                            
                        $pFile = new PressReleaseFile();
                        $pFile->type = 1;
                        $pFile->press_release_id = $n->id;
                        $pFile->file_id = $request['document-media-'.$i];
                        $pFile->save();
                    }
                }
            }

            if ($request->is_manual_map == '2') {
                $this->uploadMap($request, $n->id);
            } else {
                if ($request->count_map_media > 0) {
                    for ($i=0;$i<$request->count_map_media;$i++) {                            
                        $pFile = new PressReleaseFile();
                        $pFile->type = 2;
                        $pFile->press_release_id = $n->id;
                        $pFile->file_id = $request['map-media-'.$i];
                        $pFile->save();
                    }
                }
            }

            if ($request->is_manual_thumbnail == '2') {
                $this->uploadThumbnail($request, $n->id);
            } else {
                if ($request->count_thumbnail_media > 0) {
                    for ($i=0;$i<$request->count_thumbnail_media;$i++) {                            
                        $pFile = new PressReleaseFile();
                        $pFile->type = 3;
                        $pFile->press_release_id = $n->id;
                        $pFile->file_id = $request['thumbnail-media-'.$i];
                        $pFile->save();
                    }
                }
            }

            $categories = explode(',', $request->categories);
            foreach ($categories as $cat) {
                $nC = new PressReleaseCategory();
                $nC->press_release_id = $n->id;
                $nC->category = $cat;
                $nC->save();

                if ($cat == 'Gunung Api') {
                    $nM = new PressReleaseMountain();
                    $nM->press_release_id = $n->id;
                    $nM->mountain_id = $request->mountain_id;
                    $nM->save();
                }
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
            $data = PressRelease::where("id", $request->id)->first();
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

            $n = PressRelease::where('id', $request->id)->first();
            if (!$n) {
                DB::commit();
                return response()->json([
                    'message' => "Gagal mendapatkan data.",
                    'serve' => []
                ], 400);
            }

            
            $n->letter_number = $request->letter_number;
            $n->content = $request->desc;
            $n->created_at = $request->created_at;
            $n->status = $request->status;

            if ($n->title !== $request->title) {
                $title = PressRelease::where('route', strtolower(preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->title))))
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

            if (isset($request->documents_old_data) && count(json_decode($request->documents_old_data)) > 0) {
                foreach(json_decode($request->documents_old_data) as $old) {
                    if ($old->is_deleted) {
                        $file = new FileController();
                        $req = new Request();
                        $req->merge([
                            'id' => $old->id,
                        ]);
                        $file->destroy($req);
                    } else {
                        $file = File::where("id", $old->id)->first();
                        if ($file) {
                            $file->notes = $old->notes;
                            $file->save();
                        }
                    }
                }
            }

            if (isset($request->maps_old_data) && count(json_decode($request->maps_old_data)) > 0) {
                foreach(json_decode($request->maps_old_data) as $old) {
                    if ($old->is_deleted) {
                        $file = new FileController();
                        $req = new Request();
                        $req->merge([
                            'id' => $old->id,
                        ]);
                        $file->destroy($req);
                    } else {
                        $file = File::where("id", $old->id)->first();
                        if ($file) {
                            $file->notes = $old->notes;
                            $file->save();
                        }
                    }
                }
            }

            if (isset($request->thumbnails_old_data) && count(json_decode($request->thumbnails_old_data)) > 0) {
                foreach(json_decode($request->thumbnails_old_data) as $old) {
                    if ($old->is_deleted) {
                        $file = new FileController();
                        $req = new Request();
                        $req->merge([
                            'id' => $old->id,
                        ]);
                        $file->destroy($req);
                    } else {
                        $file = File::where("id", $old->id)->first();
                        if ($file) {
                            $file->notes = $old->notes;
                            $file->save();
                        }
                    }
                }
            }

            if ($request->is_manual_document == '2') {
                $this->uploadDocument($request, $n->id);
            } else {
                if ($request->count_document_media > 0) {
                    for ($i=0;$i<$request->count_document_media;$i++) {                            
                        $pFile = new PressReleaseFile();
                        $pFile->type = 1;
                        $pFile->press_release_id = $n->id;
                        $pFile->file_id = $request['document-media-'.$i];
                        $pFile->save();
                    }
                }
            }

            if ($request->is_manual_map == '2') {
                $this->uploadMap($request, $n->id);
            } else {
                if ($request->count_map_media > 0) {
                    for ($i=0;$i<$request->count_map_media;$i++) {                            
                        $pFile = new PressReleaseFile();
                        $pFile->type = 2;
                        $pFile->press_release_id = $n->id;
                        $pFile->file_id = $request['map-media-'.$i];
                        $pFile->save();
                    }
                }
            }

            if ($request->is_manual_thumbnail == '2') {
                $this->uploadThumbnail($request, $n->id);
            } else {
                if ($request->count_thumbnail_media > 0) {
                    for ($i=0;$i<$request->count_thumbnail_media;$i++) {                            
                        $pFile = new PressReleaseFile();
                        $pFile->type = 3;
                        $pFile->press_release_id = $n->id;
                        $pFile->file_id = $request['thumbnail-media-'.$i];
                        $pFile->save();
                    }
                }
            }

            $categories = explode(',', $request->categories);
            if (count($categories) > 0) {
                $validateCount = PressReleaseCategory::where('press_release_id', $n->id)->count();
                if($validateCount > 0){
                    PressReleaseCategory::where('press_release_id',$n->id)->delete();
                }

                foreach ($categories as $cat) {
                    $nC = new PressReleaseCategory();
                    $nC->press_release_id = $n->id;
                    $nC->category = $cat;
                    $nC->save();
    
                    if ($cat == 'Gunung Api') {
                        $nM = new PressReleaseMountain();
                        $nM->press_release_id = $n->id;
                        $nM->mountain_id = $request->mountain_id;
                        $nM->save();
                    }
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
            $vb = PressRelease::where('id', $request->id)->first();
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

    public function files(Request $request)
    {
        try {
            $extension = $request->query('ext');
            $name = $request->query('name');
            $user_id = $request->query('user_id');
            $data = File::when($name, function ($query) use ($name) {
                            return $query->where('name', 'like', '%' . $name . '%');
                        })->when($user_id, function ($query) {
                            return $query->where('user_id', Auth::user()->id);
                        })->whereIn(DB::raw("SUBSTRING_INDEX(name,'.',-1)"), explode(",",$extension))
                        ->orderBy("created_at", "desc")
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
}
