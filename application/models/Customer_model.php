<?php
class Customer_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_customer_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('customers')->row_array();
    }

    public function get_customers() {
        return $this->db->get('customers')->result_array();
    }
    
    public function insert_customer($data) {
        $this->db->insert('customers', $data);
    }
    
    public function update_customer($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('customers', $data);
    }
    
    public function delete_customer($id) {
        $this->db->where('id', $id);
        $this->db->delete('customers');
    }
}
?>
