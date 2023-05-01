<?php

namespace App\Services;

use App\Models\News;

class ActivityLevelService
{
    public function get()
    {
        $tingkatAktivitas = [];
        $pressRelease = News::select("news.*")
                            ->where('news_publish_categories.news_category_id', 3)
                            ->join('news_publish_categories','news_publish_categories.news_id','=','news.id')
                            ->orderBy("news.created_at", "desc")
                            ->first();

        if ($pressRelease) {
            $pressRelease->link = env('APP_URL')."/press-release/".$pressRelease->route;
            array_push($tingkatAktivitas, $pressRelease);
        }

        $tanggapanKejadian = News::select("news.*")
                            ->where('news_publish_categories.news_category_id', 4)
                            ->join('news_publish_categories','news_publish_categories.news_id','=','news.id')
                            ->orderBy("news.created_at", "desc")
                            ->first();

        if ($tanggapanKejadian) {
            $tanggapanKejadian->link = env('APP_URL')."/tanggapan-kejadian/".$tanggapanKejadian->route;
            array_push($tingkatAktivitas, $tanggapanKejadian);
        }

        $kajianKejadian = News::select("news.*")
                            ->where('news_publish_categories.news_category_id', 5)
                            ->join('news_publish_categories','news_publish_categories.news_id','=','news.id')
                            ->orderBy("news.created_at", "desc")
                            ->first();

        if ($kajianKejadian) {
            $kajianKejadian->link = env('APP_URL')."/kajian-kejadian/".$kajianKejadian->route;
            array_push($tingkatAktivitas, $kajianKejadian);
        }
        return $tingkatAktivitas;
    }
}