<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Customer extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->helper('url');
    }
    
    public function index() {
        $data['customers'] = $this->customer_model->get_customers();
        $this->load->view('customer_list', $data);
    }
    
    public function visualisasi() {
        $customers = $this->customer_model->get_customers();
        
        $customer_counts = array();
        $gender_counts = array();
    
        foreach ($customers as $customer) {
            $kab_kota = $customer['kab_kota'];
            $jenis_kelamin = $customer['jenis_kelamin'];
            
            // Count customers by city
            if (isset($customer_counts[$kab_kota])) {
                $customer_counts[$kab_kota]++;
            } else {
                $customer_counts[$kab_kota] = 1;
            }
            
            // Count customers by gender
            if (isset($gender_counts[$jenis_kelamin])) {
                $gender_counts[$jenis_kelamin]++;
            } else {
                $gender_counts[$jenis_kelamin] = 1;
            }
        }
    
        $data['customer_counts'] = $customer_counts;
        $data['gender_counts'] = $gender_counts;
        $this->load->view('visualisasi', $data);
    }
    

    public function add() {
        if ($this->input->post()) {
            $data = array(
                'nama' => $this->input->post('nama'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'provinsi' => $this->input->post('provinsi'),
                'kab_kota' => $this->input->post('kab_kota'),
                'kecamatan' => $this->input->post('kecamatan'),
                'desa' => $this->input->post('desa')
            );
            $this->customer_model->insert_customer($data);
    
            // Get the updated customer list
            $data['customers'] = $this->customer_model->get_customers();
            $customer_list_html = $this->load->view('customer_list', $data, TRUE);
    
            // Return the updated customer list HTML content
            echo $customer_list_html;
        } else {
            $this->load->view('add_customer');
        }
    }
    
    public function edit($id) {
        if ($this->input->post()) {
            $data = array(
                'nama' => $this->input->post('nama'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'pekerjaan' => $this->input->post('pekerjaan'),
                'provinsi' => $this->input->post('provinsi'),
                'kab_kota' => $this->input->post('kab_kota'),
                'kecamatan' => $this->input->post('kecamatan'),
                'desa' => $this->input->post('desa')
            );
            $this->customer_model->update_customer($id, $data);
            redirect('customer'); // Redirect back to the customer list
        } else {
            $data['customer'] = $this->customer_model->get_customer_by_id($id);
            $this->load->view('edit_customer', $data); // Load the edit view
        }
    }
    
    public function delete($id) {
        $this->customer_model->delete_customer($id);
        redirect('customer');
    }
}
?>