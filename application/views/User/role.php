<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User Role Details</h3>
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
              create <i class="fa fa-arrow-circle-right"></i>
            </div>
        </div>
    </a>
</div>
                <?php  echo form_open('http://http://localhost/group-project-1.1///User/role'); ?>
                <class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="id" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
                </form>
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
                        //echo '<td><a href="'.base_url().'/User/role/'.$role->id.'"><button type="button" class="btn btn-block btn-info">Pick</button></td></a>';
                        echo '<td> <button type="button" class="btn btn-block btn-success">Edit</button> </td>';
                        echo '<td><button type="button" class="btn btn-block btn-danger">Delete</button></td>';

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
