<?php

/**
 * Description of family_model
 *
 * @author carlos
 */
class Payment_model extends CI_Model {

    public $FIELDS = [
        "id",
        "date",
        "amount",
        "piriod",
        "student_id",
        "payment_type_id"
    ];

    public function __construct() {
        parent::__construct();
        $this->client_id = $this->session->userdata('client_id');
    }

    public function get_all($student_id) {
        return $this->db->select("payment.*, payment_type.name AS payment_type_name")
                        ->from('payment')
                        ->join('payment_type', 'payment.payment_type_id = payment_type.id')
                        ->where('student_id', $student_id)
                        ->get()->result_array();
    }

    public function delete($id) {
        $this->db->delete('payment', 'id = ' . $id);
        return $id;
    }

    public function add($payment) {    
        $this->db->insert('payment', substract_fields($payment, $this->FIELDS));
        return $this->db->insert_id();
    }

    public function update($payment) {
        $id = $payment['id'];
        $cleanPayment = substract_fields($payment, $this->FIELDS);
        unset($cleanPayment['student_id']);
        $this->db->update('payment', $cleanPayment, 'id = ' . $id);
        return $id;
    }

}

/* End of file payment_model.php */
/* Location: ./application/models/payment_model.php */

