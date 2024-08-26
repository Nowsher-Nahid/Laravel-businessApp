<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify Email</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f8f9fa;
    }
    .container {
      text-align: center;
    }
    .logo {
      max-width: 200px;
      margin-bottom: 1.5rem; /* Space between logo and card */
    }
    .card {
      max-width: 500px;
      width: 100%;
      padding: 2rem;
      border-radius: 1rem;
      margin-top: -1.5rem; /* Pulls card up, so it overlaps slightly with the logo */
    }
    .card-title {
      font-size: 2rem;
      margin-bottom: 1rem;
    }
    .card-text {
      font-size: 1.25rem;
      margin-bottom: 1.5rem;
    }
    .btn {
      font-size: 1.125rem;
      padding: 0.75rem 1.5rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="{{ asset('assets/images/logo.jpg') }}" alt="Logo" class="logo">
    <div class="card text-center shadow-lg mt-2">
      <div class="card-body">
        <h5 class="card-title">Verify Your Email</h5>
        <p class="card-text">An email has been sent to you with a link to verify your account. Please check your inbox and follow the instructions.</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
