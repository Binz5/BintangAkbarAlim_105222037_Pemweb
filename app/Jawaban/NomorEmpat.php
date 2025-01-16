<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class NomorEmpat {

    public function getJson() {
        $events = Event::with('user')->get();

        $data = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->name . ' - ' . $event->user->name, 
                'start' => $event->start,
                'end' => $event->end,  
                'backgroundColor' => (Auth::id() == $event->user_id) ? '#007bff' : '#6c757d', 
            ];
        });

        return response()->json($data);
    }
}

?>
