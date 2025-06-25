<?= $this->extend('layouts/master') ?>

<?= $this->section('css') ?>
<style>
    /* .card.widget-1 {
        background: #ffffff;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0px 8px 24px rgba(149, 157, 165, 0.2);
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    } */

    /* .widget-content {
        display: flex;
        align-items: center;
        gap: 15px;
    } */

    /* .widget-round.secondary {
        background-color: #ffe5eb;
        color: #e63757;
    }

    .widget-round.primary {
        background-color: #e4e9ff;
        color: #4e5bff;
    } */

    .widget-round svg {
        width: 24px;
        height: 24px;
        fill: currentColor;
    }

    /* h4 {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
        color: #1d1d1f;
    } */

    /* .f-light {
        color: #6b6f76;
        font-size: 14px;
    } */

    .card.widget-1 {
        background-color: #ffffff;
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%'><defs><pattern id='curved-lines' patternUnits='userSpaceOnUse' width='200' height='200'><path d='M0,100 C100,0 100,200 200,100' fill='none' stroke='%23f0f0f5' stroke-width='1'/></pattern></defs><rect width='100%' height='100%' fill='url(%23curved-lines)'/></svg>");
        background-size: cover;
        border-radius: 20px;
        box-shadow: 0px 8px 24px rgba(149, 157, 165, 0.2);
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('main-content') ?>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Dashboard</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url("/") ?>">
                            <svg class="stroke-icon">
                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Default </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row widget-grid">
        <div class="col-xxl-6 col-sm-6 box-col-6">
            <div class="card profile-box">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <div class="greeting-user">
                                <h4 class="f-w-600">Selamat Datang <?= session()->get('nama_user') ?></h4>
                                <p>Here whats happing in your account today</p>
                                <div class="whatsnew-btn"><a class="btn btn-outline-white">Whats New !</a></div>
                            </div>
                        </div>
                        <div>
                            <div class="clockbox">
                                <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                                    <g id="face">
                                        <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                                        <path class="hour-marks" d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6"></path>
                                        <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                                    </g>
                                    <g id="hour">
                                        <path class="hour-hand" d="M300.5 298V142"></path>
                                        <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                                    </g>
                                    <g id="minute">
                                        <path class="minute-hand" d="M300.5 298V67"></path>
                                        <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                                    </g>
                                    <g id="second">
                                        <path class="second-hand" d="M300.5 350V55"></path>
                                        <circle class="sizing-box" cx="300" cy="300" r="253.9"> </circle>
                                    </g>
                                </svg>
                            </div>
                            <div class="badge f-10 p-0" id="txt"></div>
                        </div>
                    </div>
                    <div class="cartoon"><img class="img-fluid" src="<?= base_url() ?>/assets/images/dashboard/cartoon.svg" alt="vector women with leptop"></div>
                </div>
            </div>
        </div>
        <!-- <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-6">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card widget-1">
                        <div class="card-body">
                            <div class="widget-content">
                                <div class="widget-round secondary">
                                    <div class="bg-round">
                                        <svg class="svg-fill">
                                            <use href="<?= base_url('assets/svg/icon-sprite.svg#cart') ?>"></use>
                                        </svg>
                                        <svg class="half-circle svg-fill">
                                            <use href="<?= base_url('assets/svg/icon-sprite.svg#halfcircle') ?>"></use>
                                        </svg>

                                    </div>
                                </div>
                                <div>
                                    <h4>10,000</h4><span class="f-light">Purchase</span>
                                </div>
                            </div>
                            <div class="font-secondary f-w-500"><i class="icon-arrow-up icon-rotate me-1"></i><span>+50%</span></div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card widget-1">
                            <div class="card-body">
                                <div class="widget-content">
                                    <div class="widget-round primary">
                                        <div class="bg-round">
                                            <svg class="svg-fill">
                                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#tag"> </use>
                                            </svg>
                                            <svg class="half-circle svg-fill">
                                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#halfcircle"></use>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4>4,200</h4><span class="f-light">Sales</span>
                                    </div>
                                </div>
                                <div class="font-primary f-w-500"><i class="icon-arrow-up icon-rotate me-1"></i><span>+70%</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-6">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card widget-1">
                        <div class="card-body">
                            <div class="widget-content">
                                <div class="widget-round warning">
                                    <div class="bg-round">
                                        <svg class="svg-fill">
                                            <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#return-box"> </use>
                                        </svg>
                                        <svg class="half-circle svg-fill">
                                            <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#halfcircle"></use>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4>7000</h4><span class="f-light">Sales return</span>
                                </div>
                            </div>
                            <div class="font-warning f-w-500"><i class="icon-arrow-down icon-rotate me-1"></i><span>-20%</span></div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="card widget-1">
                            <div class="card-body">
                                <div class="widget-content">
                                    <div class="widget-round success">
                                        <div class="bg-round">
                                            <svg class="svg-fill">
                                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#rate"> </use>
                                            </svg>
                                            <svg class="half-circle svg-fill">
                                                <use href="<?= base_url() ?>/assets/svg/icon-sprite.svg#halfcircle"></use>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h4>5700</h4><span class="f-light">Purchase rate</span>
                                    </div>
                                </div>
                                <div class="font-success f-w-500"><i class="icon-arrow-up icon-rotate me-1"></i><span>+70%</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-xxl-auto col-xl-12 col-sm-6 box-col-6">
            <div class="row">
                <div class="col-xxl-12 col-xl-6 box-col-12">
                    <div class="card widget-1 widget-with-chart">
                        <div class="card-body">
                            <div>
                                <h4 class="mb-1">1,80k</h4><span class="f-light">Orders</span>
                            </div>
                            <div class="order-chart">
                                <div id="orderchart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-xl-6 box-col-12">
                    <div class="card widget-1 widget-with-chart">
                        <div class="card-body">
                            <div>
                                <h4 class="mb-1">6,90k</h4><span class="f-light">Profit</span>
                            </div>
                            <div class="profit-chart">
                                <div id="profitchart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    </div>
</div>
<!-- Container-fluid Ends-->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>/assets/js/clock.js"></script>
<script src="<?= base_url() ?>/assets/js/chart/apex-chart/stock-prices.js"></script>
<script src="<?= base_url() ?>/assets/js/chart/apex-chart/moment.min.js"></script>
<!-- <script src="<?= base_url() ?>/assets/js/notify/bootstrap-notify.min.js"></script> -->
<script src="<?= base_url() ?>/assets/js/dashboard/default.js"></script>
<script src="<?= base_url() ?>/assets/js/notify/index.js"></script>
<script src="<?= base_url() ?>/assets/js/height-equal.js"></script>

<?= $this->endSection() ?>