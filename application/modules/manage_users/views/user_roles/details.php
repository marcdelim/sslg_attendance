<?php
$acl = $this->session->userdata('role_functions');
$buttons = [
    "edit" => [
        "enable" => in_array('user_roles_edit',array_column($acl,'user_function')) ? true : false,
        "element" => '<button class="btn-xs btn btn-info" id="btn-add"><i class="fa fa-plus"></i> Add</button>'
    ]
];
?>
<span id='btn-edit-enable' style="display: none;"><?= $buttons['edit']['enable']?></span>
<input type="hidden" id="user_role_id" value="<?= $user_role_id?>">
<span id='btn-edit-enable' style="display: none;"><?= $buttons['edit']['enable']?></span>
<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <div class="heading-left">
                <h1 class="page-title">User Roles </h1>
                <p class="page-subtitle">Details</p>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <p class="demo-button pull-left">
                        <button style="display: none;" class="btn-sm btn btn-danger pull-right" id="btn-upload-delivery"><i class="fa fa-upload"></i> Upload Delivery Status</button>
                        <button style="display: none;" class="btn-sm btn btn-danger pull-right" id="btn-create"><i class="fa fa-plus"></i> Create Order</button>
                    </p>
                    <p class="demo-button pull-right">
                        <button style="display: none;" class="btn-sm btn btn-warning pull-right" id="btn-delete"><i class="fa fa-trash"></i> Delete</button>
                    </p>
                </div>
                <div class="col-md-5">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="pull-right">
                                    <?php if($buttons['edit']['enable'] === true):?>
                                        <button class="btn-xs btn btn-info" id="btn-edit-dtls"><i class="fa fa-edit"></i> Edit</button>
                                    <?php endif;?>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Role Name</label>
                                            <input type="text" class="form-control" id="dtls_name" disabled>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Description</label>
                                            <textarea class="form-control" id="dtls_description" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class="button-model">
                                        <?php if($buttons['edit']['enable'] === true):?>
                                            <button class="btn-xs btn btn-info pull-right" id="btn-add"><i class="fa fa-plus"></i> Add</button>
                                        <?php endif;?>
                                    </p>
                                    <br>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                                        <table class="table table-hover" id="tbl-functions">
                                            <thead>
                                                <tr>
                                                    <th>Module Name</th>
                                                    <th>Function</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>