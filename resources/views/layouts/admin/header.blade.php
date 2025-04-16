 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

     <div class="d-flex align-items-center justify-content-between">
         <a href="#" class="logo d-flex align-items-center">
             <img src="{{ asset('assets/img/logo.png') }}" alt="">
             <span class="d-none d-lg-block">NiceAdmin</span>
         </a>
         <i class="bi bi-list toggle-sidebar-btn"></i>
     </div><!-- End Logo -->

     <nav class="header-nav ms-auto">
         <ul class="d-flex align-items-center">

             <li class="nav-item d-block d-lg-none">
                 <a class="nav-link nav-icon search-bar-toggle " href="#">
                     <i class="bi bi-search"></i>
                 </a>
             </li><!-- End Search Icon-->

             <li class="nav-item dropdown">
                 <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                     <i class="bi bi-bell"></i>
                     <span class="badge bg-primary badge-number">
                         {{ auth()->user()->unreadNotifications->count() }}
                     </span>
                 </a><!-- End Notification Icon -->

                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                     <li class="dropdown-header">
                         You have {{ auth()->user()->unreadNotifications->count() }} new notifications
                         <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                     </li>

                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     @forelse(auth()->user()->unreadNotifications as $notification)
                         <li class="notification-item">
                             <i class="bi bi-person-plus text-success"></i>
                             <div>
                                 <h4>{{ $notification->data['title'] ?? 'Notifikasi Baru' }}</h4>
                                 <p>{{ $notification->data['body'] ?? '-' }}</p>
                                 <p class="text-muted small">
                                     {{ $notification->created_at->diffForHumans() }}
                                 </p>
                             </div>
                         </li>
                         <li>
                             <hr class="dropdown-divider">
                         </li>
                     @empty
                         <li class="notification-item text-center text-muted">
                             <p>Tidak ada notifikasi baru</p>
                         </li>
                     @endforelse

                     <li class="dropdown-footer">
                         <a href="#">Show all notifications</a>
                     </li>
                 </ul><!-- End Notification Dropdown Items -->
             </li><!-- End Notification Nav -->



             <li class="nav-item dropdown pe-3">

                 <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                     data-bs-toggle="dropdown">
                     <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                     <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                 </a><!-- End Profile Iamge Icon -->

                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                     <li class="dropdown-header">
                         <h6>Kevin Anderson</h6>
                         <span>Web Designer</span>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                             <i class="bi bi-person"></i>
                             <span>My Profile</span>
                         </a>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                             <i class="bi bi-gear"></i>
                             <span>Account Settings</span>
                         </a>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                             <i class="bi bi-question-circle"></i>
                             <span>Need Help?</span>
                         </a>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <a class="dropdown-item d-flex align-items-center" href="#">
                             <i class="bi bi-box-arrow-right"></i>
                             <span>Sign Out</span>
                         </a>
                     </li>

                 </ul><!-- End Profile Dropdown Items -->
             </li><!-- End Profile Nav -->

         </ul>
     </nav><!-- End Icons Navigation -->

 </header><!-- End Header -->
