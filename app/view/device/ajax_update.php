
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="gridSystemModalLabel">Edit Device</h4>
</div>
<div class="modal-body">
  <form class="" action="/device/ajax_update_save/<?php echo $formdata->iddevices; ?>" id="submit-device-update" method="post">
    <div class="row">
      <div class="col-md-12" id="response"><div class="message alert"></div></div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="category">Category:</label>
          <select id="category" name="category" class="form-control selectpicker" data-live-search="true" title="Choose category...">
            <?php foreach($categories as $cluster){ ?>
            <optgroup label="<?php echo $cluster->name; ?>">
              <?php foreach($cluster->categories as $c){ ?>
              <option value="<?php echo $c->idcategories; ?>" <?php if($c->idcategories == $formdata->category){ echo " selected"; } ?>><?php echo $c->name; ?></option>
              <?php } ?>
            </optgroup>
            <?php } ?>
            <option value="46" <?php if($formdata->category == 46){ echo " selected"; } ?>>Misc</option>
          </select>
        </div>
        <div class="form-group">
          <label for="estimate">Estimate (if any):</label>
          <div class="input-group">
            <input type="text" class="form-control " id="estimate" name="estimate" placeholder="Estimate..." value="<?php echo $formdata->estimate; ?>">
            <span class="input-group-addon">kg</span>
          </div>
          <span class="help-block">This field should contain digits only, a weight expressed in kg, and only if the category is "Misc"</span>
        </div>
        <div class="form-group">
          <label for="brand">Brand:</label>
          <input type="text" class="form-control " id="brand" name="brand" placeholder="Brand..." value="<?php echo $formdata->brand; ?>">
        </div>
        <div class="form-group">
          <label for="model">Model:</label>
          <input type="text" class="form-control " id="model" name="model" placeholder="Model..." value="<?php echo $formdata->model; ?>">
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="problem">Problem:</label>
          <textarea class="form-control" rows="4" id="problem" name="problem" placeholder="Problem..."><?php echo $formdata->problem; ?></textarea>
        </div>
        <div class="form-group"></div>
        <div class="form-group"></div>
      </div>


    </div>
  </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-primary" id="save-device-update"><i class="fa fa-floppy"></i> Save changes</button>
</div>
