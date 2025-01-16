<script type="text/javascript">
    // Fungsi untuk mengambil data acara dari API
    function fetchEvents() {
        // Melakukan panggilan API untuk mendapatkan data acara
        $.ajax({
            url: "{{ route('event.get-json') }}", // URL untuk endpoint API
            method: "GET", // Menggunakan metode GET
            success: function (response) {
                // Menghapus semua event yang sudah ada di kalender
                calendar.removeAllEvents();

                // Menambahkan setiap event yang diterima ke kalender
                response.forEach(function (event) {
                    calendar.addEvent({
                        id: event.id,
                        title: event.title,
                        start: event.start,
                        end: event.end,
                        backgroundColor: '#28a745', // Ubah warna menjadi hijau
                    });
                });
            },
            error: function (xhr) {
                console.error("Terjadi kesalahan saat mengambil data acara: ", xhr.responseText);
            }
        });
    }

    // Menunggu dokumen dimuat sepenuhnya sebelum inisialisasi kalender
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar'); // Ambil elemen untuk kalender
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Tampilan awal kalender dalam format bulanan
            events: [], // Kalender dimulai dengan event kosong
        });

        // Render kalender ke dalam halaman
        calendar.render();

        // Ambil data acara dari API saat halaman dimuat
        fetchEvents();
    });

    // Menambahkan event listener untuk tombol refresh
    $('#refreshButton').on('click', function () {
        fetchEvents(); // Memanggil API untuk mengambil data acara terbaru
    });
</script>
