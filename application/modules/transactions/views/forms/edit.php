<form class="form-horizontal" id="edit-transaction-form">
    <div class="form-group">
        <label class="col-sm-4 control-label">Transaction ID</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" disabled value="<?= $details['transaction_id']?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label"><span style="color:red">*</span> Description</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name='description' id="description" required value="<?= $details['description']?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label"><span style="color:red">*</span> School Year</label>
        <div class="col-sm-8">
            <div class="input-daterange input-group" data-provide="datepicker">
                <input type="text" class="input-sm form-control datetimepicker" name="start" id="start" required value="<?= explode('-',$details['school_year'])[0]?>">
                <span class="input-group-addon">to</span>
                <input type="text" class="input-sm form-control datetimepicker" name="end" id="end" required value="<?= explode('-',$details['school_year'])[1]?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label"><span style="color:red">*</span> Previous Year</label>
        <div class="col-sm-8">
            <input type="text" class="form-control datetimepicker" name='previous_year' id="previous_year" required value="<?= $details['previous_year']?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label"><span style="color:red">*</span> Current Year</label>
        <div class="col-sm-8">
            <input type="text" class="form-control datetimepicker" name='current_year' id="current_year" required value="<?= $details['current_year']?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label"><span style="color:red">*</span> Next year</label>
        <div class="col-sm-8">
            <input type="text" class="form-control datetimepicker" name='next_year' id="next_year" required value="<?= $details['next_year']?>">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4 control-label">Status</label>
        <div class="col-sm-8">
            <select name='status' id="status" class="form-control">
                <option value="inactive" <?= $details['status_code'] == "inactive" ? "selected" : ""?> >Inactive</option>
                <option value="active" <?= $details['status_code'] == "active" ? "selected" : ""?> >Active</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4 control-label">Locked</label>
        <div class="col-sm-8">
            <select name='locked' id="locked" class="form-control">
                <option value="1" <?= $details['locked'] == "1" ? "selected" : ""?> >Locked</option>
                <option value="0" <?= $details['locked'] == "0" ? "selected" : ""?> >Unlocked</option>
            </select>
        </div>
    </div>
</form>