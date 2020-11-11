<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>RMTS Login</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/vendor.bundle.base.css">
  <!-- endinject -->
  <script src="https://use.fontawesome.com/77fb63d6cc.js"></script>

  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/style.css">
  <!-- endinject -->
  <link rel="icon" href="<?php echo base_url('assets/mas_icon.png') ?>">  
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="<?php echo base_url() ?>assets/logo.png" alt="logo">
              </div>
              <h2>Raw Material Tracking System</h2>
              <h4 class="font-weight-light">Login System</h4>
              <form class="pt-3" action="<?php echo base_url('login/submit') ?>" method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail">EPF Number</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">  
                      <i class="fa fa-user"></i>                      
                      </span>
                    </div>
                    <input type="text" required="" name="epf" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="EPF">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0"> 
                      <i class="fa fa-lock"></i>                       
                      </span>
                    </div>
                    <input type="password" required="" name="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password">                        
                  </div>
                </div>                
                <div class="my-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">LOGIN</button>
                  <?php echo $this->session->flashdata('msg'); ?>
                </div>                
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2020  Autonomation.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="<?php echo base_url() ?>assets/vendor/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?php echo base_url() ?>assets/vendor/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
