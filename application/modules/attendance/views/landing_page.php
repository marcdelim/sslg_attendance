<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <div class="heading-left">
                <h1 class="page-title">Sto. Niño National High School</h1>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="demo">
                                <button disabled="true" class="btn btn-primary" id="btn-import"><i class="fa fa-upload"></i> Import</button>
                                |
                                <button disabled="true" class="btn btn-success" id="btn-add"><i class="fa fa-plus"></i> Add</button>
                                |
                                <button class="btn btn-warning" id="btn-export"><i class="fa fa-download"></i> Export</button>
                                |
                                <!-- <a target="blank" href="<?= base_url('company/export') ?>" class="btn btn-warning"><i class="fa fa-download"></i> Export All</a>
                                |   -->
                                <a href="<?= base_url('company/template') ?>" class="btn btn-info"><i class="fa fa-download"></i> Download Template</a>

                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="demo">

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"> 
                    <div class="row">
                    <div class="col-md-6">
                        <h2>Supreme Secondary Learner Government - Time Logs</h2>

                            <div class="current-time">
                                <h1 id="datetime"></h1>
                                <div id="my_camera"></div>
                                <form id="time_in_form">
                                    <div class="form-group col-md-12">
                                        <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","Full Name"))?></label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><span style="color:red">*</span> <?= strtoupper(str_replace("_"," ","Position"))?></label>
                                        <input type="text" class="form-control" name="position" id="position" required>
                                    </div>

                                    <input type="hidden" name="image" class="image-tag">
                                    <input type=button value="Time In"  class="btn btn-success" onClick="take_snapshot()">

                                    <button class="btn btn-danger pull-right" hidden id="submit_btn"></button>
                                </form>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="tbl-list" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?= strtoupper(str_replace("_", " ", "id")) ?></th>
                                                <th><?= strtoupper(str_replace("_", " ", "name")) ?></th>
                                                <th><?= strtoupper(str_replace("_", " ", "position")) ?></th>
                                                <th><?= strtoupper(str_replace("_", " ", "time_in")) ?></th>
                                                <th><?= strtoupper(str_replace("_", " ", "time_out")) ?></th>
                                                <th><?= strtoupper(str_replace("_", " ", "view")) ?></th>
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