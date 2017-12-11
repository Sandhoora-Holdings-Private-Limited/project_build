
<h4>Personal Details</h4>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name : </label>
            <label class="col-sm-7 control-label"><?php echo $users->name ?></label>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">RoleID : </label>
            <label class="col-sm-7 control-label"><?php echo $users->role_id ?></label>
        </div>
    </form>


<h4>Personal Details</h4>
<?php foreach($users as $user){ ?>
    <form class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">id : </label>
            <label class="col-sm-7 control-label"><?php echo $user->id ?></label>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Name : </label>
            <label class="col-sm-7 control-label"><?php echo $user->name ?></label>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Role : </label>
            <?php foreach ($roles as $role) { ?>
                <label class="col-sm-10 control-label"><?php echo $role->project_id ?></label>
            <?php } ?>
        </div>
    </form>
<?php } ?>
