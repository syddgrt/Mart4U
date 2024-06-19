<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Mart4U</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href={{asset("/assets/img/favicon.png")}} rel="icon">
  <link href={{asset("/assets/img/apple-touch-icon.png")}} rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href={{asset("https://fonts.gstatic.com")}} rel="preconnect">
  <link href={{asset("https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i")}} rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href={{asset("/assets/vendor/bootstrap/css/bootstrap.min.css")}} rel="stylesheet">
  <link href={{asset("/assets/vendor/bootstrap-icons/bootstrap-icons.css")}} rel="stylesheet">
  <link href={{asset("/assets/vendor/boxicons/css/boxicons.min.css")}} rel="stylesheet">
  <link href={{asset("/assets/vendor/quill/quill.snow.css")}} rel="stylesheet">
  <link href={{asset("/assets/vendor/quill/quill.bubble.css")}} rel="stylesheet">
  <link href={{asset("/assets/vendor/remixicon/remixicon.css")}} rel="stylesheet">
  <link href={{asset("/assets/vendor/simple-datatables/style.css")}} rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href={{asset("/assets/css/style.css")}} rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
        <img src="/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" action="/stock/">
        <input type="text" name="search" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <!-- <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->email }}</span> -->
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->email }}</h6>
              <span>Admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/admin">
                <i class="bi bi-person"></i>
                <span>Admins</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            
            <li>
              <a class="dropdown-item d-flex align-items-center" href="/admin/{{ Auth::id() }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li> -->
            <!-- <li>
              <hr class="dropdown-divider">
            </li> -->

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/faqs">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <button type="button" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#signOutModal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </button>
            </li>



          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-heading">Main</li>

      <li class="nav-item">
        <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] != "/report") echo "collapsed"; ?>" href="/report">
          <i class="bx bxs-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->




      <!-- Start Stock Management Nav -->
      <li class="nav-item">
        <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] != "/stock") echo "collapsed"; ?>" href="/stock">
          <i class="bi bi-grid"></i>
          <span>Stock Management</span>
        </a>
        <!-- <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/listings/{listing}/edit">
              <i class="bi bi-circle"></i><span>Stock Management</span>
            </a>
          </li>
        </ul> -->
      </li>

      <!-- Start Announcement Nav -->
      <li class="nav-item">
        <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] != "/announcement") echo "collapsed"; ?>" href="/announcement">
          <i class="bx bxs-microphone-alt"></i>
          <span>Announcement</span>
        </a>
      </li>

      <!-- End Dashboard Nav -->

      

      <li class="nav-heading">Others</li>

      



      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li> -->
      <!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] != "/admin") echo "collapsed"; ?>" href="/admin">
          <i class="bi bi-person"></i>
          <span>Admin</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link <?php if ($_SERVER['REQUEST_URI'] != "/faqs") echo "collapsed"; ?>" href="/faqs">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li>
      <!-- End F.A.Q Page Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li> -->
      <!-- End Contact Page Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li> -->
      <!-- End Register Page Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li> -->
      <!-- End Login Page Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li> -->
      <!-- End Error 404 Page Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li> -->
      <!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main>
    {{$slot}}
  </main>

  <!-- Modal -->
  <div class="modal fade" id="signOutModal" tabindex="-1" aria-labelledby="signOutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="signOutModalLabel">Are you sure to sign out?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Press "Yes" to sign out.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <a href="/"><strong><span>{{ env('APP_NAME') }}</span></strong></a>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src={{asset("/assets/vendor/apexcharts/apexcharts.min.js")}}></script>
  <script src={{asset("/assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}></script>
  <script src={{asset("/assets/vendor/chart.js/chart.min.js")}}></script>
  <script src={{asset("/assets/vendor/echarts/echarts.min.js")}}></script>
  <script src={{asset("/assets/vendor/quill/quill.min.js")}}></script>
  <script src={{asset("/assets/vendor/simple-datatables/simple-datatables.js")}}></script>
  <script src={{asset("/assets/vendor/tinymce/tinymce.min.js")}}></script>
  <script src={{asset("/assets/vendor/php-email-form/validate.js")}}></script>

  <!-- Template Main JS File -->
  <script src={{asset("/assets/js/main.js")}}></script>

</body>

</html>