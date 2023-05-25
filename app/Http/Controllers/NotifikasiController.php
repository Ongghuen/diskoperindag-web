<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class NotifikasiController extends Controller
{
    public function create() //function untuk menampilkan tampilan notifikasi di website
    {
        $user = User::all();

        return view('pages.notifikasi', ['user' => $user]);
    }

    public function store(Request $request) //function untuk mengirim notifikasi ke user
    {
        $request->validate(
            [
                'judul' => 'required|max:100',
                'body' => 'required',
            ],
            [
                'judul.required' => 'Judul tidak boleh kosong!',
                'judul.max' => 'Sub Judul maksimal 100 karakter!',
                'body.required' => 'deskripsi tidak boleh kosong!'
            ]
        );

        $messaging = app('firebase.messaging');
        $notification = Notification::fromArray([
            'title' => $request->judul,
            'body' => $request->body,
        ]);

        $argOne = 'topic';
        $token = 'diskoperindag';
        $message = null;

        if ($request->token == 'Semua') {
            $message = CloudMessage::withTarget($argOne, $token)
                ->withNotification($notification);
        } else {
            $argOne = 'token';
            $token = $request->token;
            $message = CloudMessage::withTarget($argOne, $token)
                ->withNotification($notification);
        }

        if ($message != null) {
            $messaging->send($message);

            return redirect()->intended('/notifikasi')->with('createNotif', 'berhasil');
        }

        return redirect()->intended('/notifikasi')->with('notifGagal', 'gagal');
    }
}
