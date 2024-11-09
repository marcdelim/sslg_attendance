<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <div class="heading-left">
                <h1 class="page-title">Manage Users</h1>
                <p class="page-subtitle">Import users</p>
            </div>
        </div>
        <div class="container-fluid">
            <div class="panel">
                <div class="panel-heading">
                    <button class="btn btn-info btn-xs" id="btn-add-users"><i class="fa fa-plus"></i><span>Add</span></button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-row" id="formFilters">
                                <div class="form-group col-md-2">
                                    <label>Sales Persons Code</label>
                                    <input type="text" name="sales_person_code" id="sales_person_code" class="form-control tblFilter">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Region</label>
                                    <input type="text" name="region" id="region" class="form-control tblFilter">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <table id="sso-users-list" class="table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="chkBox-select-all"></th>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Department</th>
                                        <th>Company</th>
                                        <th>SP Code</th>
                                        <th>Region</th>
                                        <th>Business Unit</th>
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