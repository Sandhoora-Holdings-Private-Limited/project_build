<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive with-padding">
                <table id="user_table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RoleID</th>
                            <th>Name</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                    foreach ($users as $user_)
                    {
                        echo '<tr>';
                        echo '<td>'.$user_->id.'</td>';
                        echo '<td>'.$user_->role_id.'</td>';
                        echo '<td>'.$user_->name.'</td>';
                        echo '<td>
                                <form action="'.base_url().'/User/viewuser" method="post">
                                <input hidden name="id" value="'.$user_->id.'">
                                  <button type="submit" class="btn btn-block btn-info" >Info</button>
                                </form>
                                
                              </td>';
                        echo '<td><form action="'.base_url().'/User/updateuser" method="post">
                                <input hidden name="id" value="'.$user_->id.'">
                                  <button type="submit" class="btn btn-block btn-info" >Edit</button>
                                </form> </td>';
                        echo '<td><form action="'.base_url().'/User/deleteuser" method="post">
                                <input hidden name="id" value="'.$user_->id.'">
                                  <button type="submit" class="btn btn-block btn-danger" >Delete</button>
                                </form> </td>';

                        echo '</tr>';

                    }
                    ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>RoleID</th>
                            <th>Name</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
