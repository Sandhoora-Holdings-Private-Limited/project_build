
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Update Customer</h3>
        </div>
      
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?= base_url(); ?>/Customer/update" method="post">
          
          <div class="box-body">
            
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Address</label>
              <input type="text" class="form-control" id="address"  name="address">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email </label>
              <input type="email" class="form-control" id="email"  name="email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Contact Number</label>
              <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>
             
            
          </div>
          
          

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
          

        </form>
      </div>
  </div>
</div>