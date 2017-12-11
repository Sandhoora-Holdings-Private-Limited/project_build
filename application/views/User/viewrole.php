<h4>Personal Details</h4>
<?php foreach($roles as $role){ ?>
<form class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-3 control-label">ID : </label>
        <label class="col-sm-7 control-label"><?php echo $role->id ?></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Role name : </label>
        <label class="col-sm-7 control-label"><?php echo $customer->name ?></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Users : </label>
        <?php foreach ($users as $user) { ?>
        <label class="col-sm-10 control-label"><?php echo $id->role_id ?></label>
    <?php } ?>
    </div>
</form>
<?php } ?>
