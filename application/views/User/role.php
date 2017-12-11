<div class="row">

  <div class="col-lg-3 col-xs-6">
  <a href="<?=base_url();?>/User/newrole" class="small-box-footer">
  <div class="small-box bg-yellow">
    <div class="inner">
      <h3>Add</h3>

      <p>New Role</p>
    </div>
    <div class="icon">
      <i class="fa  fa-user-plus"></i>
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
      </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive with-padding">
                <table id="role_table" class="table table-hover">
                    <thead><tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($roles as $role) {
                        echo '<tr>';
                        echo '<td>'.$role->id.'</td>';
                        echo '<td>'.$role->name.'</td>';
                        echo '<td></td>';
                        echo '<td>
                        <form action="'.base_url().'/User/rolebyidview/'.$role->id.'" method="post">
                            <input hidden name="id" value="'.$role->id.'">
                            <button type="submit" class="btn btn-block btn-info" > Info </button>
                          </form>
                          </td>';

                        echo '<td>
                              <form action="'.base_url().'/User/edit_role/'.$role->id.'" method="post">
                              <input hidden name="id" value="'.$role->id.'">
                              <button type="submit" class="btn btn-block btn-success" >Edit</button>
                              </form>
                              </td>';
                        echo '<td>
                              <form action="'.base_url().'/User/delete_role/'.$role->id.'" method="post">
                              <input hidden name="id" value="'.$role->id.'">
                              <button type="submit" class="btn btn-block btn-danger" >Delete</button>
                              </form>
                              </td>';


                        echo '</tr>';
                  }
                    ?>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                      </tr>
                  </tfoot>
              </table>
            </div>
            <div class="box-footer">

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<?php
