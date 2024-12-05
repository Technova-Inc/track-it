<?php
class Dashboard extends CI_Controller {
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
        $this->load->view('structure/v_page_entete');
        $this->load->view('structure/v_page_menu');
        
        $this->load->view('v_dashboard');
        
    }
   
}