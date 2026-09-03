<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand & Close Button on Mobile -->
    <?php
        $sidebar_role_id = $this->session->userdata('role_id');
        $brand_dashboard_url = ($sidebar_role_id == 2) ? base_url('user') : base_url('operator');
    ?>
    <div class="sidebar-brand-container d-flex align-items-center justify-content-between px-3">
        <a class="sidebar-brand d-flex align-items-center m-0 p-0 text-white" href="<?= $brand_dashboard_url; ?>" title="Menuju Dashboard">
            <div class="sidebar-brand-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="sidebar-brand-text mx-3">
                <span style="font-weight: 700; letter-spacing: 1px;">SILAT</span>
                <sup style="font-size: 12px; font-weight: 400; color: #bbb;">^_^</sup>
            </div>
        </a>
        <!-- Tombol Tutup / Sembunyikan Sidebar di Mobile -->
        <button class="btn btn-sm text-white d-md-none sidebar-close-btn" id="sidebarCloseBtn" type="button" aria-label="Tutup Sidebar" title="Sembunyikan Sidebar">
            <i class="fas fa-times"></i>
        </button>
    </div>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Query menu -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`,`menu`
                    FROM `user_menu` JOIN `user_access_menu`
                         ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                        WHERE `user_access_menu`.`role_id`= $role_id
                        ORDER BY `user_access_menu`.`menu_id` ASC
    
                ";
    $menu = $this->db->query($queryMenu)->result_array();

    ?>


    <!-- LOOPING MENU -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        <!-- SIAPKAN SUB-MENU SESUAI MENU -->
        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT *
                    FROM `user_sub_menu` JOIN `user_menu`
                         ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                        WHERE `user_sub_menu`.`menu_id`= $menuId
                        AND `is_active`=1
    
                ";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>
        <?php foreach ($subMenu as $sm) : ?>
            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">

                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>

            <?php endforeach; ?>
            <hr class="sidebar-divider mt-3">
        <?php endforeach; ?>
        <!-- Nav Item - Dashboard -->


        <li class="nav-item">
            <a class="nav-link btn-logout" href="<?= base_url('auth/logout'); ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Tombol Sembunyikan Sidebar (Mobile & Desktop) -->
        <div class="sidebar-toggler-wrapper text-center my-3 px-3">
            <!-- Tombol untuk Layar Mobile -->
            <button class="btn btn-sm btn-light-sidebar d-md-none w-100 py-2 font-weight-bold sidebar-hide-btn" id="sidebarHideMobileBtn" type="button" title="Sembunyikan Sidebar">
                <i class="fas fa-chevron-left mr-1"></i> Sembunyikan Sidebar
            </button>
            <!-- Tombol Toggler Bulat untuk Desktop -->
            <div class="d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle" title="Sembunyikan / Perkecil Sidebar"></button>
            </div>
        </div>

</ul>
<!-- End of Sidebar -->