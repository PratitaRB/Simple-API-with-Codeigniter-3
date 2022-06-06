<?php 
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Siswa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('Siswa_model','siswa');
    }


    public function index_get()
    {
        $id = $this->get('id');
        if ($id == '') {
            $siswa = $this->db->get('siswa')->result();
        } else {
            $this->db->where('id', $id);
            $siswa = $this->db->get('siswa')->result();
        }
        $this->response($siswa, REST_Controller::HTTP_OK);
    }

    public function index_post()
    {
        $data = array(
            'firstname' => $this->post('firstname'),
            'lastname' => $this->post('lastname'),
            'jurusan' => $this->post('jurusan')
        );
        $insert = $this->db->insert('siswa', $data);
        if ($insert) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = array(
            'firstname' => $this->put('firstname'),
            'lastname' => $this->put('lastname'),
            'jurusan' => $this->put('jurusan')
        );
        $this->db->where('id', $id);
        $update = $this->db->update('siswa', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');
        $this->db->where('id',$id);
        $delete = $this->db->delete('siswa');
        if ($delete) {
            $this->response(array('status' => 'sukses'), 201);
        } else {
            $this->response(array('status' => 'gagal'), 502);
        }
    }
}