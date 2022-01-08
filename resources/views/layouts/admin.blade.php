<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-CART</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('theme/vendors/mdi/css/materialdesignicons.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('theme/vendors/base/vendor.bundle.base.css') }}"> --}}
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('theme/css/prism.css') }}">

    <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">

    <!-- endinject -->
    {{-- <link rel="shortcut icon" href="images/favicon.png" /> --}}

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_horizontal-navbar.html -->
        <div class="horizontal-menu">
            <nav class="navbar top-navbar col-lg-12 col-12 p-0">
                <div class="container-fluid">
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item dropdown d-lg-flex d-none">
                                <a type="button" class="btn btn-inverse-primary btn-sm">Logout</a>
                            </li>
                            <li class="nav-item nav-profile dropdown">
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="profileDropdown">
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-settings text-primary"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-logout text-primary"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <nav class="bottom-navbar">
                <div class="container">
                    <ul class="nav page-navigation">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <i class="mdi mdi-file-document-box menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-cube-outline menu-icon"></i>
                                <span class="menu-title">Products</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('product.create') }}">Create Products</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('product.index') }}">All Produts</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-cube-outline menu-icon"></i>
                                <span class="menu-title">Category</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('category.create') }}">Create Category</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('category.index') }}">All Category</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-cube-outline menu-icon"></i>
                                <span class="menu-title">Banner</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('banner.create') }}">Create Banner</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('banner.index') }}">All Banner</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-cube-outline menu-icon"></i>
                                <span class="menu-title">wishlist</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('wishlist.create') }}">Create Banner</a></li>
                                    {{-- <li class="nav-item"><a class="nav-link"
                                            href="{{ route('wishlist.index') }}">All Banner</a></li> --}}
                                </ul>
                            </div>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="pages/forms/basic_elements.html" class="nav-link">
                                <i class="mdi mdi-chart-areaspline menu-icon"></i>
                                <span class="menu-title">Form Elements</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/charts/chartjs.html" class="nav-link">
                                <i class="mdi mdi-finance menu-icon"></i>
                                <span class="menu-title">Charts</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/basic-table.html" class="nav-link">
                                <i class="mdi mdi-grid menu-icon"></i>
                                <span class="menu-title">Tables</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/icons/mdi.html" class="nav-link">
                                <i class="mdi mdi-emoticon menu-icon"></i>
                                <span class="menu-title">Icons</span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="mdi mdi-codepen menu-icon"></i>
                                <span class="menu-title">Sample Pages</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <li class="nav-item"><a class="nav-link"
                                            href="pages/samples/login.html">Login</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="pages/samples/login-2.html">Login 2</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="pages/samples/register.html">Register</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="pages/samples/register-2.html">Register 2</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="pages/samples/lock-screen.html">Lockscreen</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="docs/documentation.html" class="nav-link">
                                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                                <span class="menu-title">Documentation</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="footer-wrap">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                                ssBrother's.com 2021</span>
                            {{-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                                    href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard
                                    templates</a> from Bootstrapdash.com</span> --}}
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- base:js -->
    <script src="{{ asset('theme/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('theme/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="{{ asset('theme/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ asset('theme/vendors/justgage/raphael-2.1.4.min.js') }}"></script>
    <script src="{{ asset('theme/vendors/justgage/justgage.js') }}"></script>
    <!-- Custom js for this page-->
    <script src="{{ asset('theme/js/prism.js')}}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}" ></script>
    <!-- End custom js for this page-->
</body>

</html>
