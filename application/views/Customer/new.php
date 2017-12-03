
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!--https://adminlte.io/themes/AdminLTE/pages/forms/advanced.html -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<?php echo validation_errors(); ?>
          <?php  echo form_open('http://localhost/group-project-1.1/index.php/Customer/Newcustomer'); ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address">
                </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email </label>
                  <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Contact Number</label>
                  <input type="text" class="form-control" id="phone_number" placeholder="Enter Contact Number" name="phone_number">
                </div>
                
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
      <?php echo form_close(); ?>
</body>
</html>
