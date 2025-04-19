 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">
     <div class="d-flex align-items-center justify-content-between">
         <a href="#" class="logo d-flex align-items-center">
             <img src="{{ asset('assets/img/logo.png') }}" alt="">
             <span class="d-none d-lg-block">Spen.Admin</span>
         </a>
         <i class="bi bi-list toggle-sidebar-btn"></i>
     </div><!-- End Logo -->
     <nav class="header-nav ms-auto">
         <ul class="d-flex align-items-center">

             <li class="nav-item dropdown">
                 <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                     <i class="bi bi-bell"></i>
                     <span class="badge bg-primary badge-number" id="notification-count">
                         {{ auth()->user()->unreadNotifications->count() }}
                     </span>
                 </a><!-- End Notification Icon -->

                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications"
                     id="notification-container">
                     <li class="dropdown-header">
                         You have {{ auth()->user()->unreadNotifications->count() }} new notifications
                         <a href="{{ route('notifikasi.read.all') }}"><span
                                 class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                     </li>

                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     @foreach (auth()->user()->unreadNotifications as $notification)
                         <li class="notification-item">
                             <i class="bi bi-person-plus text-success"></i>
                             <a href="">
                                 <div>
                                     <h4 style="color: black">{{ $notification->data['title'] ?? 'Notifikasi Baru' }}
                                     </h4>
                                     <p>{{ $notification->data['body'] ?? '-' }}</p>
                                     <p>{{ $notification->data['jalur'] ?? '-' }}</p>
                                     <p class="text-muted small">
                                         {{ $notification->created_at->diffForHumans() }}
                                     </p>
                                 </div>
                             </a>
                         </li>
                         <li>
                             <hr class="dropdown-divider">
                         </li>
                     @endforeach

                     <li class="dropdown-footer">
                         <a href="" class="show-notif" data-bs-toggle="collapse" data-bs-target="#faqsTwo-1"
                             id="all-notif">Show all notifications</a>

                         <div id="faqsTwo-1" class="accordion-collapse collapse mt-3" data-bs-parent="#faq-group-2">
                             <div class="accordion-body px-2" style="max-height: 300px; overflow-y: auto;">
                                 @forelse (auth()->user()->notifications as $notif)
                                     <div class="border-bottom mb-2 pb-2">
                                         <div class="d-flex flex-column text-start">
                                             <div>
                                                 <strong>{{ $notif->data['title'] ?? 'Notifikasi' }}</strong><br>
                                                 <small class="text-muted">{{ $notif->data['body'] ?? '-' }}</small>
                                             </div>
                                             <small class="text-muted">
                                                 {{ $notif->data['jalur'] }}
                                             </small>
                                         </div>
                                     </div>
                                 @empty
                                     <p class="text-muted text-center">Tidak ada notifikasi.</p>
                                 @endforelse
                             </div>
                         </div>
                     </li>

                 </ul><!-- End Notification Dropdown Items -->
             </li><!-- End Notification Nav -->



             <li class="nav-item dropdown pe-3">

                 <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                     data-bs-toggle="dropdown">
                     <img src="{{ asset('assets/img/default_siswa.png') }}" alt="Profile" class="rounded-circle">
                     <span class="d-none d-md-block dropdown-toggle ps-2">{{ $data->name }}</span>
                 </a><!-- End Profile Iamge Icon -->

                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                     <li class="dropdown-header">
                         <h6>{{ $data->name }}</h6>
                         <span>{{ $data->role }}</span>
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
                         <a class="dropdown-item d-flex align-items-center" href="{{ route('logout-admin') }}">
                             <i class="bi bi-box-arrow-right"></i>
                             <span>Sign Out</span>
                         </a>
                     </li>

                 </ul><!-- End Profile Dropdown Items -->
             </li><!-- End Profile Nav -->

         </ul>
     </nav><!-- End Icons Navigation -->

 </header><!-- End Header -->
 <script>
     $(document).ready(function() {
         $('.dropdown-header a').on('click', function(e) {
             e.preventDefault();
             let href = $(this).attr('href');

             $.get(href, function() {

                 $('#notification-count').text('0');

                 $('.dropdown-header').html('You have 0 new notifications');

                 $('#notification-container .notification-item').remove();

                 $('#notification-container').append(`
                    <li class="notification-item text-center text-muted">
                        <p>Tidak ada notifikasi baru</p>
                    </li>
                `);
             });
         });

         $('.dropdown-footer .show-notif, .dropdown-footer .accordion-body').on('click', function(e) {
             e.stopPropagation();
         });
     });
 </script>
