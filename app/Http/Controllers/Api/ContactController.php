<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource for table display
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $data = Contact::where('name', 'like', '%' . $search . '%')
                ->orWhere('subject', 'like', '%' . $search . '%')
                ->orWhere('message', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate($request->pageSize);

            return response()->json([
                'message' => '',
                'serve' => $data,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }

    /**
     * Display resource for modal detail
     *
     * @return JsonResponse
     */
    public function getById(Request $request)
    {
        try {
            $data = Contact::where('contacts.id', $request->id)
                ->leftJoin('a_users', 'contacts.read_by', '=', 'a_users.nip')
                ->select('contacts.*', 'a_users.name as reader_name')
                ->first();

            if ($data->read_by === "" || $data->read_by === null) {
                // save whoever reads this first
                $data->read_by = $request->nip;
                $data->is_read = true;
                $data->save();
            }

            return response()->json([
                'message' => '',
                'serve' => $data,
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }

    /**
     * Display resource for notification handler
     *
     * @return JsonResponse
     */
    public function notifications(Request $request)
    {
        try {
            $data = Contact::whereNull('is_read')
                ->orWhere('is_read', false)
                ->orderBy('created_at', 'desc')
                ->get(['id', 'created_at', 'name', 'subject']);

            return response()->json([
                'message' => '',
                'serve' => $data,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'serve' => [],
            ], 500);
        }
    }
}
