<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('style1.css') }}">

    <title>Book Tanggal</title>
</head>

<body>

<nav class="navbar">
    <div class="logo">THE ATELIER</div>
</nav>

<section class="booking">

    <div class="booking-left">

        <a href="{{ route('book', ['service' => urlencode($service), 'price' => urlencode($price)]) }}" class="back">
            ← BACK TO BARBER SELECTION
        </a>

        <h3 class="subtitle">
            Secure Your Session
        </h3>

        <p class="desc-tgl">
            Every movement is calculated. Select a date and time that aligns 
            with your pursuit of excellence.
        </p>

        <h2 class="section-title">
            Select Date
        </h2>

        <div class="calendar">

            <div class="calendar-header">

                <span id="prevMonth">‹</span>

                <p id="monthYear"></p>

                <span id="nextMonth">›</span>

            </div>

            <div class="calendar-days">
                <span>SUN</span>
                <span>MON</span>
                <span>TUE</span>
                <span>WED</span>
                <span>THU</span>
                <span>FRI</span>
                <span>SAT</span>
            </div>

            <div class="calendar-grid" id="calendarGrid"></div>

        </div>

        <h2 class="section-title">
            Select Time
        </h2>

        <div class="time-group">

            <p>MORNING</p>

            <div class="time-list">
                <button type="button">09:00 AM</button>
                <button type="button">09:45 AM</button>
                <button type="button">10:30 AM</button>
                <button type="button">11:15 AM</button>
            </div>

        </div>

        <div class="time-group">

            <p>AFTERNOON</p>

            <div class="time-list">
                <button type="button">01:00 PM</button>
                <button type="button" class="active">01:45 PM</button>
                <button type="button">02:30 PM</button>
                <button type="button">03:15 PM</button>
                <button type="button">04:00 PM</button>
            </div>

        </div>

        <div class="time-group">

            <p>EVENING</p>

            <div class="time-list">
                <button type="button">06:00 PM</button>
                <button type="button">06:45 PM</button>
                <button type="button">07:30 PM</button>
            </div>

        </div>

    </div>

    <div class="booking-right">

        <div class="summary">

            <h3>Your Appointment</h3>

            <div class="item">

                <span>SERVICE</span>

                <h4>
                    {{ $service }}
                </h4>

                <small>
                    Full consultation, precision cut, and styling.
                </small>

            </div>

            <div class="item">

                <span>BARBER</span>

                <h4>
                    {{ $dataBarber->nama }}
                </h4>

                <small>
                    {{ $dataBarber->role }}
                </small>

            </div>

            <div class="item">

                <span>SCHEDULE</span>

                <h4 id="selectedDate">
                    Select Date
                </h4>

                <h4 id="selectedTime">
                    01:45 PM
                </h4>

            </div>

            <div class="divider"></div>

            <div class="total">

                <span>TOTAL INVESTMENT</span>

                <h2>
                    {{ $price }}
                </h2>

            </div>

            <form
                id="bookingForm"
                action="{{ route('proses.booking') }}"
                method="POST">
                @csrf

                <input
                    type="hidden"
                    name="service"
                    value="{{ $service }}">

                <input
                    type="hidden"
                    name="price"
                    value="{{ $price }}">

                <input
                    type="hidden"
                    name="artisan"
                    value="{{ $artisan }}">

                <input
                    type="hidden"
                    name="tanggal"
                    id="inputTanggal">

                <input
                    type="hidden"
                    name="jam"
                    id="inputJam">

                <button type="submit" class="confirm">
                    CONFIRM APPOINTMENT
                </button>

            </form>

        </div>

    </div>

</section>

<footer class="footer-tgl">

    <div class="footer-content-tgl">

        <h2>
            Ready to Elevate Your Look?
        </h2>

        <p>
            Book your appointment today and experience precision grooming 
            crafted for modern gentlemen.
        </p>

    </div>

    <div class="footer-bottom-tgl">

        <p>© 2024 THE ATELIER</p>

        <div class="footer-links-tgl">

            <a href="#">INSTAGRAM</a>
            <a href="#">FACEBOOK</a>
            <a href="#">TWITTER</a>

        </div>

    </div>

</footer>

<script>

let currentDate = new Date();

function renderCalendar(date) {

    const grid =
    document.getElementById("calendarGrid");

    const monthYear =
    document.getElementById("monthYear");

    grid.innerHTML = "";

    const year = date.getFullYear();

    const month = date.getMonth();

    const months = [
        "JANUARY","FEBRUARY","MARCH","APRIL",
        "MAY","JUNE","JULY","AUGUST",
        "SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER"
    ];

    monthYear.innerText =
    months[month] + " " + year;

    const firstDay =
    new Date(year, month, 1).getDay();

    const daysInMonth =
    new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < firstDay; i++) {

        const empty =
        document.createElement("span");

        grid.appendChild(empty);
    }

    for (let day = 1; day <= daysInMonth; day++) {

        const span =
        document.createElement("span");

        span.innerText = day;

        span.onclick = () => {

            document
            .querySelectorAll(".calendar-grid span")
            .forEach(d => d.classList.remove("active"));

            span.classList.add("active");

            document
            .getElementById("selectedDate")
            .innerText =
            day + " " + months[month] + " " + year;

            const fixMonth =
            String(month + 1).padStart(2, '0');

            const fixDay =
            String(day).padStart(2, '0');

            document
            .getElementById("inputTanggal")
            .value =
            year + "-" + fixMonth + "-" + fixDay;
        };

        grid.appendChild(span);
    }
}

document.getElementById("prevMonth").onclick = () => {

    currentDate.setMonth(
        currentDate.getMonth() - 1
    );

    renderCalendar(currentDate);
};

document.getElementById("nextMonth").onclick = () => {

    currentDate.setMonth(
        currentDate.getMonth() + 1
    );

    renderCalendar(currentDate);
};

document.querySelectorAll(".time-list button")
.forEach(btn => {

    btn.onclick = () => {

        document
        .querySelectorAll(".time-list button")
        .forEach(b => b.classList.remove("active"));

        btn.classList.add("active");

        document
        .getElementById("selectedTime")
        .innerText = btn.innerText;

        document
        .getElementById("inputJam")
        .value = btn.innerText;
    }
});

document
.getElementById("bookingForm")
.addEventListener("submit", function(e){

    const tanggal =
    document.getElementById("inputTanggal").value;

    const jam =
    document.getElementById("inputJam").value;

    if(!tanggal || !jam){

        e.preventDefault();

        alert(
            "Pilih tanggal dan jam terlebih dahulu"
        );
    }
});

renderCalendar(currentDate);

document.getElementById("inputJam").value =
"01:45 PM";

</script>

</body>
</html>