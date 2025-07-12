<form id="frm-add">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","position"))?></label>
            <input type="text" class="form-control" name="position" id="position" required>
        </div>
        <div class="form-group col-md-12">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","full_name"))?></label>
            <input type="text" class="form-control" name="full_name" id="full_name" required>
        </div>
        <div class="form-group col-md-12">
            <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","password"))?></label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
    </div>
</form>