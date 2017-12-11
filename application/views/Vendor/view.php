<
<h4>Vendor Details</h4>
<?php foreach($vendors as $vendor){ ?>
<form class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-3 control-label">Name : </label>
        <label class="col-sm-7 control-label"><?php echo $vendor->name ?></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Address : </label>
        <label class="col-sm-7 control-label"><?php echo $vendor->address ?></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Email : </label>
        <label class="col-sm-7 control-label"><?php echo $vendor->email ?></label>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Phone Number : </label>
        <label class="col-sm-7 control-label"><?php echo $vendor->phone_number ?></label>
    </div>
   
</form>
<?php } ?>

