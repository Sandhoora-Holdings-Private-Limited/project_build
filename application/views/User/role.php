<div class="row">

  <div class="col-lg-3 col-xs-6">
  <a href="#" class="small-box-footer">
  <div class="small-box bg-aqua">
    <div class="inner">
      <h3>Add</h3>

      <p>New Role</p>
    </div>
    <div class="icon">
      <i class="glyphicon glyphicon-plus"></i>
    </div>
    <div class="small-box-footer">
      more info <i class="fa fa-arrow-circle-right"></i>
    </div>
  </div>
  </a>
</div>
<div class="col-lg-3 col-xs-6">
  </div>
  <div class="col-lg-3 col-xs-6">
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">User Role List</h3>

        <div class="box-tools">
          <?php  echo form_open('http://localhost/group-project-1.1/index.php/User/rolebyid'); ?>
          <div class="input-group input-group-sm" style="width: 150px;">
            <input name="table_search" class="form-control pull-right" placeholder="Search" type="text">

            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody><tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    foreach ($roles as $role) {
                        echo '<tr>';
                        echo '<td>'.$role->id.'</td>';
                        echo '<td>'.$role->name.'</td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td><form action="'.base_url().'/User/rolebyidview/'.$role->id.'" method="post">
                            <input hidden name="id" value="'.$role->id.'">
                            <button type="submit" class="btn btn-block btn-info" > Info </button>
                          </form></td>';

                        echo '<td><form action="'.base_url().'/User/editrole/'.$role->id.'" method="post">
                            <input hidden name="id" value="'.$role->id.'">
                            <button type="submit" class="btn btn-block btn-success" >Edit</button>
                          </form> </td>';

                      /*  echo '<td><form action="'.base_url().'/User/deleterole/'.$customer->id.'" method="post">
                            <input hidden name="id" value="'.$customer->id.'">
                            <button type="submit" class="btn btn-block btn-danger" >Delete</button>
                        </form></td>';*/

                        //<a href="<?php echo base_url('index.php/Admin/editRingPost/'.$row['ringId']);


                        echo '</tr>';
                    //</form>
                  }
                    ?>



                    <!--<tr>
                      <td>219</td>
                      <td>Alexander Pierce</td>
                      <td>11-7-2014</td>
                      <td><span class="label label-warning">Pending</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>657</td>
                      <td>Bob Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="label label-primary">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>175</td>
                      <td>Mike Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="label label-danger">Denied</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>-->
                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<?php
