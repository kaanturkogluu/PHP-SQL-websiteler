<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= SITE . "index.php" ?>" class="brand-link">
        <img src="<?= SITE ?>dist/img/AdminLTELogo.png" alt="Panel Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">YÖNETİM PANELİ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= SITE ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Kullanıcı Ad Soyad </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">


                    <p>
                        Modüller

                    </p>

                </li>
                <li class="nav-item">
                    <a href="<?= SITE ?>index.php?sayfa=galeri" class="nav-link active">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Galeri

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= SITE ?>index.php?sayfa=mailbox" class="nav-link ">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                        Mail
                        </p>
                    </a>
                </li>

                <li class="nav-header">Site Yönetimi</li>
                <li class="nav-item">
                    <a href="<?= SITE ?>index.php?sayfa=menu" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Menü</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= SITE ?>index.php?sayfa=icerik" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>İçerik</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= SITE ?>index.php?sayfa=resimler" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Resimler</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= SITE ?>index.php?sayfa=slider" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Slider</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= SITE ?>index.php?sayfa=referanslar" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Referanslar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= SITE ?>index.php?sayfa=iletisim" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Site İletişim</p>
                    </a>
                </li>
                <li class="nav-header">Site Ayarları</li>
                <a href="<?= SITE ?>index.php?sayfa=seo" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SEO Ayarları</p>
                </a> <a href="<?= SITE ?>index.php?sayfa=mailbox" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mail Ayarları</p>
                </a>

                <li class="nav-header">Yotube İle Öğren</li>
                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.0" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Panel Kullanımı</p>
                    </a>
                </li>
            </ul>


        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>