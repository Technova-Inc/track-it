<?php
class Consultation extends CI_Controller {
    private $nom;
    public function __construct(){
        parent::__construct();
        $this->load->model('Pc_model');
        $this->load->helper('url');
        $this->load->helper('form');
    }
    public function index()
    {
        $nomPc = $this->input->post_get('nomPc', TRUE);
        if($nomPc == NULL){
            $this->noPc();
        }else{
            $this->commun($nomPc);
        }
    }
    private function commun($nomPc){
        $this->load->view('structure/v_page_entete');
        $this->load->view('structure/v_page_menu');
        $data['pc'] = $this->Pc_model->get_Infos_cons_main($nomPc);
        $this->load->view('consultation/v_cons_main',$data);
        $this->load->view('consultation/v_cons_software');
        $data['network'] = $this->Pc_model->get_Infos_cons_network($nomPc);
        $this->load->view('consultation/v_cons_network',$data);
        $this->load->view('structure/v_page_pied');
    }
    private function noPc(){
        $this->load->view('structure/v_page_entete');
        $this->load->view('structure/v_page_menu');
        $this->load->view('consultation/v_cons_noPc');
        $this->load->view('structure/v_page_pied');
    }
}