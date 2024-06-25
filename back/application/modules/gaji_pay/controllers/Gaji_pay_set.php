<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gaji_pay_set extends CI_Controller
{

	public function __construct()
	{
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('gaji_pay/Gaji_pay_model', 'gaji/Gaji_model','logs/Logs_model'));
		$this->load->library('upload');
	}

	// gaji_pay view in list
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
			$params['gaji_pay_desc'] = $f['n'];
		}

		$paramsPage = $params;
		$params['limit'] = 100;
		$params['offset'] = $offset;
		$data['gaji_pay'] = $this->Gaji_pay_model->get($params);

		$config['per_page'] = 100;
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('manage/gaji_pay/index');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['total_rows'] = count($this->Gaji_pay_model->get($paramsPage));
		$this->pagination->initialize($config);

		$data['title'] = 'gaji_pay Umum';
		$data['main'] = 'gaji_pay/gaji_pay_list';
		$this->load->view('manage/layout', $data);
	}

	public function add_glob()
	{
		if ($_POST == TRUE) {
				$id = $_POST['gaji_id'];
				$params['gaji_pay_date'] = $this->input->post('gaji_pay_date');
				$params['gaji_gaji_id'] = $this->input->post('gaji_id');
				$params['guru_guru_id'] =  $this->input->post('guru_guru_id');
				$params['gaji_pay_value'] = $this->input->post('gaji_pay_value');
				$params['gaji_pay_desc'] = $this->input->post('gaji_pay_desc');
				$params['gaji_pay_input_date'] = date('Y-m-d H:i:s');
				$params['gaji_pay_last_update'] = date('Y-m-d H:i:s');
				$params['user_user_id'] = $this->session->userdata('uid');
				$this->Gaji_pay_model->add($params);
				$p = $this->db->query("SELECT SUM(gaji_pay_value) AS Total FROM gaji_pay where gaji_gaji_id = $id")->row_array();
				$tt = $p['Total'];
				$data = array(
				'gaji_id' => $id,
				'gaji_bill' => $tt,
				);
					$this->db->where('gaji_id', $id);
					$this->db->update('gaji', $data);	
				}
				$this->load->model('logs/Logs_model');
				$this->Logs_model->add(
					array(
						'log_date' => date('Y-m-d H:i:s'),
						'user_id' => $this->session->userdata('uid'),
						'log_module' => 'Bayar Gaji',
						'log_action' => 'Tambah',
						'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
					)
				);
		$this->session->set_flashdata('success', ' Pembayaran gaji Berhasil');
		redirect('manage/gaji');
	}

	// Add gaji_pay and Update
	public function add($id = NULL)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('gaji_pay_date', 'Tanggal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gaji_pay_value', 'Nilai', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gaji_pay_desc', 'Keterangan', 'trim|required|xss_clean');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
		$data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

		if ($_POST and $this->form_validation->run() == TRUE) {

			if ($this->input->post('gaji_pay_id')) {
				$params['gaji_pay_id'] = $this->input->post('gaji_pay_id');
			} else {
				$params['gaji_pay_input_date'] = date('Y-m-d H:i:s');
			}

			$params['gaji_pay_date'] = $this->input->post('gaji_pay_date');
			$params['gaji_gaji_id'] = $this->input->post('gaji_gaji_id');
			$params['guru_guru_id'] = $this->input->post('guru_guru_id');
			$params['gaji_pay_value'] = $this->input->post('gaji_pay_value');
			$params['gaji_pay_desc'] = $this->input->post('gaji_pay_desc');
			$params['gaji_pay_last_update'] = date('Y-m-d H:i:s');
			$params['user_user_id'] = $this->session->userdata('uid');

			$status = $this->Gaji_pay_model->add($params);
			$paramsupdate['gaji_pay_id'] = $status;
			$this->Gaji_pay_model->add($paramsupdate);

			$this->session->set_flashdata('success', $data['operation'] . ' Pengeluaran berhasil');
			redirect('manage/gaji_pay');
		} else {
			if ($this->input->post('gaji_pay_id')) {
				redirect('manage/gaji_pay/edit/' . $this->input->post('gaji_pay_id'));
			}

			// Edit mode
			if (!is_null($id)) {
				$data['gaji_pay'] = $this->Gaji_pay_model->get(array('id' => $id));
			}
			$data['title'] = $data['operation'] . ' Pengeluaran Umum';
			$data['main'] = 'gaji_pay/gaji_pay_add';
			$this->load->view('manage/layout', $data);
		}
	}


	// Delete to database
	public function delete($id = NULL)
	{
	
			$this->Gaji_pay_model->delete($id);
			// activity log

			$this->load->model('logs/Logs_model');
			$this->Logs_model->add(
				array(
					'log_date' => date('Y-m-d H:i:s'),
					'user_id' => $this->session->userdata('uid'),
					'log_module' => 'Bayar gaji Umum',
					'log_action' => 'Hapus',
					'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
				)
			);
			$this->session->set_flashdata('success', 'Hapus cicilan gaji Umum berhasil');
			redirect('manage/gaji');
		
	}
}

/* End of file Jurnal_set.php */
/* Location: ./application/modules/jurnal/controllers/Jurnal_set.php */