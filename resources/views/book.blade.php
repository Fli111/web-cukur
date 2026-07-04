<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Hartono BOOK APPOINMENT</title>

    <link rel="stylesheet" href="{{ asset('style1.css') }}">
</head>

<body>

<section class="team-book">

    <div class="team-header-book">

        <p>CRAFTSMANSHIP & PRECISION</p>

        <h2>Choose Your Artisan</h2>

        <p class="desc-book">
            Each master at The Atelier brings a unique architectural perspective to grooming.
            Select the hands that will define your signature look.
        </p>

    </div>

    <div class="team-container-book">

        @foreach($barbers as $barber)

        <div class="team-card-book {{ $barber->barber_id == 1 ? 'large' : '' }}"
            data-id="{{ $barber->barber_id }}">

            <img src="{{ asset('img/' . $barber->foto) }}" alt="Foto Barber">

            <div class="team-info-book">

                <h3>
                    {{ $barber->nama }}
                </h3>

                <p>
                    {{ $barber->role }}
                </p>

            </div>

        </div>

        @endforeach

        <div class="team-card-book special">

            <h3>ANY ARTISAN</h3>

            <p>
                We will assign the best available master for flexible scheduling.
            </p>

            <a href="#">
                SELECT FIRST AVAILABLE
            </a>

        </div>

    </div>

    <div class="team-footer-book">

        <p>Guaranteed Quality</p>

        <button onclick="goToBooking()">
            PROCEED TO SCHEDULE
        </button>

    </div>

</section>

<script>

let selectedArtisan = null;

const cards = document.querySelectorAll('.team-card-book');

cards.forEach(card => {

    card.addEventListener('click', () => {

        cards.forEach(c => c.classList.remove('active'));

        card.classList.add('active');

        selectedArtisan = card.getAttribute('data-id');

    });

});

// Mengambil data dari controller menggunakan Blade syntax
const service = "{{ $service }}";
const price = "{{ $price }}";

function goToBooking(){

    if (!selectedArtisan) {

        alert("Maaf, Anda belum memilih artisan.");

    } else {

        // Menggunakan helper route() Laravel dipadukan dengan parameter JS
        window.location.href = 
        "{{ route('tanggal_book') }}?artisan=" + 
        encodeURIComponent(selectedArtisan) + 
        "&service=" + 
        encodeURIComponent(service) + 
        "&price=" + 
        encodeURIComponent(price);

    }

}

</script>

</body>
</html>