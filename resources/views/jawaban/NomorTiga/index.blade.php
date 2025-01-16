<!-- Tabel untuk menampilkan jadwal -->
<table class="table table-schedule">
    <thead>
        <tr>
            <th>Event</th>
            <th>Start</th>
            <th>End</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->start }}</td>
                <td>{{ $event->end }}</td>
                <td>
                    
                </td>
            </tr>

            <!-- Modal Edit -->
            <!-- Modal Edit untuk masing-masing event -->
            <div class="modal fade" id="editModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $event->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('event.update') }}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $event->id }}">Edit Jadwal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <div class="form-group">
                                    <label for="event{{ $event->id }}">Event</label>
                                    <input type="text" class="form-control" id="event{{ $event->id }}" name="event" value="{{ $event->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="start{{ $event->id }}">Start</label>
                                    <input type="datetime-local" class="form-control" id="start{{ $event->id }}" name="start" value="{{ \Carbon\Carbon::parse($event->start)->format('Y-m-d\TH:i') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="end{{ $event->id }}">End</label>
                                    <input type="datetime-local" class="form-control" id="end{{ $event->id }}" name="end" value="{{ \Carbon\Carbon::parse($event->end)->format('Y-m-d\TH:i') }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            

        @endforeach
    </tbody>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.edit-btn').on('click', function() {
            let id = $(this).data('id');
    
            $.get('{{ route("event.get-selected-data") }}', { id: id })
                .done(function(data) {
                    $('#edit_id').val(data.id);
                    $('#edit_nama').val(data.name);
                    $('#edit_start').val(data.start);
                    $('#edit_end').val(data.end);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching data:', textStatus, errorThrown);
                    alert('Error');
                });
        });
    })
</script>
<!-- Gunakan tag form dibawah ini untuk submit data jadwal yang akan diupdate. Gunakan contoh modal yang sudah dibuat pada nomor 1 dan 2 sebagai referensi -->
<!-- <form class="modal-content" method="POST" action="{{ route('event.update') }}"> </form> -->