<?php
class Consultation extends CI_Controller {
    private $idPc;

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
        $data = array(
            'os_name' => 'Windows 10',
            'os_version' => '10.0.19042',
            'architecture' => 'x64',
            'windows_user' => 'John Doe',
            'windows_license' => 'Licensed',
            'windows_key' => 'XXXXX-XXXXX-XXXXX-XXXXX',
            'swap' => '16 GB',
            'memory' => '8 GB',
            'uuid' => '123e4567-e89b-12d3-a456-426614174000',
            'domain' => 'example.com',
            'ip_address' => '192.168.1.1',
            'user_agent' => 'John Doe',
            'last_inventory' => '2024-11-21',
            'last_contact' => '2024-11-21',
            'disk_id' => 1 // Ajoutez l'ID du disque ici
        );
        $this->load->view('structure/v_page_entete');
        $this->load->view('structure/v_page_menu');
        $data['titre'] = 'Mon Super PC';
        $this->load->view('structure/v_sep_entete',$data);
        $this->load->view('pc/system_view', $data);
        $this->load->view('pc/hardware_view', $data);
        $this->load->view('pc/network_view', $data);
        $this->load->view('pc/agent_view', $data);
        $this->load->view('pc/note_view', $data);
        $this->load->view('pc/disk_load_view', $data); // Ajoutez cette ligne pour charger la vue du disque
        $this->load->view('structure/v_sep_pied');
        $this->load->view('structure/v_page_pied');
    }
}