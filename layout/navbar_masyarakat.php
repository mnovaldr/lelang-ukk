<?php 
session_start();
if($_SESSION['status']!="login"){
  header("location:../index.php?info=login");
}
?>
 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
     <div class="container">
         <a href="../index.php" class="navbar-brand">
             <h5 class="brand-text">Sistem Lelang Online</h5>
         </a>

         <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse order-3" id="navbarCollapse">
             <!-- Left navbar links -->
             <ul class="navbar-nav">
                 <li class="nav-item">
                     <a href="index.php" class="nav-link">Home</a>
                 </li>
                 <li class="nav-item">
                     <a href="penawaran.php" class="nav-link">Penawaran</a>
                 </li>
             </ul>
         </div>

         <!-- Right navbar links -->
         <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
             <li class="nav-item">
                 <a class="nav-link" href="../logout.php" role="button">
                     <i class="fa fa-user"></i> Logout
                 </a>
             </li>
         </ul>
     </div>
 </nav>
 <!-- /.navbar -->