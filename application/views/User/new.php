<div class="row">
    <div class="col-xs-12">
        <div style="display:<?php if(isset($fail)) echo"block"; else echo "none"; ?>;" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Failed!</h4>
            <?php if(isset($message)) echo $message; ?>
        </div>
        <div style="display:<?php if(isset($sucess)) echo"block"; else echo "none"; ?>;"  class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sucess!</h4>
            <?php if(isset($message)) echo $message; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">New User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo validation_errors(); ?>
            <form role="form" action="<?= base_url(); ?>/User/Addnewuser" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputid">User ID</label>
                        <input type="text" class="form-control" id="id" placeholder="Enter ID" name="id">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputname">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                    </div>

                    <div class="form-group">
                        <label>Role ID</label>

                        <select class="select2" style="width: 100%;" id="role_id"  name="role_id">
                            <?php foreach ($roles as $role) {
                                echo '<option >' .$role->id. '</option> '  ;
                            } ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="password_hash" placeholder="Password" name="	password_hash">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="password_salt" placeholder="Comfirm Password" name="password_salt">
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
