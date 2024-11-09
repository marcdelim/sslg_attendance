<form class="form-horizontal" id="create-user-form">
    <?php foreach($profile_columns AS $key=>$val):?>
        <?php if($val['Field'] == "role_id"):?>
            <div class="form-group">
                <label class="col-sm-4 control-label"><span style="color:red">*</span> Role</label>
                <div class="col-sm-8">
                    <select class="form-control" name='user_role' id="user_role">
                        <?php foreach($user_roles as $urKey=>$urVal):?>
                            <option value="<?= $urVal['system_id']?>"><?= $urVal['description']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
        <?php else:?>
            <div class="form-group">
                <label class="col-sm-4 control-label"><?= $val['Null'] == "NO" ? '<span style="color:red">*</span>' : ""?> <?= ucwords(str_replace('_',' ',$val['Field']))?></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name='<?= $val['Field']?>' id="<?= $val['Field']?>" <?= $val['Null'] == "NO" ? "required" : ""?>>
                </div>
            </div>
        <?php endif;?>
    <?php endforeach;?>
</form>