<?php
class Pc_model extends CI_Model {
/** 
 * Classe d'accès aux données 
 * Hérite de la classe CI_Model
 */

    public function __construct()
    {
        $this->load->database();
    }
    public function get_Infos_visu($nomPc){
        $this->db->select("*");
        $this->db->from('hardware');
        $this->db->where('NAME', $nomPc);
    }
}