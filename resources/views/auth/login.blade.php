<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin/assets/img/Fav Icon.svg')}}">
    <link rel="icon" type="image/png" href="{{asset('admin/assets/img/Fav Icon.svg')}}">
  <title>
    Kadeaus Admin
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('admin/assets/css/soft-ui-dashboard.css?v=1.2.0') }}" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="">
  <!-- Navbar -->
  <nav
    class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">
    <div class="container-fluid ms-5">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3text-white" href="#">
        <img src="{{ asset('admin/assets/img/Logo.svg') }}" alt="Kadeaus Admin" />
      </a>
    </div>
  </nav>
  <!-- End Navbar -->
  <main class="main-content  mt-0 ">
    <div class="page-header min-vh-100" style="background-image: url('admin/assets/img/signin-img.png');">
      <span class="mask bg-gradient-dark opacity-6 mt-0 pt-0"></span>
      <div class="container mt-5 pt-5">
        <div class="row justify-content-center ">
          <div class="col-lg-4 col-md-7">
            <div class="card">
              <div class="card-body px-lg-4 py-lg-5 text-center">

                <div class="text-start text-muted mb-4">
                  <h3>Welcome Back</h3>
                  <p>Enter your email and password to sign in</p>
                </div>
                <form action="{{ route('login') }}" method="POST" role="form" class="text-start">
                    @csrf
                  <div class="mb-3">
                    <label class="form-check-label opacity-6 font-weight-bold">Email</label>
                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"   @if(old('email')) value="{{ old('email') }}" @endif
                        aria-describedby="emailHelp" onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                  @error('email')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                  <div class="mb-3">
                    <label class="form-check-label opacity-6 font-weight-bold">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        onfocus="focused(this)"
                        onfocusout="defocused(this)" style=" border-radius: 0.375rem; ">                  
                    </div>
                  <div class="d-flex justify-content-between mt-3">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div>
                      <label class="form-check-label text-info font-weight-bold"
                        onclick="window.location.href = 'forgot-password.html'"> Forgot Password ? </label>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Sign in</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <!-- Kanban scripts -->
  <script src="{{ asset('admin/assets/js/plugins/dragula/dragula.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/plugins/jkanban/jkanban.js') }}"></script>
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
  <script src="{{ asset('admin/assets/js/soft-ui-dashboard.min.js?v=1.2.0') }}"></script>
</body>

</html>