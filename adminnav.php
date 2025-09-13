<!--
adminnav.php

This file defines the sidebar navigation menu for the administrative interface.
It dynamically displays menu items based on the user's assigned role (e.g., Superuser, Administrator, Admission, Teacher, Tuckshop, Bursary).
This ensures that users only see the navigation options relevant to their permissions.
The sidebar includes sections for Dashboard, Admission, Teacher, TuckShop, Bursary, and Administrator functionalities,
each with sub-menus for specific tasks.
-->

<!-- Sidebar Container -->
<div class="sidebar" data-background-color="dark">
  <!-- Sidebar Logo Section -->
  <div class="sidebar-logo">
    <?php 
    // Include the logo header component, which typically displays the application's logo and name.
    include('logo_header.php'); ?>
  </div>
  <!-- Sidebar Wrapper for Scrollable Content -->
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <!-- Sidebar Content Area -->
    <div class="sidebar-content">
      <!-- Main Navigation Menu -->
      <ul class="nav nav-secondary">

        <!-- Dashboard Menu Item -->
        <!-- This section conditionally displays the Dashboard link based on the user's role. -->
        <?php if ($_SESSION['role'] == 'Superuser') { ?>
          <!-- Dashboard link for Superusers, leading to a specific superuser dashboard. -->
          <li class="nav-item">
            <a href="superdashboard.php">
              <i class="fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
        <?php } else { ?>
          <!-- Dashboard link for all other roles, leading to a general dashboard. -->
          <li class="nav-item">
            <a href="dashboard.php">
              <i class="fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
        <?php } ?>

        <!-- Admission Section -->
        <!-- This section and its sub-items are visible only to Administrators, Admission staff, and Superusers. -->
        <?php if ($_SESSION['role'] == 'Administrator' || $_SESSION['role'] == 'Admission' || $_SESSION['role'] == 'Superuser') { ?>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Admission</h4>
          </li>
          <!-- Students Management Menu Item -->
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#students">
              <i class="fas fa-user-graduate"></i>
              <p>Students</p>
              <span class="caret"></span> <!-- Caret icon indicates a collapsible menu -->
            </a>
            <div class="collapse" id="students">
              <ul class="nav nav-collapse">
                <li>
                  <a href="registerstudents.php">
                    <span class="sub-item">Enroll</span> <!-- Link to enroll new students -->
                  </a>
                </li>
                <li>
                  <a href="modifystudents.php">
                    <span class="sub-item">Modify</span> <!-- Link to modify existing student records -->
                  </a>
                </li>
                <li>
                  <a href="viewstudents.php">
                    <span class="sub-item">View Profile</span> <!-- Link to view student profiles -->
                  </a>
                </li>
                <li>
                  <a href="filter_students.php">
                    <span class="sub-item">Filter Students</span> <!-- Link to filter and search student records -->
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php } ?>

        <!-- Teacher Section -->
        <!-- This section and its sub-items are visible only to Administrators, Teachers, and Superusers. -->
        <?php if ($_SESSION['role'] == 'Administrator' || $_SESSION['role'] == 'Teacher' || $_SESSION['role'] == 'Superuser') { ?>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Teacher</h4>
          </li>
          <!-- Results Management Menu Item -->
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#result">
              <i class="fas fa-chart-bar"></i>
              <p>Results</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="result">
              <ul class="nav nav-collapse">
                <li>
                  <a href="uploadresults.php">
                    <span class="sub-item">Upload</span> <!-- Link to upload student results -->
                  </a>
                </li>
                <li>
                  <a href="modifyresult.php">
                    <span class="sub-item">Modify</span> <!-- Link to modify uploaded results -->
                  </a>
                </li>
                <li>
                  <a href="classteachercomment.php">
                    <span class="sub-item">Class Teacher's Comments</span> <!-- Link for class teachers to add comments -->
                  </a>
                </li>
                <li>
                  <a href="viewuploadedresult.php">
                    <span class="sub-item">View Uploaded Results</span> <!-- Link to view all uploaded results -->
                  </a>
                </li>
            
                <!-- Administrator/Superuser specific result options -->
                <?php if ($_SESSION['role'] == 'Administrator' || $_SESSION['role'] == 'Superuser') { ?>
                  <li>
                    <a href="principalcomment.php">
                      <span class="sub-item">Principal's Comments</span> <!-- Link for principals to add comments -->
                    </a>
                  </li>
                  <li>
                    <a href="mastersheet.php">
                      <span class="sub-item">Download Mastersheet</span> <!-- Link to download a master sheet of results -->
                    </a>
                  </li>
                  <li>
                    <a href="individualresult.php">
                      <span class="sub-item">Download Student's result</span> <!-- Link to download individual student results -->
                    </a>
                  </li>
                  <li>
                    <a href="revoke.php">
                      <span class="sub-item">Revoke Students Results</span> <!-- Link to revoke student results -->
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </li>
          <!-- E-Learning Resources Menu Item -->
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#resources">
              <i class="fas fa-globe"></i>
              <p>E-Learning Resources</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="resources">
              <ul class="nav nav-collapse">
                <li>
                  <a data-bs-toggle="collapse" href="#subnav1">
                    <span class="sub-item">Assignments</span>
                    <span class="caret"></span>
                  </a>
                  <div class="collapse" id="subnav1">
                    <ul class="nav nav-collapse subnav">
                      <li>
                        <a href="uploadassignments.php">
                          <span class="sub-item">Upload</span> <!-- Link to upload assignments -->
                        </a>
                      </li>
                      <li>
                        <a href="viewuploadassignments.php">
                          <span class="sub-item">View</span> <!-- Link to view uploaded assignments -->
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

                <li>
                  <a data-bs-toggle="collapse" href="#subnav3">
                    <span class="sub-item">Notes</span>
                    <span class="caret"></span>
                  </a>
                  <div class="collapse" id="subnav3">
                    <ul class="nav nav-collapse subnav">
                      <li>
                        <a href="uploadnotes.php">
                          <span class="sub-item">Upload</span> <!-- Link to upload notes -->
                        </a>
                      </li>
                      <li>
                        <a href="viewuploadnotes.php">
                          <span class="sub-item">View</span> <!-- Link to view uploaded notes -->
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a data-bs-toggle="collapse" href="#subnav2">
                    <span class="sub-item">Curriculum</span>
                    <span class="caret"></span>
                  </a>
                  <div class="collapse" id="subnav2">
                    <ul class="nav nav-collapse subnav">
                      <li>
                        <a href="uploadcurriculum.php">
                          <span class="sub-item">Upload</span> <!-- Link to upload curriculum documents -->
                        </a>
                      </li>
                      <li>
                        <a href="viewuploadcurriculum.php">
                          <span class="sub-item">View</span> <!-- Link to view uploaded curriculum documents -->
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>

          <!-- CBT (Computer Based Test) Section -->
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
                    <span class="sub-item">Add Questions</span> <!-- Link to manually add CBT questions -->
                  </a>
                </li>
                <li>
                  <a href="questionadd.php">
                    <span class="sub-item">Upload Questions</span> <!-- Link to upload CBT questions in bulk -->
                  </a>
                </li>
                <li>
                  <a href="adquest.php">
                    <span class="sub-item">Modify Questions</span> <!-- Link to modify existing CBT questions -->
                  </a>
                </li>
                <li>
                  <a href="checkcbt.php">
                    <span class="sub-item">Check Results</span> <!-- Link to check CBT results -->
                  </a>
                </li>
                <li>
                  <a href="settime.php">
                    <span class="sub-item">Set Exam Time/Date</span> <!-- Link to configure CBT exam times and dates -->
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php } ?>

        <!-- TuckShop Section -->
        <!-- This section and its sub-items are visible only to Administrators, Tuckshop staff, and Superusers. -->
        <?php if ($_SESSION['role'] == 'Administrator' || $_SESSION['role'] == 'Tuckshop' || $_SESSION['role'] == 'Superuser') { ?>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">TuckShop</h4>
          </li>
          <!-- Tuck Shop Management Menu Item -->
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#tuck">
              <i class="fas fa-store"></i>
              <p>Tuck Shop</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="tuck">
              <ul class="nav nav-collapse">
                <li>
                  <a href="regtuck.php">
                    <span class="sub-item">Register</span> <!-- Link to register new tuck shop items/products -->
                  </a>
                </li>
                <li>
                  <a href="sellingpoint.php">
                    <span class="sub-item">POS</span> <!-- Link to the Point of Sale interface -->
                  </a>
                </li>
                <li>
                  <a href="inventory.php">
                    <span class="sub-item">Inventory</span> <!-- Link to manage tuck shop inventory -->
                  </a>
                </li>
                <li>
                  <a href="supplier.php">
                    <span class="sub-item">Suppliers</span> <!-- Link to manage supplier information -->
                  </a>
                </li>
                <li>
                  <a href="tuckdashboard.php">
                    <span class="sub-item">Dashboard</span> <!-- Link to the tuck shop dashboard -->
                  </a>
                </li>
                <li>
                  <a href="transactions.php">
                    <span class="sub-item">Transactions</span> <!-- Link to view tuck shop transactions -->
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php } ?>

        <!-- Bursary Section -->
        <!-- This section and its sub-items are visible only to Administrators, Bursary staff, and Superusers. -->
        <?php if ($_SESSION['role'] == 'Administrator' || $_SESSION['role'] == 'Bursary' || $_SESSION['role'] == 'Superuser') { ?>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Bursary</h4>
          </li>
          <!-- Bursary Management Menu Item -->
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#bursary">
              <i class="fas fa-hand-holding-usd"></i>
              <p>Bursary</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="bursary">
              <ul class="nav nav-collapse">
                <li>
                  <a href="./account">
                    <span class="sub-item">Account Management</span> <!-- Link to manage bursary accounts -->
                  </a>
                </li>
                <li>
                  <a href="approvepayments.php">
                    <span class="sub-item">Approve Payments</span> <!-- Link to approve pending payments -->
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php } ?>

        <!-- Administrator Section -->
        <!-- This section and its sub-items are visible only to Administrators and Superusers. -->
        <?php if ($_SESSION['role'] == 'Administrator' || $_SESSION['role'] == 'Superuser') { ?>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Administrator</h4>
          </li>
          <!-- Class Schedule Menu Item -->
          <li class="nav-item">
            <a href="timetable.php">
              <i class="fas fa-th-list"></i>
              <p>Class Schedule</p> <!-- Link to manage and view class timetables -->
            </a>
          </li>
          <!-- Calendar Menu Item -->
          <li class="nav-item">
            <a href="calendar.php">
              <i class="fas fa-calendar-alt"></i>
              <p>Calendar</p> <!-- Link to the academic calendar -->
            </a>
          </li>
          <!-- Discussion Threads Menu Item -->
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#threads">
              <i class="fas fa-comment-dots"></i>
              <p>Discussion Threads</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="threads">
              <ul class="nav nav-collapse">
                <li>
                  <a href="threads.php">
                    <span class="sub-item">Threads</span> <!-- Link to view all discussion threads -->
                  </a>
                </li>
                <li>
                  <a href="create_thread.php">
                    <span class="sub-item">Create Thread</span> <!-- Link to create new discussion threads -->
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <!-- Subjects Management Menu Item -->
          <li class="nav-item">
            <a href="subjects.php">
              <i class="fas fa-book-open"></i>
              <p>Subjects</p> <!-- Link to manage academic subjects -->
            </a>
          </li>
          <!-- Settings Menu Item -->
          <li class="nav-item">
            <a href="admin.php">
              <i class="fas fa-cog"></i>
              <p>Settings</p> <!-- Link to general administrative settings -->
            </a>
          </li>
          <!-- User Control Menu Item -->
          <li class="nav-item">
            <a href="usercontrol.php">
              <i class="fas fa-user-cog"></i>
              <p>User Control</p> <!-- Link to manage user accounts and roles -->
            </a>
          </li>
          <!-- Parents Management Menu Item -->
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#parents">
              <i class="fas fa-users"></i>
              <p>Parents</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="parents">
              <ul class="nav nav-collapse">
                <li>
                  <a href="register_parent.php">
                    <span class="sub-item">Register Parents</span> <!-- Link to register new parent accounts -->
                  </a>
                </li>
                <li>
                  <a href="delete_parent.php">
                    <span class="sub-item">Delete Parents</span> <!-- Link to delete parent accounts -->
                  </a>
                </li>
                <li>
                  <a href="assign_students.php">
                    <span class="sub-item">Assign Students</span> <!-- Link to assign students to parents -->
                  </a>
                </li>
                <li>
                  <a href="unassign_students.php">
                    <span class="sub-item">Unassign Students</span> <!-- Link to unassign students from parents -->
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <!-- Send Notice to Parents Menu Item -->
          <li class="nav-item">
            <a href="send_notice.php">
              <i class="fas fa-envelope-open"></i>
              <p>Send Notice to Parents</p> <!-- Link to send notifications or messages to parents -->
            </a>
          </li>
          <!-- Alumni List Menu Item -->
          <li class="nav-item">
            <a href="alumni_list.php">
              <i class="fas fa-graduation-cap"></i>
              <p>Alumni List</p> <!-- Link to view and manage the list of alumni -->
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->
