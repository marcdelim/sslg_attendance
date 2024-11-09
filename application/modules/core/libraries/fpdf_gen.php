<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fpdf_gen {		
	public function __construct() {
		require_once APPPATH."modules/core/third_party_lib/fpdf181/fpdf.php";
		// require_once APPPATH."modules/core/third_party_lib/fpdf181/fpdf_alpha.php";
		//require_once APPPATH.'third_party/fpdf/fpdf-1.8.php';
		
		//$pdf = new FPDF();
		//$pdf->AddPage();
		
		$CI =& get_instance();
		$CI->fpdf = $pdf;
		
	}
}