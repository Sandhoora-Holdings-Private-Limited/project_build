<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">New Customer</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo validation_errors(); ?>
        <form role="form" action="<?= base_url(); ?>/Customer/Newcustomer" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Address</label>
              <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email </label>
              <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Contact Number</label>
              <input type="text" class="form-control" id="phone_number" placeholder="Enter Contact Number" name="phone_number">
            </div>

            
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
  </div>
</div>