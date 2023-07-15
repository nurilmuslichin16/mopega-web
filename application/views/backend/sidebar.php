<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/dashboard'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-globe"></i>
        </div>
        <div class="sidebar-brand-text mx-3">M O P E G A</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('admin/dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Gangguan
    </div>

    <?php
    $aktif = false;
    if ($this->uri->segment(2) == 'gangguan') {
        if ($this->uri->segment(3) != 'cetak' && $this->uri->segment(3) != 'track') {
            $aktif = true;
        }
    }
    ?>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= $aktif ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('admin/gangguan'); ?>">
            <i class="fas fa-bars"></i>
            <span>Daftar Laporan</span></a>
    </li>

    <li class="nav-item <?= $this->uri->segment(3) == 'cetak' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('admin/gangguan/cetak'); ?>">
            <i class="fas fa-file-excel"></i>
            <span>Cetak Laporan</span></a>
    </li>

    <li class="nav-item <?= $this->uri->segment(3) == 'track' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('admin/gangguan/track'); ?>">
            <i class="fas fa-eye"></i>
            <span>Track Gangguan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= $this->uri->segment(2) == 'pelanggan' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('admin/pelanggan'); ?>">
            <i class="fas fa-database"></i>
            <span>Data Pelanggan</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?= $this->uri->segment(2) == 'teknisi' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url('admin/teknisi'); ?>">
            <i class="fas fa-users"></i>
            <span>Data Teknisi</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin logout?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih tombol logout jika ingin keluar dari aplikasi.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>