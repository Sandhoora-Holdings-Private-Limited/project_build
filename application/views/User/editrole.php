<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Role Info </h3><br>
            </div>
                <?php foreach ($accesses as $access) { ?>
                  <form>
                      <div class="form-group">
                <label class="col-sm-12 control-label"><input type="checkbox" name="'.$access->object.'" value="'.$access->object.'"><?php echo $access->object ?><br></label>
              </div>
            </form>
          <?php } ?>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
  <?php
