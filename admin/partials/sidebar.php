    <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="<?= BASE_URL; ?>admin/index.php" class="nav-link <?= $_GET['page'] == '' ? 'active':'' ?>">
            <i class="far fa-circle nav-icon text-danger"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header">MASTER DATA</li>
          <li class="nav-item">
            <a href="<?= BASE_URL; ?>admin/index.php?page=kategori" class="nav-link <?= $_GET['page'] == 'kategori' ? 'active':'' ?>">
              <i class="far fa-circle nav-icon text-danger"></i>
              <p>
                Kategori
                <!-- <span class="badge badge-info right">2</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= BASE_URL; ?>admin/index.php?page=barang" class="nav-link <?= $_GET['page'] == 'barang' ? 'active':'' ?>">
              <i class="far fa-circle nav-icon text-danger"></i>
              <p>
                Barang
                <!-- <span class="badge badge-info right">2</span> -->
              </p>
            </a>
          </li>

          <li class="nav-header">PESANAN</li>
          <li class="nav-item">
            <a href="<?= BASE_URL; ?>admin/index.php?page=pesanan" class="nav-link <?= $_GET['page'] == 'pesanan' ? 'active':'' ?>">
              <i class="far fa-circle nav-icon text-danger"></i>
              <p>
                Pesanan
                <!-- <span class="badge badge-info right">2</span> -->
              </p>
            </a>
          </li>

          <li class="nav-header">MEMBER</li>
          <li class="nav-item">
            <a href="<?= BASE_URL; ?>admin/index.php?page=kelola" class="nav-link <?= $_GET['page'] == 'kelola' ? 'active':'' ?>">
              <i class="far fa-circle nav-icon text-danger"></i>
              <p>
                Kelola
                <!-- <span class="badge badge-info right">2</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= BASE_URL; ?>admin/index.php?page=aktifitas" class="nav-link <?= $_GET['page'] == 'aktifitas' ? 'active':'' ?>">
              <i class="far fa-circle nav-icon text-danger"></i>
              <p>
                Aktifitas
                <!-- <span class="badge badge-info right">2</span> -->
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->