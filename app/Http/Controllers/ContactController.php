<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contents = 'dashboard.template.body';
        try {
            $name = $request->query("name");
            $limit = $request->query("limit");
            $limitOption = [10, 50, 100, 500];
            $contacts = Contact::when($name, function($query) use ($name){
                return $query->where('name', 'like', '%'.$name.'%')
                            ->orWhere('email', 'like', '%'.$name.'%');
            })->orderBy("created_at", "desc")
            ->paginate($limit);
            return view("dashboard.layanan-publik.kontak.index", compact("contacts", "limit", "limitOption", "name", "contents"));
        } catch (\Throwable $e) {
            abort(500, $e->getMessage());
        }
    }
}
