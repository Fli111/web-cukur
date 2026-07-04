<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - The Atelier</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="style1.css">
</head>

<body>

<section class="register-page-create">

    <div class="overlay-create"></div>

    <div class="left-side-create">

        <div class="logo-create">
            <h1>THE ATELIER</h1>
            <p>ESTABLISHED IN EXCELLENCE</p>
        </div>

        <div class="content-create">

            <span class="tag-create">
                MEMBERSHIP
            </span>

            <h2>
                Define Your <br>
                <span>Legacy</span> With Us.
            </h2>

            <div class="line-create"></div>

            <p class="description-create">
                Join an exclusive community where precision meets heritage.
                Your seat in the atelier awaits the discerning modern gentleman.
            </p>

            <div class="quote-box-create">

                <img src="img/hero.jpeg" alt="">

                <div>

                    <h3>
                        "The cut is just the beginning."
                    </h3>

                    <p>
                        MASTER BARBER, ONYX & EMBER
                    </p>

                </div>

            </div>

            <small>
                PRECISION . CHARACTER . LEGACY .
            </small>

        </div>

    </div>

    <div class="register-box-create">

        <h2>Create Account</h2>

        <p class="subtitle-create">
            STEP INTO THE MODERN ATELIER
        </p>

        <form action="{{ route('proses.register') }}" method="POST">
        @csrf

            <button
                type="button"
                class="google-btn-create"
            >
                G SIGN UP WITH GOOGLE
            </button>

            <p class="divider-create">
                OR USE EMAIL
            </p>

            <label>FULL NAME</label>

            <input
                type="text"
                name="nama"
                placeholder="ALEXANDER VANE"
                required
            >

            <label>EMAIL ADDRESS</label>

            <input
                type="email"
                name="email"
                placeholder="AVANE@ATELIER.COM"
                required
            >

            <label>PASSWORD</label>

            <input
                type="password"
                name="password"
                placeholder="••••••••"
                required
            >

            <button
                type="submit"
                name="register"
                class="create-btn-create"
            >
                CREATE ACCOUNT
            </button>

        </form>

        <p class="signin-text-create">

            ALREADY A MEMBER?

            <a href="#"
            onclick="window.parent.document.getElementById('popupFrame').src='login.php'">
                SIGN IN
            </a>
        </p>

    </div>

</section>

</body>
</html>