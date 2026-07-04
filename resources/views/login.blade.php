<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Hartono Login</title>
    <link rel="stylesheet" href="style1.css">
    <script src="script.js" defer></script>
</head>
<body>

<section class="login-page">

    <div class="overlay"></div>

    <div class="brand">
        <h2>Onyx & Ember</h2>
        <p>EST. MMXXIV</p>
    </div>

    <div class="left-content">
        <h1>Join the <span>Elite.</span></h1>
        <p>
            Become a member of the Atelier for exclusive rewards and seamless bookings.
            Experience the pinnacle of grooming craftsmanship.
        </p>
        <small>MR. HARTONO BARBERSHOP</small>
    </div>

    <div class="login-box">
    <h3>Sign In</h3>

    <button class="google-btn">
        G Sign in with Google
    </button>

    <p class="divider">OR CONTINUE WITH</p>

    <form action="{{ route('proses.login') }}" method="POST">
    @csrf
        <input 
            type="email" 
            name="email"
            placeholder="Email Address"
            required
        >

        <input 
            type="password" 
            name="password"
            placeholder="Password"
            required
        >

        <button type="submit" class="login-btn">
            LOGIN WITH EMAIL
        </button>

    </form>

    <div class="links-member">
        <a href="#">Forgot password?</a>

        <a href="#"
        onclick="window.parent.document.getElementById('popupFrame').src='{{ route('create') }}'"
        class="highlight">
            Create Account
        </a>
    </div>

    <p class="secure">Secured by the Atelier Protocol</p>
    </div>
</section>
</body>
</html>