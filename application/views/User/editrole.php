<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Role Names</h3><br>

        <?php  echo form_open('http://localhost/group-project-1.1/index.php/User/editrole'); ?>
        <class="sidebar-form">
        <div>

        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <form>
                <tbody>
                  <tr>
                    <th>Pick a Role</th>
                  </tr>
                  <tr>
                    <td> <input type="radio" name="role" value="purchasing officer"> purchasing officer<br> </td>
                </tr>

                <tr>
                    <td> <input type="radio" name="role" value="project manager"> project manager<br> </td>
                </tr>

                <tr>
                  <td> <input type="radio" name="role" value="technical officer"> technical officer<br> </td>
                </tr>

                <tr>
                  <td>   <input type="radio" name="role" value="quantity servayor"> quantity servayor<br> </td>
                </tr>
          </tbody>
      </form>
    </table>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
