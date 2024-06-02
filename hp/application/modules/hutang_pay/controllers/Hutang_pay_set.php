<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hutang_pay_set extends CI_Controller
{

	public function __construct()
	{
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('hutang_pay/Hutang_pay_model', 'hutang/Hutang_model','logs/Logs_model'));
		$this->load->library('upload');
	}

	// hutang_pay view in list
	public function index($offset = NULL)
	{
		$this->load->library('pagination');
		// Apply Filter
		// Get $_GET variable
		$f = $this->input->get(NULL, TRUE);

		$data['f'] = $f;

		$params = array();
		// Nip
		if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
			$params['hutang_pay_desc'] = $f['n'];
		}

		$paramsPage = $params;
		$params['limit'] = 100;
		$params['offset'] = $offset;
		$data['hutang_pay'] = $this->Hutang_pay_model->get($params);

		$config['per_page'] = 100;
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('manage/hutang_pay/index');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['total_rows'] = count($this->Hutang_pay_model->get($paramsPage));
		$this->pagination->initialize($config);

		$data['title'] = 'hutang_pay Umum';
		$data['main'] = 'hutang_pay/hutang_pay_list';
		$this->load->view('manage/layout', $data);
	}

	public function add_glob()
	{
		if ($_POST == TRUE) {
			$krValue = str_replace('.', '', $_POST['hutang_pay_value']);
			$krDesc = $_POST['hutang_pay_desc'];
			$id = $_POST['hutang_id'];
			$cpt = count($_POST['hutang_pay_value']);
			for ($i = 0; $i < $cpt; $i++) {
				$params['hutang_pay_date'] = $this->input->post('hutang_pay_date');
				$params['hutang_hutang_id'] = $id[$i];
				$params['hutang_pay_value'] = $krValue[$i];
				$params['hutang_pay_desc'] = $krDesc[$i];
				$params['hutang_pay_input_date'] = date('Y-m-d H:i:s');
				$params['hutang_pay_last_update'] = date('Y-m-d H:i:s');
				$params['user_user_id'] = $this->session->userdata('uid');
				$this->Hutang_pay_model->add($params);
				
			}
		
		$p = $this->db->query("SELECT SUM(hutang_pay_value) AS Total FROM hutang_pay where hutang_hutang_id = $id")->row_array();
    	$tt = $p['Total'];
		$data = array(
		'hutang_id' => $id,
		'hutang_bill' => $tt,
		);
			$this->db->where('hutang_id', $id);
			$this->db->update('hutang', $data);	
		}
		$this->load->model('logs/Logs_model');
		$this->Logs_model->add(
			array(
				'log_date' => date('Y-m-d H:i:s'),
				'user_id' => $this->session->userdata('uid'),
				'log_module' => 'Bayar Utang Umum',
				'log_action' => 'Tambah',
				'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
			)
		);
		$this->session->set_flashdata('success', ' Pembayaran Hutang Berhasil');
		redirect('manage/hutang');
	}

	// Add hutang_pay and Update
	public function add($id = NULL)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('hutang_pay_date', 'Tanggal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('hutang_pay_value', 'Nilai', 'trim|required|xss_clean');
		$this->form_validation->set_rules('hutang_pay_desc', 'Keterangan', 'trim|required|xss_clean');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
		$data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

		if ($_POST and $this->form_validation->run() == TRUE) {

			if ($this->input->post('hutang_pay_id')) {
				$params['hutang_pay_id'] = $this->input->post('hutang_pay_id');
			} else {
				$params['hutang_pay_input_date'] = date('Y-m-d H:i:s');
			}

			$params['hutang_pay_date'] = $this->input->post('hutang_pay_date');
			$params['hutang_hutang_id'] = $this->input->post('hutang_hutang_id');
			$params['hutang_pay_value'] = $this->input->post('hutang_pay_value');
			$params['hutang_pay_desc'] = $this->input->post('hutang_pay_desc');
			$params['hutang_pay_last_update'] = date('Y-m-d H:i:s');
			$params['user_user_id'] = $this->session->userdata('uid');

			$status = $this->Hutang_pay_model->add($params);
			$paramsupdate['hutang_pay_id'] = $status;
			$this->Hutang_pay_model->add($paramsupdate);

			$this->session->set_flashdata('success', $data['operation'] . ' Pengeluaran berhasil');
			redirect('manage/hutang_pay');
		} else {
			if ($this->input->post('hutang_pay_id')) {
				redirect('manage/hutang_pay/edit/' . $this->input->post('hutang_pay_id'));
			}

			// Edit mode
			if (!is_null($id)) {
				$data['hutang_pay'] = $this->Hutang_pay_model->get(array('id' => $id));
			}
			$data['title'] = $data['operation'] . ' Pengeluaran Umum';
			$data['main'] = 'hutang_pay/hutang_pay_add';
			$this->load->view('manage/layout', $data);
		}
	}


	// Delete to database
	public function delete($id = NULL)
	{
	
			$this->Hutang_pay_model->delete($id);
			// activity log

			$this->load->model('logs/Logs_model');
			$this->Logs_model->add(
				array(
					'log_date' => date('Y-m-d H:i:s'),
					'user_id' => $this->session->userdata('uid'),
					'log_module' => 'Bayar Hutang Umum',
					'log_action' => 'Hapus',
					'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
				)
			);
			$this->session->set_flashdata('success', 'Hapus cicilan hutang Umum berhasil');
			redirect('manage/hutang');
		
	}
}

/* End of file Jurnal_set.php */
/* Location: ./application/modules/jurnal/controllers/Jurnal_set.php */