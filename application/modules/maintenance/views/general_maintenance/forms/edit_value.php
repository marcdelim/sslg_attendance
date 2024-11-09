<input type="hidden" id="id" name="id" value="<?= $details['id']?>">
<form class="row" id="form-edit-value-details">
    <div class="col-md-12">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Code</label>
                <input type="text" class="form-control" value="<?= $details['code']?>" disabled='true'>
            </div>
            <div class="form-group col-md-12">
                <label>Name</label>
                <input type="text" class="form-control" value="<?= $details['name']?>" name="name" id="name" required>
            </div>
            <div class="form-group col-md-12">
                <label>Description</label>
                <input type="text" class="form-control" value="<?= $details['description']?>" name="description" id="description" required>
            </div>
            <div class="form-group col-md-12">
                <label>Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="active" <?= $details['status'] == "active" ? "selected='true'" : ""?> >Active</option>
                    <option value="in_active" <?= $details['status'] == "in_active" ? "selected='true'" : ""?> >In-Active</option>
                </select>
            </div>
        </div>
    </div>
</form>