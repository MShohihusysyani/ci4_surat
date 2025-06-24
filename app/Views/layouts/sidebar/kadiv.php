<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
  <div>
    <div class="logo-wrapper"><a href="<?= base_url("/") ?>"><img class="img-fluid for-light" src="<?= base_url() ?>/assets/images/mso.png" alt="" width="65" height="65"><img class="img-fluid for-dark" src="<?= base_url() ?>/assets/images/mso.png" alt="" width="65" height="65"></a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="<?= base_url("/") ?>"><img class="img-fluid" src="<?= base_url() ?>/assets/images/mso.png" alt="" width="65" height="65"></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn"><a href="<?= base_url("/") ?>"><img class="img-fluid" src="<?= base_url() ?>/assets/images/mso.png" alt="" width="65" height="65"></a>
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
          </li>
          <li class="pin-title sidebar-main-title">
            <div>
              <h6>Pinned</h6>
            </div>
          </li>
          <li class="sidebar-main-title">
            <div>
              <h6 class="lan-1">General</h6>
            </div>
          </li>
          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
            <label class="badge badge-light-primary"></label><a class="sidebar-link sidebar-title link-nav" href="<?= base_url('/home') ?>">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#fill-home"></use>
              </svg><span class="lan-3">Dashboard</span></a>
          </li>
          <li class="sidebar-main-title">
            <div>
              <h6 class="">Kelola Data</h6>
            </div>
          </li>
          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-email"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#fill-email"></use>
              </svg><span>Surat</span></a>
            <ul class="sidebar-submenu">
              <li><a href="<?= base_url("kadiv/surat-masuk") ?>">Surat Masuk</a></li>
              <li><a href="<?= base_url("kadiv/surat-keluar") ?>">Surat Keluar</a></li>
              <li><a href="<?= base_url("kadiv/surat-tugas") ?>">Surat Tugas</a></li>
            </ul>
          </li>

          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-email"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#fill-email"></use>
              </svg><span>Tambah Surat</span></a>
            <ul class="sidebar-submenu">
              <li><a href="<?= base_url("suratmasuk") ?>">Surat Masuk</a></li>
              <li><a href="<?= base_url("suratkeluar") ?>">Surat Keluar</a></li>
            </ul>
          </li>
          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-email"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#fill-email"></use>
              </svg><span>Laporan</span></a>
            <ul class="sidebar-submenu">
              <li><a href="<?= base_url("laporan/surat-masuk") ?>">Surat Masuk</a></li>
              <li><a href="<?= base_url("laporan/surat-keluar") ?>">Surat Keluar</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>