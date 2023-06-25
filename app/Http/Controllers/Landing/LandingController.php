<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\EqtStudyEvent;
use App\Models\GroundResponse;
use App\Models\News;
use App\Models\PressRelease;
use DOMDocument;
use Illuminate\Support\Facades\Redis;

class LandingController extends Controller
{
    public function getTingkatAktivitas()
    {
        $tingkatAktivitas = [];
        $pressRelease = PressRelease::orderBy("created_at", "desc")->first();

        if ($pressRelease) {
            $pressRelease->link = env('APP_URL') . "/press-release/" . $pressRelease->route;
            array_push($tingkatAktivitas, $pressRelease);
        }

        $tanggapanKejadian = GroundResponse::orderBy("created_at", "desc")->first();

        if ($tanggapanKejadian) {
            $tanggapanKejadian->link = env('APP_URL') . "/tanggapan-kejadian/" . $tanggapanKejadian->route;
            array_push($tingkatAktivitas, $tanggapanKejadian);
        }

        $kajianKejadian = EqtStudyEvent::orderBy("created_at", "desc")->first();

        if ($kajianKejadian) {
            $kajianKejadian->link = env('APP_URL') . "/kajian-kejadian/" . $kajianKejadian->route;
            array_push($tingkatAktivitas, $kajianKejadian);
        }
        return $tingkatAktivitas;
    }

    public function index()
    {
        $news = [];
        $pengumuman = News::select("news.*")
            ->where('news_publish_categories.news_category_id', 9)
            ->join('news_publish_categories', 'news_publish_categories.news_id', '=', 'news.id')
            ->orderBy("news.created_at", "desc")
            ->first();

        $pressRelease = PressRelease::orderBy("created_at", "desc")->limit(2)->get();

        if (count($pressRelease) > 0) {
            foreach ($pressRelease as $row) {
                $row->type = 'Press Release';
                $row->link = env('APP_URL') . "/press-release/" . $row->route;
                array_push($news, $row);
            }
            $pressRelease = $pressRelease[0];
        } else {
            $pressRelease = null;
        }

        $tanggapanKejadian = GroundResponse::orderBy("created_at", "desc")->limit(2)->get();

        if (count($tanggapanKejadian) > 0) {
            foreach ($tanggapanKejadian as $row) {
                $row->type = 'Tanggapan Kejadian';
                $row->link = env('APP_URL') . "/tanggapan-kejadian/" . $row->route;
                $row->thumbnail = env('APP_URL') . "/storage/" . $row->thumbnail;
                array_push($news, $row);
            }
            $tanggapanKejadian = $tanggapanKejadian[0];
        } else {
            $tanggapanKejadian = null;
        }

        $kajianKejadian = EqtStudyEvent::orderBy("created_at", "desc")->limit(2)->get();

        if (count($kajianKejadian) > 0) {
            foreach ($kajianKejadian as $row) {
                $row->type = 'Kajian Kejadian';
                $row->link = env('APP_URL') . "/kajian-kejadian/" . $row->route;
                $row->thumbnail = env('APP_URL') . "/storage/" . $row->thumbnail;
                array_push($news, $row);
            }
            $kajianKejadian = $kajianKejadian[0];
        } else {
            $kajianKejadian = null;
        }

        usort($news, function ($first, $second) {
            return strtolower($first->created_at) < strtolower($second->created_at);
        });

        $statusGunung = '[]';
        if (env('USE_REDIS') == '1') {
            $cachedStatusGunung = Redis::get('statusGunung');
            if (isset($cachedStatusGunung)) {
                $statusGunung = json_decode($cachedStatusGunung, FALSE);
            } else {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://magma.esdm.go.id/api/v1/home/gunung-api/status',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvbWFnbWEuZXNkbS5nby5pZFwvYXBpXC9sb2dpblwvc3Rha2Vob2xkZXIiLCJpYXQiOjE2ODEwOTI2MDEsImV4cCI6MTgzODg1OTAwMSwibmJmIjoxNjgxMDkyNjAxLCJqdGkiOiJzeXdxeGtjTW9BOXhPZnRuIiwic3ViIjoyNCwicHJ2IjoiNGE5ZDlhMmQyNjgwMmMzMTJlOGU1YTViZTYwZmYyNmYwZmM2M2Q3ZCIsInNvdXJjZSI6Ik1BR01BIEluZG9uZXNpYSIsImFwaV92ZXJzaW9uIjoidjEiLCJkYXlzX3JlbWFpbmluZyI6MTgyNSwiZXhwaXJlZF9hdCI6IjIwMjgtMDQtMDkgMDA6MDA6MDAifQ.hol8d2rgvChG5Kth6JAV3o9xIWKljP-Opi7mhSSLxIY'
                    ),
                )
                );

                $response = curl_exec($curl);

                curl_close($curl);

                if ($response) {
                    $parseJson = json_decode($response);
                    $statusGunung = json_encode($parseJson->latest);
                    Redis::set('statusGunung', $statusGunung, 'EX', 21600);
                }
            }
        } else {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://magma.esdm.go.id/api/v1/home/gunung-api/status',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvbWFnbWEuZXNkbS5nby5pZFwvYXBpXC9sb2dpblwvc3Rha2Vob2xkZXIiLCJpYXQiOjE2ODEwOTI2MDEsImV4cCI6MTgzODg1OTAwMSwibmJmIjoxNjgxMDkyNjAxLCJqdGkiOiJzeXdxeGtjTW9BOXhPZnRuIiwic3ViIjoyNCwicHJ2IjoiNGE5ZDlhMmQyNjgwMmMzMTJlOGU1YTViZTYwZmYyNmYwZmM2M2Q3ZCIsInNvdXJjZSI6Ik1BR01BIEluZG9uZXNpYSIsImFwaV92ZXJzaW9uIjoidjEiLCJkYXlzX3JlbWFpbmluZyI6MTgyNSwiZXhwaXJlZF9hdCI6IjIwMjgtMDQtMDkgMDA6MDA6MDAifQ.hol8d2rgvChG5Kth6JAV3o9xIWKljP-Opi7mhSSLxIY'
                ),
            )
            );

            $response = curl_exec($curl);

            curl_close($curl);

            if ($response) {
                $parseJson = json_decode($response);
                $statusGunung = json_encode($parseJson->latest);
            }
        }

        return view('home.index', compact('statusGunung', 'pengumuman', 'pressRelease', 'tanggapanKejadian', 'kajianKejadian', 'news'));
    }
}