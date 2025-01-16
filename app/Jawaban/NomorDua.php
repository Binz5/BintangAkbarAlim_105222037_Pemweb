<?php
namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorDua {

    public function submit(Request $request) {
        // Validasi input
        $this->validateRequest($request);

        // Menyimpan data ke tabel events
        $this->storeEventData($request);

        // Redirect kembali ke halaman home dengan pesan sukses
        return $this->redirectToHomeWithSuccessMessage();
    }

    // Fungsi untuk validasi request
    private function validateRequest(Request $request)
    {
        $request->validate([
            'event' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
    }

    // Fungsi untuk menyimpan data event
    private function storeEventData(Request $request)
    {
        Event::create([
            'user_id' => Auth::id(),  // ID pengguna yang sedang login
            'name' => $request->event,
            'start' => $request->start,
            'end' => $request->end,
        ]);
    }

    // Fungsi untuk redirect dengan pesan sukses
    private function redirectToHomeWithSuccessMessage()
    {
        return redirect()->route('event.home')->with('success', 'Event created successfully!');
    }
}
