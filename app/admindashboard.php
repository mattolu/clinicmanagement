<?php

// if(!isset($_COOKIE['token'])){
//     header("location:login.php");
// }
?>

<?php include ("header.php"); ?>

<body>


<?php include ("head_panel.php"); ?>

<?php include ("right_panel.php"); ?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Dashboard</h4>
      </div><!-- d-flex -->

      <div class="mg-t-60 tx-center"><button class="mg-20"><a href="adddoctor.php" class="tx-info">Add Doctor</a></button>
      <button><a href="adduser.php" class="tx-info">Add User</a></button></div>
         
	  <?php include ("footer.php"); ?>