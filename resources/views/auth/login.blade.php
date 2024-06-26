
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset ('/images/logo1.png') }}">
  <title>
    Pengaduan Masyarakat
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset ('backend/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset ('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset ('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset ('backend/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
  <style>
    .page-header {
      /* Background properties */
      background-image: url('{{ asset('/images/background.jpg') }}');
      background-size: cover; /* Adjust as needed */
      background-position: center; /* Adjust as needed */
    }
  </style>
    <style>
        .card {
        background-color: #fff; /* Warna latar belakang kartu */
        border-radius: 10px; /* Mengatur sudut bulat kartu */
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek angkat */
        padding: 20px; /* Padding dalam kartu */
        }
    
        .card-header {
        border-bottom: 1px solid #f0f0f0; /* Garis bawah untuk header kartu */
        padding-bottom: 15px; /* Ruang di bawah header */
        }
    </style>
    
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto justify-content-center">
                    <div class="card" style="background-color: rgba(255, 255, 255, 0.9);"> <!-- Gunakan nilai RGBA -->
                      <div class="card-header pb-0 text-start">
                        <h4 class="font-weight-bolder text-center">Sign In</h4>
                        <p class="mb-0 text-center"style="font-size: 13px">Enter your email and password to sign in</p>
                      </div>
                      <div class="card-body">
                        <form id="loginForm" method="POST" action="{{ route('login') }}">
                          @csrf <!-- CSRF Token -->
                          <div class="mb-3">
                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email">
                          </div>
                          <div class="mb-3">
                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password">
                          </div>
                          <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg btn-primary w-100">Sign in</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>                  
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="{{ asset ('backend/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset ('backend/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset ('backend/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset ('backend/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset ('backend/assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
</body>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent default form submission
  
      // You can add AJAX submission or any other logic here
      // Example: Submitting via AJAX
      var formData = new FormData(this);
      fetch(this.action, {
          method: 'POST',
          body: formData
        })
        .then(response => {
          if (response.ok) {
            // Handle successful login
            window.location.href = '{{ route("dashboard") }}'; // Redirect to dashboard or any other page
          } else {
            // Handle failed login
            // Display error message or take appropriate action
          }
        })
        .catch(error => {
          console.error('Error:', error);
          // Handle error
        });
    });
  </script>

</html>