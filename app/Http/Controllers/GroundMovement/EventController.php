<?php

namespace App\Http\Controllers\GroundMovement;

use App\Http\Controllers\Controller;
use App\Models\GroundMovement;
use App\Param;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $contents = 'dashboard.template.body';
    private $limitOption = [10, 50, 100, 500];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $limit = $request->limit ?? 10;

        $events = GroundMovement::query()
            ->where('category_id', Param::GROUND_MOVEMENT_EVENT)
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit);

        return view('dashboard.gerakan-tanah.kejadian.index', [
            'contents' => $this->contents,
            'pageTitle' => 'Daftar Kejadian',
            'createUrl' => route('dashboard.gerakan-tanah.kejadian.create'),
            'limitOption' => $this->limitOption,
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('dashboard.gerakan-tanah.kejadian.form', [
            'contents' => $this->contents,
            'pageTitle' => 'Daftar Kejadian',
            'saveUrl' => route('dashboard.gerakan-tanah.kejadian.store'),
            'input' => array_merge($request->input(), $request->old()),
            'isUpdate' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => ['required'],
                'description' => ['required'],
            ],
            [
                'title.required' => 'Judul Artikel harus dipilih',
                'description.required' => 'Deskripsi Artikel harus diisi',
            ]
        );
        try {
            $event = new GroundMovement();
            $event->category_id = Param::GROUND_MOVEMENT_EVENT;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->author_id = $this->user()->id;
            $event->save();
        } catch (Exception $e) {
            return $this->errorRedirectBack($e);
        }

        return $this->successRedirect('dashboard.gerakan-tanah.kejadian.index', 'Data Artikel Kejadian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $event = GroundMovement::find($id);
        $request->merge([
            'title' => $event->title,
            'description' => $event->description,
        ]);

        return view('dashboard.gerakan-tanah.kejadian.form', [
            'contents' => $this->contents,
            'pageTitle' => 'Daftar Kejadian',
            'saveUrl' => route('dashboard.gerakan-tanah.kejadian.update', $id),
            'input' => array_merge($request->input(), $request->old()),
            'isUpdate' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'title' => ['required'],
                'description' => ['required'],
            ],
            [
                'title.required' => 'Judul Artikel harus dipilih',
                'description.required' => 'Deskripsi Artikel harus diisi',
            ]
        );
        try {
            $event = GroundMovement::find($id);
            $event->title = $request->title;
            $event->description = $request->description;
            $event->save();
        } catch (Exception $e) {
            return $this->errorRedirectBack($e);
        }

        return $this->successRedirect('dashboard.gerakan-tanah.kejadian.index', 'Data Artikel Kejadian berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = GroundMovement::find($id);
            $user->delete();
        } catch (Exception $e) {
            return $this->errorRedirectBack($e);
        }

        return $this->successRedirect('dashboard.gerakan-tanah.kejadian.index', 'Data Artikel Kejadian berhasil dihapus.');
    }
}
