<?php
namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorDua {

    public function submit(Request $request) {
        $this->validateRequest($request);

        $this->storeEventData($request);

        return $this->redirectToHomeWithSuccessMessage();
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'event' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
    }

    private function storeEventData(Request $request)
    {
        Event::create([
            'user_id' => Auth::id(),  
            'name' => $request->event,
            'start' => $request->start,
            'end' => $request->end,
        ]);
    }

    private function redirectToHomeWithSuccessMessage()
    {
        return redirect()->route('event.home')->with('success', 'Event created successfully!');
    }
}
