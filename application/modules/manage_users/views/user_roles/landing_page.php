<?php
$acl = $this->session->userdata('role_functions');
$buttons = [
    "create" => [
        "enable" => in_array('user_roles_create',array_column($acl,'user_function')) ? true : false,
        "element" => '
            <button type="button" class="btn-xs btn btn-info" id="btn-create"><i class="fa fa-plus"></i>
                <span>Create</span>
            </button>'
    ]
];
?>


            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>User Roles</h2>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <?= $buttons['create']['enable'] === true ? $buttons['create']['element'] : "";?>
                                <div class="table-responsive">
                                    <table id="user-roles-list" class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
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