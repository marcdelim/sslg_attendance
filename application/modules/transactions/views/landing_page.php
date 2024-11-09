<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <div class="heading-left">
                <h1 class="page-title">Transactions</h1>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">List</h3>
                            <div class="pull-right">
                                <button class="btn-xs btn btn-info" id="btn-create"><i class="fa fa-plus"></i> Create</button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-row" id="formFilters">
                                <div class="form-group col-md-3">
                                    <label>Transaction ID</label>
                                    <input type="text" name="transaction_id" id="transaction_id" class="form-control tblFilter">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Description</label>
                                    <input type="text" name="description" id="description" class="form-control tblFilter">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>School Year</label>
                                    <input type="text" name="school_year" id="school_year" class="form-control tblFilter">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Status</label>
                                    <input type="text" name="status" id="status" class="form-control tblFilter">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-hover" id="tbl-transactions">
                                        <thead>
                                            <tr>
                                                <th>Transaction ID</th>
                                                <th>Description</th>
                                                <th>School Year</th>
                                                <th>Status</th>
                                                <th>Locked</th>
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