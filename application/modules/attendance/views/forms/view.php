<form id="frm-edit">
    <div class="form-row">

        <div class="form-group col-md-6">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","name"))?></label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($details['name']) ?>" readonly>
        </div>

        <div class="form-group col-md-6">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","position"))?></label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($details['position']) ?>" readonly>
        </div>
        <div class="form-group col-md-6">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","time_in"))?></label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($details['time_in']) ?>"  readonly>
        </div>
        <div class="form-group col-md-6">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","time_in_image"))?></label>
            <img alt="image" height="170" width="170" src="<?=$assets_path.'attendance/uploads/'.$details['id'].'.png'; ?>"  alt="tab1" class="img img-responsive"/>
        </div>
        <div class="form-group col-md-6">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","time_out"))?></label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($details['time_out']) ?>"  readonly>
        </div>
        <div class="form-group col-md-6">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","time_out_image"))?></label>
            <img alt="image" height="170" width="170" src="<?=$assets_path.'attendance/uploads/'.$details['id'].'.png'; ?>"  alt="tab1" class="img img-responsive"/>
        </div>

    </div>
</form>