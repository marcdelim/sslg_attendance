<form id="user_profile_form">
    <div class="form-row">
        <?php foreach($profile_columns AS $key=>$val):?>
            <?php if($val['Field'] == "role_id"):?>
                <div class="form-group col-md-4">
                    <label>Role</label>
                    <select class="form-control" name='<?= $val['Field']?>'>
                        <?php foreach($user_roles as $urKey=>$urVal):?>
                            <option value="<?= $urVal['system_id']?>" <?= $user_details['role_id'] == $urVal['system_id'] ? "selected" : "" ?> ><?= $urVal['description']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            <?php elseif($val['Field'] == "id"):?>
                <input type="hidden" class="form-control" value="<?= $user_details['user_id']?>" name='<?= $val['Field']?>' id="<?= $val['Field']?>" <?= $val['Null'] == "NO" ? "required" : ""?>>
            <?php elseif($val['Field'] == "expiration_date"):?>
                <div class="form-group col-md-4">
                    <label>Expiration Date</label>
                    <input type="text" class="form-control datetimepicker" name='<?= $val['Field']?>' id="<?= $val['Field']?>" <?= $val['Null'] == "NO" ? "required" : ""?> value="<?= $user_details['expiration_date']?>">
                </div>
            <?php else:?>
                <div class="form-group col-md-4">
                    <label><?= $val['Null'] == "NO" ? '<span style="color:red">*</span>' : ""?> <?= ucwords(str_replace('_',' ',$val['Field']))?></label>
                    <input type="text" disabled="true" class="form-control" value="<?= $user_details[$val['Field']]?>" name='<?= $val['Field']?>' id="<?= $val['Field']?>" <?= $val['Null'] == "NO" ? "required" : ""?>>
                </div>
            <?php endif;?>
        <?php endforeach;?>
    </div>
</form>
<button class="btn btn-warning btn-reset-password"><i class="fa fa-refresh"></i> Reset Password</button>