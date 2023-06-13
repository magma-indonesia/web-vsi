<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PressRelease extends Model
{
    use HasFactory;
    protected $appends = ['categories', 'files', 'mountain', 'tags', 'documents', 'maps', 'thumbnails', 'thumbnail',  'detail'];
    public function getCategoriesAttribute() {
        return PressReleaseCategory::where('press_release_id', $this->attributes['id'])->get();
    }

    protected function getFilesAttribute()
    {
        return PressReleaseFile::select('press_release_files.type', 'files.*')
                                    ->join('files', 'files.id', '=', 'press_release_files.file_id')
                                    ->where('press_release_id', $this->attributes['id'])
                                    ->get();
    }

    public function getMountainAttribute() {
        return PressReleaseMountain::select('mountains.*')->join('mountains', 'mountains.id', '=', 'press_release_mountains.mountain_id')
                                    ->where('press_release_id', $this->attributes['id'])
                                    ->first();
    }

    protected function getTagsAttribute()
    {
        return PressReleaseFile::select('tags.*')
                                    ->join('files', 'files.id', '=', 'press_release_files.file_id')
                                    ->join('file_tags', 'files.id', '=', 'file_tags.file_id')
                                    ->join('tags', 'tags.id', '=', 'file_tags.tag_id')
                                    ->where('press_release_id', $this->attributes['id'])
                                    ->get();
    }

    protected function getDocumentsAttribute()
    {
        return PressReleaseFile::select('files.*', DB::raw('0 as is_deleted'))
                                ->join('files', 'files.id', '=', 'press_release_files.file_id')
                                ->where('press_release_files.press_release_id', $this->attributes['id'])
                                ->where('type', 1)
                                ->get();
    }

    protected function getMapsAttribute()
    {
        return PressReleaseFile::select('files.*',DB::raw('0 as is_deleted'))
                                ->join('files', 'files.id', '=', 'press_release_files.file_id')
                                ->where('press_release_files.press_release_id', $this->attributes['id'])
                                ->where('type', 2)
                                ->get();
    }

    protected function getThumbnailsAttribute()
    {
        return PressReleaseFile::select('files.*',DB::raw('0 as is_deleted'))
                                ->join('files', 'files.id', '=', 'press_release_files.file_id')
                                ->where('press_release_files.press_release_id', $this->attributes['id'])
                                ->where('type', 3)
                                ->get();
    }

    protected function getThumbnailAttribute()
    {
        $thumbnail = PressReleaseFile::select('files.*')
                                ->join('files', 'files.id', '=', 'press_release_files.file_id')
                                ->where('press_release_files.press_release_id', $this->attributes['id'])
                                ->where('type', 2)
                                ->orderBy('created_at', 'asc')
                                ->first();

        if ($thumbnail) {
            return route('files.download', [
                'id'    => $thumbnail->id,
                'name'  => $thumbnail->name
            ]);
        } 
        
        return null;
    }

    protected function getDetailAttribute()
    {
        return route('press-release.detail', $this->attributes['route']);
    }
}
