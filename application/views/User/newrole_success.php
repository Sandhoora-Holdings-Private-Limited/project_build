<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Success </h4>
      Role succefully added.
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">New Role</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo validation_errors(); ?>
        <form role="form" action="<?= base_url(); ?>/User/Addnewrole_after_success" method="post">
          <div class="box-body">

            <div class="form-group">
              <label for="exampleInputRole">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Enter Role Name" name="name">
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
