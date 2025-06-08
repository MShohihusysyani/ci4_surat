<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
  <div>
    <div class="logo-wrapper"><a href="<?= base_url("/") ?>"><img class="img-fluid for-light" src="<?= base_url() ?>/assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark" src="<?= base_url() ?>/assets/images/logo/logo_dark.png" alt=""></a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="<?= base_url("/") ?>"><img class="img-fluid" src="<?= base_url() ?>/assets/images/logo/logo-icon.png" alt=""></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn"><a href="<?= base_url("/") ?>"><img class="img-fluid" src="<?= base_url() ?>/assets/images/logo/logo-icon.png" alt=""></a>
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
              <h6 class="lan-8">Kelola Data</h6>
            </div>
          </li>
          <!-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
            <label class="badge badge-light-secondary"></label><a class="sidebar-link sidebar-title" href="#">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-file"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#fill-file"></use>
              </svg> <span> Kelola Data </span> </a>
            <ul class="sidebar-submenu">
              <li><a href="<?= base_url("kelola/role") ?>">Data Role</a></li>
              <li><a href="<?= base_url("kelola/user") ?>">Data User</a></li>
              <li><a href="<?= base_url("kelola/jabatan") ?>">Data Jabatan</a></li>
              <li><a href="<?= base_url("kelola/karyawan") ?>">Data Karyawan</a></li>
              <li><a href="<?= base_url("kelola/perusahaan") ?>">Data Perusahaan</a></li>
              <li><a href="<?= base_url("kelola/produk") ?>">Data Produk</a></li>
              <li><a href="<?= base_url("kelola/klien") ?>">Data Klien</a></li>
              <li><a href="<?= base_url("kelola/klien-produk") ?>">Data Klien Produk</a></li>
              <li><a href="<?= base_url("projects/project-create") ?>">Data Struktur Organisasi</a></li>
            </ul>
          </li> -->
          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-email"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#fill-email"></use>
              </svg><span>Surat</span></a>
            <ul class="sidebar-submenu">
              <li><a href="<?= base_url("surat-masuk/sekretaris") ?>">Surat Masuk</a></li>
              <li><a href="<?= base_url("email/email-compose") ?>">Surat Keluar</a></li>
            </ul>
          </li>

          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-user"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#fill-user"></use>
              </svg><span>Users</span></a>
            <ul class="sidebar-submenu">
              <li><a href="<?= base_url("user/user-profile") ?>">Users Profile</a></li>
              <li><a href="<?= base_url("user/edit-profile") ?>">Users Edit</a></li>
              <li><a href="<?= base_url("user/user-cards") ?>">Users Cards</a></li>
            </ul>
          </li>
          <li class="sidebar-main-title">
            <div>
              <h6>Forms & Table</h6>
            </div>
          </li>
          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-form"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#fill-form"> </use>
              </svg><span>Forms</span></a>
            <ul class="sidebar-submenu">
              <li><a class="submenu-title" href="#">Form Controls<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                <ul class="nav-sub-childmenu submenu-content">
                  <li><a href="<?= base_url("forms/form-validation") ?>">Form Validation</a></li>
                  <li><a href="<?= base_url("forms/base-input") ?>">Base Inputs</a></li>
                  <li><a href="<?= base_url("forms/radio-checkbox-control") ?>">Checkbox & Radio</a></li>
                  <li><a href="<?= base_url("forms/input-group") ?>">Input Groups</a></li>
                  <li><a href="<?= base_url("forms/megaoptions") ?>">Mega Options</a></li>
                </ul>
              </li>
              <li><a class="submenu-title" href="#">Form Widgets<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                <ul class="nav-sub-childmenu submenu-content">
                  <li><a href="<?= base_url("forms/datepicker") ?>">Datepicker</a></li>
                  <li><a href="<?= base_url("forms/time-picker") ?>">Timepicker</a></li>
                  <li><a href="<?= base_url("forms/datetimepicker") ?>">Datetimepicker</a></li>
                  <li><a href="<?= base_url("forms/daterangepicker") ?>">Daterangepicker</a></li>
                  <li><a href="<?= base_url("forms/touchspin") ?>">Touchspin</a></li>
                  <li><a href="<?= base_url("forms/select2") ?>">Select2</a></li>
                  <li><a href="<?= base_url("forms/switch") ?>">Switch</a></li>
                  <li><a href="<?= base_url("forms/typeahead") ?>">Typeahead</a></li>
                  <li><a href="<?= base_url("forms/clipboard") ?>">Clipboard</a></li>
                </ul>
              </li>
              <li><a class="submenu-title" href="#">Form layout<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                <ul class="nav-sub-childmenu submenu-content">
                  <li><a href="<?= base_url("forms/default-form") ?>">Default Forms</a></li>
                  <li><a href="<?= base_url("forms/form-wizard") ?>">Form Wizard 1</a></li>
                  <li><a href="<?= base_url("forms/second-form-wizard") ?>">Form Wizard 2</a></li>
                  <li><a href="<?= base_url("forms/third-form-wizard") ?>">Form Wizard 3</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
              <svg class="stroke-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-table"></use>
              </svg>
              <svg class="fill-icon">
                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#fill-table"></use>
              </svg><span>Tables</span></a>
            <ul class="sidebar-submenu">
              <li><a class="submenu-title" href="#">Bootstrap Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                <ul class="nav-sub-childmenu submenu-content">
                  <li><a href="<?= base_url("tables/bootstrap-basic-table") ?>">Basic Tables</a></li>
                  <li><a href="<?= base_url("tables/table-components") ?>">Table components</a></li>
                </ul>
              </li>
              <li><a class="submenu-title" href="#">Data Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                <ul class="nav-sub-childmenu submenu-content">
                  <li><a href="<?= base_url("tables/datatable-basic-init") ?>">Basic Init</a></li>
                  <li><a href="<?= base_url("tables/datatable-API") ?>">API</a></li>
                  <li><a href="<?= base_url("tables/datatable-data-source") ?>">Data Sources</a></li>
                </ul>
              </li>
              <li><a href="<?= base_url("tables/datatable-ext-autofill") ?>">Ex. Data Tables</a></li>
              <li><a href="<?= base_url("tables/jsgrid-table") ?>">Js Grid Table </a></li>
            </ul>
          </li>


        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>