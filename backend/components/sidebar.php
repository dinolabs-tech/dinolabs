<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">

      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">

        <li class="nav-item">
          <a href="../index.php" class="collapsed" aria-expanded="false">
            <i class="fas fa-globe"></i>
            <p>Visit Site</p>
          </a>
        </li>


        <?php
        if (isset($_SESSION['role'])) {
          if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'mod' || $_SESSION['role'] == 'sec' || $_SESSION['role'] == 'staff') { ?>

            <li class="nav-item">
              <a href="index.php" class="collapsed" aria-ed="false">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>

          <?php } elseif ($_SESSION['role'] == 'client') { ?>

            <li class="nav-item">
              <a href="client_dashboard.php" class="collapsed" aria-ed="false">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>

          <?php } elseif ($_SESSION['role'] == 'student') { ?>

            <li class="nav-item">
              <a href="student_dashboard.php" class="collapsed" aria-ed="false">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>

        <?php }
        }

        ?>


        <?php
        if (isset($_SESSION['role'])) {
          if ($_SESSION['role'] == 'admin') { ?>

            <li class="nav-item">
              <a href="client.php" class="collapsed" aria-ed="false">
                <i class="fas fa-users"></i>
                <p>Clients</p>
              </a>
            </li>

            <!-- HEADER FOR THE ACADEMY SECTION -->
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <h4 class="text-section">Academy</h4>
              <!-- HEADER ENDS HERE -->
            </li>

            <!-- list of student enrolled -->
            <li class="nav-item">
              <a href="students_enrolled.php" class="collapsed" aria-ed="false">
                <i class="fas fa-graduation-cap"></i>
                <p>Students Enrolled</p>
              </a>
            </li>
            <!-- enrolled students ends here -->

            <!-- List of courses available -->
            <li class="nav-item">
              <a href="courses.php" class="collapsed" aria-ed="false">
                <i class="fas fa-book"></i>
                <p>Courses</p>
              </a>
            </li>
            <!-- courses available ends here -->

            <!-- create class -->
            <li class="nav-item">
              <a href="create_class.php" class="collapsed" aria-ed="false">
                <i class="fas fa-school"></i>
                <p>Create Class </p>
              </a>
            </li>
            <!-- class ends -->

            <!-- create class schedule -->
            <li class="nav-item">
              <a href="class_schedule.php" class="collapsed" aria-ed="false">
                <i class="fas fa-calendar-plus"></i>
                <p>Class Schedule</p>
              </a>
            </li>
            <!-- class schedule ends -->

            <!-- list of student enrolled -->
            <li class="nav-item">
              <a href="assign_students.php" class="collapsed" aria-ed="false">
                <i class="fas fa-user-plus"></i>
                <p>Assign Students to Class</p>
              </a>
            </li>
            <!-- enrolled students ends here -->

            <!-- create class schedule -->
            <li class="nav-item">
              <a href="student_timetable.php" class="collapsed" aria-ed="false">
                <i class="fas fa-calendar-alt"></i>
                <p>View Student Timetable</p>
              </a>
            </li>
            <!-- class schedule ends -->

            <!-- create class schedule -->
            <li class="nav-item">
              <a href="create_tasks.php" class="collapsed" aria-ed="false">
                <i class="fas fa-file-alt"></i>
                <p>Manage Tasks</p>
              </a>
            </li>
            <!-- class schedule ends -->

            <li class="nav-item">
              <a href="community.php" class="collapsed" aria-ed="false">
                <i class="fas fa-comments"></i>
                <p>Community</p>
              </a>
            </li>

            <!-- CBT RESOURCES====================== -->
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#cbt">
                <i class="fas fa-laptop"></i>
                <p>CBT</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="cbt">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="addquestion.php">
                      <span class="sub-item">Add Questions</span>
                    </a>
                  </li>
                  <li>
                    <a href="questionadd.php">
                      <span class="sub-item">Upload Questions</span>
                    </a>
                  </li>
                  <li>
                    <a href="adquest.php">
                      <span class="sub-item">Modify Questions</span>
                    </a>
                  </li>
                  <li>
                    <a href="checkcbt.php">
                      <span class="sub-item">Check Results</span>
                    </a>
                  </li>

                  <li>
                    <a href="settime.php">
                      <span class="sub-item">Set Exam Time/Date</span>
                    </a>
                  </li>


                </ul>
              </div>
            </li>

            <!-- ============================= -->

            <!-- HEADER FOR PAYMENTS -->
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <h4 class="text-section">Payment</h4>
              <!-- HEADER ENDS HERE -->
            </li>
            <li class="nav-item">
              <a href="payment_tracking.php" class="collapsed" aria-ed="false">
                <i class="fas fa-users"></i>
                <p>Payment Tracking</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="inactive_clients.php" class="collapsed" aria-ed="false">
                <i class="fas fa-user-times"></i>
                <p>Inactive Clients</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="user_control.php" class="collapsed" aria-ed="false">
                <i class="fas fa-cog"></i>
                <p>User Control</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="transaction_history.php" class="collapsed" aria-ed="false">
                <i class="fas fa-receipt"></i>
                <p>Transaction History</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="audit_history.php" class="collapsed" aria-ed="false">
                <i class="fas fa-clipboard-list"></i>
                <p>Activity Logs</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="license_history.php" class="collapsed" aria-ed="false">
                <i class="fas fa-file-alt"></i>
                <p>License History</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="decrypt_license.php" class="collapsed" aria-ed="false">
                <i class="fas fa-shield-alt"></i>
                <p>Verify License</p>
              </a>
            </li>


          <?php } elseif ($_SESSION['role'] == 'mod') { ?>




          <?php } elseif ($_SESSION['role'] == 'sec') { ?>

            <li class="nav-item">
              <a href="client.php" class="collapsed" aria-ed="false">
                <i class="fas fa-users"></i>
                <p>Clients</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="inactive_clients.php" class="collapsed" aria-ed="false">
                <i class="fas fa-user-times"></i>
                <p>Inactive Clients</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="decrypt_license.php" class="collapsed" aria-ed="false">
                <i class="fas fa-shield-alt"></i>
                <p>Verify License</p>
              </a>
            </li>

          <?php } elseif ($_SESSION['role'] == 'staff') { ?>

            <li class="nav-item">
              <a href="inactive_clients.php" class="collapsed" aria-ed="false">
                <i class="fas fa-user-times"></i>
                <p>Inactive Clients</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="decrypt_license.php" class="collapsed" aria-ed="false">
                <i class="fas fa-shield-alt"></i>
                <p>Verify License</p>
              </a>
            </li>

          <?php } elseif ($_SESSION['role'] == 'client') { ?>

            <li class="nav-item">
              <a href="purchase_license.php" class="collapsed" aria-ed="false">
                <i class="fas fa-credit-card"></i>
                <p>Purchase License</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="payment_history.php" class="collapsed" aria-ed="false">
                <i class="fas fa-history"></i>
                <p>Transaction History</p>
              </a>
            </li>

          <?php } elseif ($_SESSION['role'] == 'student') { ?>



            <li class="nav-item">
              <a href="community.php" class="collapsed" aria-ed="false">
                <i class="fas fa-comments"></i>
                <p>Community</p>
              </a>
            </li>

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#test">
                <i class="fas fa-laptop"></i>
                <p>CBT</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="test">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="sublist.php">
                      <span class="sub-item">Take Test</span>
                    </a>
                  </li>
                  <li>
                    <a href="result.php">
                      <span class="sub-item">CBT Result</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

        <?php }
        } ?>

        <li class="nav-item">
          <a href="../logout.php" class="collapsed" aria-ed="false">
            <i class="fas fa-sign-out-alt"></i>
            <p>Sign-Out</p>
          </a>
        </li>


      </ul>
    </div>
  </div>
</div>