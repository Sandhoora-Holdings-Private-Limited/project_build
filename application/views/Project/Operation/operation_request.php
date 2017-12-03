<div class="row">
  <div class="col-xs-12">
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Project Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url();?>/Project/new" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input class="form-control" id="name" placeholder="Enter name" name="name" type="text">
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input class="form-control" id="address" placeholder="Address" name="address" type="text">
                </div>

                <div class="form-group">
                <label>Start date</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right" id="project_new_datepicker" name="start_date" type="text">
                </div>
              </div>
              <div class="form-group">
                <label>End date</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right" id="project_new_datepicker1" name="end_date" type="text">
                </div>
              </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input hidden name="form" value="true">
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
