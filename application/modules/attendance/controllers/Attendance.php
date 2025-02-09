<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Attendance extends MX_Controller{
	private $smodule;
	public function __construct()
    {
        parent::__construct();
        $this->smodule = strtolower(__CLASS__);
        $this->load->module("core/app");
        $this->load->module("site/template");
        $this->load->model("sslg_officers/sslg_officers_model");
        
        $this->app->use_css(array("source"=>$this->environment->assets_path."site/css/plugins/dataTables/datatables.min.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/datatables.min.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/js/plugins/dataTables/dataTables.bootstrap4.min.js","cache"=>false));
        $this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/select2/css/select2.min.css","cache"=>false));
        $this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/select2/js/select2.min.js","cache"=>false));
		$this->app->use_css(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.css","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/sweetalert2/sweetalert2.js","cache"=>false));
		$this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/bootbox/bootbox.js","cache"=>false));
        $this->app->use_js(array("source"=>$this->environment->assets_path."site/plugins/jquery.validate.js","cache"=>false));
        $this->app->use_js(array("source"=>$this->smodule."/webcam","cache"=>false));
        $this->app->use_js(array("source"=>$this->smodule."/webcam_script","cache"=>false));
        
	}
    
	public function index(){
        $this->app->use_js(array("source"=>$this->smodule."/list","cache"=>false));
        $this->app->use_js(array("source"=>$this->smodule."/timein","cache"=>false));
        $this->app->use_js(array("source"=>$this->smodule."/view","cache"=>false));
        $this->app->use_js(array("source"=>$this->smodule."/curDateTime","cache"=>false));
        $this->app->use_js(array("source"=>$this->smodule."/sslg_officers","cache"=>false));
        $this->app->use_css(array("source"=>$this->smodule."/attendance","cache"=>false));
        
		$header['header_data'] = "SNNHS";
		$this->template->adminHeaderTpl($header);
		$this->template->adminSideBarTpl();
        $this->load->view('landing_page');
		$this->template->adminFooterTpl();
    }

    public function export(){
        
        
        $this->load->model('company_model');
        $data = array();
        $data = $this->company_model->list($data);
        
        if(!$data){
            exit("No records found!");
        }
        $header = array_keys($data[0]);
        $filename = "Company Export ".date('Y-m-d H_i_s');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($header, NULL ,'A1');
        $sheet->fromArray($data, NULL ,'A2');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}