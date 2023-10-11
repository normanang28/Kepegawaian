<span class="app-brand-text demo menu-text fw-bolder ms-2 text-center" style="font-size: 25px;">Kepegawaian</span>
</a>

<a class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
  <i class="bx bx-chevron-left bx-sm align-middle"></i>
</a>
</div>

<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">
  <?php  if(session()->get('id')>0) { ?>
    <li class="menu-item">
      <a href="<?= base_url('/home/dashboard')?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>
  <?php }else{} ?>
  <?php  if(session()->get('level')== 1) { ?>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">User Kepegawaian</span>
    </li>
    <li class="menu-item ">
      <a href="<?= base_url('/home/pegawaian')?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Layouts">Pegawaian</div>
      </a>
    </li>
  <?php }else{} ?>
  <?php  if(session()->get('level')== 1) { ?>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Jabatan Kepegawaian</span>
    </li>
    <li class="menu-item">
      <a href="<?= base_url('/home/jabatan')?>" class="menu-link">
        <i class='menu-icon bx bxs-component'></i>
        <div data-i18n="Account Settings">Jabatan</div>
      </a>
    </li>
  <?php }else{} ?>
  <?php  if(session()->get('level')== 2 || session()->get('level')== 3) { ?>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Kepegawaian</span>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-line-chart"></i>
        <div data-i18n="Account Settings">Kepegawaian</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="<?= base_url('/home/absensi_pegawai')?>" class="menu-link">
            <div data-i18n="Account">Absensi</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?= base_url('/home/agenda')?>" class="menu-link">
            <div data-i18n="Notifications">Agenda</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?= base_url('/home/pengajian_pegawai')?>" class="menu-link">
            <div data-i18n="Connections">Pengajian</div>
          </a>
        </li>
      </ul>
    </li>
  <?php }else{} ?>
  <?php  if(session()->get('level')== 2) { ?>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Laporan Kepegawaian</span>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-book-content"></i>
        <div data-i18n="Account Settings">Laporan</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="<?= base_url('/home/absensi_pegawai_laporan')?>" class="menu-link">
            <div data-i18n="Account">Laporan Absensi</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?= base_url('/home/agenda_laporan')?>" class="menu-link">
            <div data-i18n="Notifications">Laporan Agenda</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="<?= base_url('/home/pengajian_pegawai_laporan')?>" class="menu-link">
            <div data-i18n="Connections">Laporan Pengajian</div>
          </a>
        </li>
      </ul>
    </li>
  <?php }else{} ?>
</ul>
</aside>
<!-- / Menu -->

<!-- Layout container -->
<div class="layout-page">
  <!-- Navbar -->

  <nav
  class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar"
  >
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <!-- <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search fs-4 lh-0"></i>
        <input
        type="text"
        class="form-control border-0 shadow-none"
        placeholder="Search..."
        aria-label="Search..."
        />
      </div> -->
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <!-- Place this tag where you want the button to render. -->
      <li class="nav-item lh-1 me-3">
        <span class="fw-semibold d-block text-capitalize"><?= session()->get('nama_pegawai')?></span>
      </li>

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <?php if($foto->foto != '' && file_exists(PUBLIC_PATH."/images/profile/".$foto->foto)) { ?>
              <img src="<?= base_url('/images/profile/'.$foto->foto)?>" alt class="w-px-40 h-auto rounded-circle" />
            <?php }else{ ?>
              <img src="<?= base_url('/images/profile/default-profile-photo.jpg')?>" alt class="w-px-40 h-auto rounded-circle" />
            <?php } ?>
            <!-- <img src="<?= base_url('../assets/img/avatars/1.png')?>" alt class="w-px-40 h-auto rounded-circle" /> -->
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <?php if($foto->foto != '' && file_exists(PUBLIC_PATH."/images/profile/".$foto->foto)) { ?>
                      <img src="<?= base_url('/images/profile/'.$foto->foto)?>" alt class="w-px-40 h-auto rounded-circle" />
                    <?php }else{ ?>
                      <img src="<?= base_url('/images/profile/default-profile-photo.jpg')?>" alt class="w-px-40 h-auto rounded-circle" />
                    <?php } ?>
                    <!-- <img src="<?= base_url('../assets/img/avatars/1.png')?>" alt class="w-px-40 h-auto rounded-circle" /> -->
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block text-capitalize"><?= session()->get('nama_pegawai')?></span>
                  <small class="text-muted">Level : <?= session()->get('level')?></small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="<?= base_url('/home/ganti_profile')?>">
              <i class="bx bx-user me-2"></i>
              <span class="align-middle">My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="<?= base_url('/home/ganti_password')?>">
              <i class="bx bx-cog me-2"></i>
              <span class="align-middle">Password</span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="<?= base_url('/home/log_out')?>">
              <i class="bx bx-power-off me-2 text-danger"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>


<div class="content-wrapper">

  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
          </div>
        </div>
      </div>
    </div>
