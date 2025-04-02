<?php
session_start();

// Check if the user is logged in and has the correct role
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'admin') {
    // Redirect customers or unauthenticated users to the login page
    header("Location: /DL/DL/Frontend/dist/pages/samples/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  
<?php include "head.php"?>

  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->

      <?php include "_navbar.php"?>
      
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->

        <?php include "_sidebar.php"?>

        <!-- partial -->

        <?php include "partial.php"?>

        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>