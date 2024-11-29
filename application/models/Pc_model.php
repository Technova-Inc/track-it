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
    /**
     * Méthode permettant de récupérer les informations pour l'affichage des informations général d'un PC
     * @params $nomPc => Le nom du pc
     * @return Tableau avec les informations du pc
     */
    public function get_Infos_cons_main($nomPc){
        $this->db->select("*");
        $this->db->from('hardware');
        $this->db->where('NAME', $nomPc);
        return $this->db->get()->result_array();
    }
    public function get_Infos_cons_network($nomPc){
        $this->db->select("*");
        $this->db->from('networks');
        $this->db->join('hardware', 'hardware.ID = networks.HARDWARE_ID');
        $this->db->where('hardware.NAME', $nomPc);
        return $this->db->get()->result_array();
    }
    public function get_Infos_cons_software($nomPc){
        $this->db->select("*");
        $this->db->from('software');
        $this->db->join('hardware', 'hardware.ID = software.HARDWARE_ID');
        $this->db->join('software_types', 'software_types.ID = software.SOFTWARE_TYPE_ID');
        $this->db->where('hardware.NAME', $nomPc);
        return $this->db->get()->result_array();
    }
}