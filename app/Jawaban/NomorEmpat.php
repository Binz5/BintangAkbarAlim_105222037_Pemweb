<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorEmpat {

    public function getJson() {
        // Mengambil semua data jadwal dari tabel Event, termasuk relasi user
        $events = Event::with('user')->get();

        // Menyusun ulang data agar sesuai dengan format yang dibutuhkan
        $data = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->name . ' - ' . $event->user->name, // Menyusun nama event dan nama pengguna
                'start' => $event->start, // Menyertakan tanggal mulai
                'end' => $event->end,     // Menyertakan tanggal selesai
                'backgroundColor' => (Auth::id() == $event->user_id) ? '#007bff' : '#6c757d', // Warna biru jika milik user yang sedang login, abu-abu jika tidak
            ];
        });

        // Mengembalikan hasil dalam format JSON
        return response()->json($data);
    }
}

?>
