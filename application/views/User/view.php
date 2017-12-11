<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">View User Details</h3>
    </div>
    <div class="box-body">
        <?php foreach($users as $user_){ ?>
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">ID : </label>
                    <label class="col-sm-7 control-label"><?php echo $user_->id ?></label>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"> Name: </label>
                    <label class="col-sm-7 control-label"><?php echo $user_->name ?></label>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Role ID : </label>
                    <label class="col-sm-7 control-label"><?php echo $user_->role_id ?></label>
                </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>