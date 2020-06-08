<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';
	}

	public function index()
	{
		$this->load->view('admin/overview.php');
	}

	public function about()
	{
		$this->load->view('about.php');
	}

	public function contact()
	{
		$this->load->view('contact.php');
	}

	public function cetakLaporan(){
		$data['sekolah2'] = $this->db->query("SELECT *FROM sekolah2 ORDER BY id DESC")->result();
		$dompdf = new DOMPDF();

		
		$html = $this->load->view('welcome_message',$data,true);

		$dompdf->load_html($html);

		$dompdf->set_paper('A4','Lanscape');

		$dompdf->render();

		$pdf = $dompdf->output();

		$dompdf->stream('Laporan.pdf',array("attachment" => false));
	}
}
