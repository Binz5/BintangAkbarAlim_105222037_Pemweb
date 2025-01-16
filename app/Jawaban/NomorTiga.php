<?php
namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorTiga {

    public function getData() {
        $data = Event::where('user_id', Auth::id())->get();
        return $data;
    }

    public function getSelectedData(Request $request) {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $data = Event::find($validated['event_id']);
        return response()->json($data);
    }

    public function update(Request $request) {
        
    }

    public function delete(Request $request) {
        
    }
}
?>