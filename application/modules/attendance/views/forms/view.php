<form id="frm-edit">
    <div class="form-row">

        <div class="form-group col-md-6">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","full_name"))?></label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($details['full_name']) ?>" readonly>
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
            <div class="imageContainer">
                <img alt="image" height="170" width="170" src="<?=$assets_path.'attendance/uploads/'.$details['id'].'_time_in.png'; ?>"  alt="tab1" class="img img-responsive"/>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","time_out"))?></label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($details['time_out']) ?>"  readonly>
        </div>
        <div class="form-group col-md-6">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","time_out_image"))?></label>
            <div class="imageContainer">
                <img alt="time_out" height="170" width="170" src="<?=$assets_path.'attendance/uploads/'.$details['id'].'_time_out.png'; ?>"  alt="tab1" class="img img-responsive"/>
            </div>
        </div>

    </div>
</form>