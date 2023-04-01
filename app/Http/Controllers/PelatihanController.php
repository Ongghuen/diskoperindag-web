<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelatihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PelatihanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $items = Pelatihan::with('user')
            ->where(function ($query) use ($keyword) {
                $query
                    ->where('nama', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('tempat', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('penyelenggara', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query
                    ->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('NIK', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(10);

        return view('pages.pelatihan', ['itemList' => $items]);
    }

    public function detailPelatihan($id)
    {
        $pelatihan = Pelatihan::with('user')
            ->where('id', '=', $id)
            ->first();

        return view('pages.pelatihan-detail', ['item' => $pelatihan]);
    }

    public function destroy($id)
    {
        $items = Pelatihan::findOrFail($id);
        $items->delete();

        return back();
    }

    public function storeView($id){
        $user = User::findOrFail($id);

        return view('pages.pelatihan-add', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $items = new Pelatihan;
        $user = $request->user_id;

        $items->create($request->all());

        return redirect('/detail-user-bantuan/' . $user);
    }

    public function updateView($idPelatihan, $idUser)
    {
        $items = Pelatihan::findOrFail($idPelatihan);
        $user = User::findOrFail($idUser);
        return view('pages.pelatihan-edit', ['item' => $items, 'user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $items = Pelatihan::findOrFail($id);
        $user = $request->user_id;
        $items->update($request->all());

        return redirect('/detail-user-bantuan/' . $user);
    }
}
