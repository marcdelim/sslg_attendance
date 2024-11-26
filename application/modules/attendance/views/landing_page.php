<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <div class="heading-left">
               
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="center">
                        <h1>Sto. Niño National High School - Supreme Secondary Learner Government </h1>
                        <h1>Time Logs</h1>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="current-time">
                                        <div class="center">
                                            <h1 id="datetime"></h1>
                                            <div class="center" id="my_camera"></div>
                                        </div>

                                        <form id="time_in_form">
                                            <div class="form-group col-md-12">
                                                <label><span style="color:red">*</span> <?= strtoupper(str_replace("_", " ", "Name")) ?></label>
                                                <select class="form-control name" name="sslg_officers_id" id="sslg_officers_id" required>
                                                   
                                                </select> <br>
                                            </div>
                                            <div class="center">
                                                <input type="button" value="Time In/Out" class="btn btn-success" onClick="take_snapshot()">
                                            </div>

                                            <input type="hidden" name="image" class="image-tag">
                                            <button class="btn btn-danger pull-right" hidden id="submit_btn"></button>
                                        </form>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>START DATE</label>
                                            <input type="date" class="form-control" name="start_date" id="start_date" value="<?php echo date('Y-m-d'); ?>" >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label> END DATE</label>
                                            <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="center">
                                            <input type="button" id="btn-generate" value="Generate" class="btn btn-success">
                                        </div>
                                    </div>
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