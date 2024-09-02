<style>
    
    body.dark .header-navbar .header-left .theme-switch-icon::before {

    color: #ffffff;
    content: "";
    font-family: Font Awesome 5 Free;
    margin-top: 20px;
    }
</style>
<header class="header-navbar fixed">
    <div class="toggle-mobile action-toggle"><i class="fas fa-bars"></i></div>
    <div class="header-wrapper">
        <div class="header-left">
            <div class="theme-switch-icon" style="display: none"></div>
            <h5 style="font-size: 20px;margin-bottom: 0px;font-weight: 600;text-transform:uppercase;margin-left: 290px">aplikasi persediaan barang bnnp sumatera selatan</h5>
        </div>
        <div class="header-content">
            @if (Auth::user()->rules_id == 1)
                <div class="notification dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span class="badge">{{ $notif_permintaan + $notif_user }}</span>
                    </a>
                    @if ($all_notif > 0)
                        <ul class="dropdown-menu medium">
                            <li class="menu-header">
                                <a class="dropdown-item" href="#">Notification</a>
                            </li>
                            <li class="menu-content ps-menu">
                                @if ($notif_permintaan > 0)
                                    <a href="/permintaan-barang/sapras">
                                        <div class="message-icon text-danger">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="message-content">
                                            <div class="body">
                                                ada permintaan barang yang ingin disetujui nii!!
                                            </div>
                                        </div>
                                    </a>
                                @endif
                                
                                @if ($notif_user > 0)
                                    <a href="/user-inactive">
                                        <div class="message-icon text-success">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="message-content">
                                            <div class="body">
                                                ada orang yang baru daftar nii!!
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    @endif
                </div>
            @endif
            <div class="dropdown dropdown-menu-end">
                <a href="#" class="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="label">
                        <span></span>
                        <div>{{ Auth::user()->name }}</div>
                    </div>
                    <img class="img-user" src="{{ asset('./assets/images/avatar1.png') }}" alt="user"srcset="">
                </a>
                <ul class="dropdown-menu small">
                    <!-- <li class="menu-header">
                        <a class="dropdown-item" href="#">Notifikasi</a>
                    </li> -->
                    <li class="menu-content ps-menu">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="description">
                                <i class="ti-settings"></i> Setting
                            </div>
                        </a>
                        <a href="{{ route('logout') }}">
                            <div class="description">
                                <i class="ti-power-off"></i> Logout
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</header>
<nav class="main-sidebar ps-menu">
    <div class="sidebar-toggle action-toggle">
        <a href="#">
            <i class="fas fa-bars"></i>
        </a>
    </div>
    <div class="sidebar-opener action-toggle">
        <a href="#">
            <i class="ti-angle-right"></i>
        </a>
    </div>
    <div class="sidebar-header">
        <div class="text">
            <img src="{{ asset('./assets/images/bnn.png') }}" style="margin-left: 50px" width="80" alt="">
        </div>
        <div class="close-sidebar action-toggle">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>          
            <li>
                <a href="/dashboard" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->rules_id == 1)
            <li>
                <a href="/barang_masuk" class="link">
                    <i class="ti-package"></i>
                    <span>Barang Masuk</span>
                </a>
            </li>
            <li>
                <a href="#" class="main-menu has-dropdown">
                    <i class="ti-write"></i>
                    <span>Permintaan</span>
                </a>
                <ul class="sub-menu ">
                    <li><a href="{{ route('permintaan-sapras') }}" class="link"><span>Permintaan Barang</span></a></li>
                    <li><a href="/permintaan-barang-keluar" class="link"><span>Data Permintaan Barang</span></a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="main-menu has-dropdown">
                    <i class="ti-user"></i>
                    <span>Data Barang</span>
                </a>
                <ul class="sub-menu ">
                    <li><a href="/barang" class="link">
                        <span>Data Barang</span></a>
                    </li>
                    <li><a href="/kategori" class="link">
                        <span>Data Kategori</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="main-menu has-dropdown">
                    <i class="ti-files"></i>
                    <span>Laporan</span>
                </a>
                <ul class="sub-menu ">
                    <li><a href="/laporan-barang" class="link"><span>Barang</span></a></li>
                    <li><a href="/laporan-barang-masuk" class="link"><span>Barang Masuk</span></a></li>
                    <li><a href="/laporan-barang-keluar" class="link"><span>Barang Keluar</span></a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="main-menu has-dropdown">
                    <i class="ti-user"></i>
                    <span>Pengguna Sistem</span>
                </a>
                <ul class="sub-menu ">
                    <li><a href="/user-inactive" class="link">
                        <span>User Inactive</span></a>
                    </li>
                    <li><a href="/user-active" class="link">
                            <span>User Active</span></a>
                    </li>
                </ul>
            </li>
            @elseif(Auth::user()->rules_id == 2)
                <li>
                    <a href="/permintaan-barang" class="link">
                        <i class="ti-write"></i>
                        <span>Permintaan Barang</span>
                    </a>
                </li>
                <li>
                    <a href="/barang" class="link">
                        <i class="ti-package"></i>
                        <span>Data Barang</span>
                    </a>
                </li>
                <li>
                    <a href="/cetak-permintaan" class="link">
                        <i class="ti-printer"></i>
                        <span>Cetak Permintaan</span>
                    </a>
                </li>
                @else
                <li>
                    <a href="#" class="main-menu has-dropdown">
                        <i class="ti-desktop"></i>
                        <span>Laporan</span>
                    </a>
                    <ul class="sub-menu ">
                        <li><a href="/laporan-barang" class="link"><span>Barang</span></a></li>
                        <li><a href="/laporan-barang-masuk" class="link"><span>Barang Masuk</span></a></li>
                        <li><a href="/laporan-barang-keluar" class="link"><span>Barang Keluar</span></a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>    

                        <div class="modal fade" id="exampleModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Setting</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="user-update/{{ Auth::user()->id }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="basicInput" class="form-label">Change Name</label>
                                                        <input class="form-control" name="name" type="text" placeholder="" value="{{ Auth::user()->name }}"
                                                            aria-label="default input example">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="mb-2 text-muted" for="email">Change Password</label>
                                                    <div class="input-group input-group-join mb-3">
                                                        <input type="password" class="form-control" name="password" placeholder="Your password" value="">
                                                        <span class="input-group-text rounded-end password cursor-pointer">&nbsp<i class="fa fa-eye"></i>&nbsp</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
