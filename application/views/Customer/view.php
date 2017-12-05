
<h4>Personal Details</h4>
<?php foreach($customers as $customer){ ?>
<form class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-3 control-label">Name : </label>
        <label class="col-sm-7 control-label"><?php echo $customer->name ?></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Address : </label>
        <label class="col-sm-7 control-label"><?php echo $customer->address ?></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Email : </label>
        <label class="col-sm-7 control-label"><?php echo $customer->email ?></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Phone Number : </label>
        <label class="col-sm-7 control-label"><?php echo $customer->phone_number ?></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Projects : </label>
        <?php foreach ($projects as $project) { ?>
        <label class="col-sm-10 control-label"><?php echo $project->project_id ?></label>
    <?php } ?>
    </div>
</form>
<?php } ?>


                