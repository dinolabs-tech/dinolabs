<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
  <div class="container-fluid">

    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">


      <li class="nav-item topbar-user dropdown hidden-caret">
        <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
          <div class="avatar-sm">

            <?php
            if (isset($_SESSION['role'])) {
              if ($_SESSION['role'] == 'student') { ?>
                <img src="../<?= $_SESSION['imgpath']; ?>" alt="..." class="avatar-img rounded-circle" />
              <?php } else { ?>
               <img src="./assets/img/profile-img.jpg" alt="..." class="avatar-img rounded-circle" />
            <?php }
            } ?>

          </div>
          <span class="profile-username">
            <span class="op-7">Hi,</span>
            <span class="fw-bold"><?php echo $_SESSION['name']; ?></span>
          </span>
        </a>
        <ul class="dropdown-menu dropdown-user animated fadeIn">
          <div class="dropdown-user-scroll scrollbar-outer">

            <li>
              <div class="dropdown-divider"></div>
              <?php
              if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff' || $_SESSION['role'] == 'sec') { ?>
                  <a class="dropdown-item" href="edit_admin_profile.php">My Profile</a>
                <?php } elseif ($_SESSION['role'] == 'client') { ?>
                  <a class="dropdown-item" href="edit_profile.php">My Profile</a>
                <?php } elseif ($_SESSION['role'] == 'student') { ?>
                  <a class="dropdown-item" href="student_profile.php">My Profile</a>
              <?php }
              } ?>



              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../logout.php">Logout</a>
            </li>
          </div>
        </ul>
      </li>
    </ul>
  </div>
</nav>