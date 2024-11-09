<?php
$acl = $this->session->userdata('role_functions');
$buttons = [
    "create" => [
        // "enable" => in_array('users_create',array_column($acl,'user_function')) ? true : false,
        "enable" => false,
        "element" => '
            <button type="button" class="btn-xs btn btn-info" id="btn-create"><i class="fa fa-plus"></i>
                <span>Create</span>
            </button>'
    ],
    "import" => [
        "enable" => in_array('users_create',array_column($acl,'user_function')) ? true : false,
        "element" => '
            <a class="btn-xs btn btn-info" href="'.base_url("manage_users/users/import").'"><i class="fa fa-upload"></i><span>Import</span></a>
            '
    ],
    "sync" => [
        // "enable" => in_array('users_create',array_column($acl,'user_function')) ? true : false,
        "enable" => false,
        "element" => '
            <button type="button" class="btn-xs btn btn-info" id="btn-sync"><i class="fa fa-refresh"></i>
                <span>Sync</span>
            </button>'
    ],
    "edit" => [
        "enable" => in_array('users_edit',array_column($acl,'user_function')) ? true : false
    ],
];
?>
            <span id='btn-edit-enable' style="display: none;"><?= $buttons['edit']['enable']?></span>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Users</h2>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <?= $buttons['create']['enable'] === true ? $buttons['create']['element'] : "";?>
                                <?= $buttons['import']['enable'] === true ? $buttons['import']['element'] : "";?>
                                <?= $buttons['sync']['enable'] === true ? $buttons['sync']['element'] : "";?>
                                <div class="table-responsive">
                                    <table id="users-list" class="table">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>Username</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Date Created</th>
                                                <th>Position</th>
                                                <th>Slspn Code</th>
                                                <th>Region</th>
                                                <th>Module</th>
                                                <th>Slspn BU</th>
                                                <th>Expiration Date</th>
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