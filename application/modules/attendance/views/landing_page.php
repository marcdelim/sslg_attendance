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
                    <div class="center">
                        <h1>Supreme Secondary Learner Government - Time Logs</h1>
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
                                                    <option value=""> -- Select Name --</option>
                                                    <?php foreach ($sslg_officers as $key => $val): ?>
                                                        <option value="<?= $val['id'] ?>"> <?= $val['full_name'] ?> </option>
                                                    <?php endforeach; ?>
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