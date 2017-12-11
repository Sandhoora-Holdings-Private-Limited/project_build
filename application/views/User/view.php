
<h4>Personal Details</h4>
<<<<<<< HEAD
<?php foreach($users as $user){ ?>
    <form class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">Name : </label>
            <label class="col-sm-7 control-label"><?php echo $user->name ?></label>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">RoleID : </label>
            <label class="col-sm-7 control-label"><?php echo $user->role_id ?></label>
=======
<?php foreach($user as $user){ ?>
    <form class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">Name : </label>
            <label class="col-sm-7 control-label"><?php echo $customer->name ?></label>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">RoleID : </label>
            <label class="col-sm-7 control-label"><?php echo $customer->address ?></label>
>>>>>>> f2861112fab84533951956221425678771997717
        </div>
            <?php } ?>
        </div>
    </form>



<<<<<<< HEAD

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


=======
>>>>>>> f2861112fab84533951956221425678771997717
