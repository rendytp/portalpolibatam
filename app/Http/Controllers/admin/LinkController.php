<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCustomLink;

class LinkController extends Controller
{
    public function index()
    {
        $data = UserCustomLink::where('id_user', auth()->id())->latest()->get();
        return view('admin.links', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_link' => 'required',
            'url_link' => 'required'
        ]);

        UserCustomLink::create([
            'id_user' => auth()->id(),
            'judul_link' => $request->judul_link,
            'url_link' => $request->url_link
        ]);

        return back()->with('success', 'Link berhasil ditambahkan');
    }

    public function delete($id)
    {
        UserCustomLink::where('id', $id)
            ->where('id_user', auth()->id())
            ->delete();

        return back()->with('success', 'Link berhasil dihapus');
    }
}
