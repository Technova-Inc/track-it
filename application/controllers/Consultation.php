<?php
class Consultation extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Pc_model');
        $this->load->helper('url');
        $this->load->helper('form');
    }
    public function index()
    {
        $this->commun();
    }
    private function commun(){
        $nomPc = "322-ACR-M4630G";
        $data['pc'] = $this->Pc_model->get_Infos_cons_main($nomPc);
        $this->load->view('structure/v_page_entete');
        $this->load->view('structure/v_page_menu');
        $this->load->view('consultation/v_cons_main',$data);
        $this->load->view('consultation/v_cons_software');
        $this->load->view('structure/v_page_pied');
    }
}