<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("product_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["sekolah"] = $this->product_model->getAll();
        $this->load->view("sekolah/admin/product/list", $data);
    }

    public function add()
    {
        $product = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("sekolah/admin/product/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('sekolah/admin/products');
       
        $product = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["product"] = $product->getById($id);
        if (!$data["product"]) show_404();
        
        $this->load->view("sekolah/admin/product/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->product_model->delete($id)) {
            redirect(site_url('sekolah/admin/products'));
        }
    }
    public function cetak(){    
        ob_start();    
        $data["sekolah"] = $this->product_model->getAll();    
        $this->load->view('print', $data);    
        $html = ob_get_contents();        
        ob_end_clean();                
        require_once('./assets/html2pdf/html2pdf.class.php');    
        $pdf = new HTML2PDF('P','A4','en');    
        $pdf->WriteHTML($html);    
        $pdf->Output('Data Siswa.pdf', 'D');  }
}
