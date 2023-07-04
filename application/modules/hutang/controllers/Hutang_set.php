<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hutang_set extends CI_Controller
{

	public function __construct()
	{
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('hutang/Hutang_model', 'logs/Logs_model'));
		$this->load->library('upload');
	}

	// hutang view in list
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
			$params['hutang_desc'] = $f['n'];
		}

		$paramsPage = $params;
		$params['limit'] = 100;
		$params['offset'] = $offset;
		$data['hutang'] = $this->Hutang_model->get($params);

		$config['per_page'] = 100;
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('manage/hutang/index');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['total_rows'] = count($this->Hutang_model->get($paramsPage));
		$this->pagination->initialize($config);

		$data['title'] = 'Hutang Umum';
		$data['main'] = 'hutang/hutang_list';
		$this->load->view('manage/layout', $data);
	}

	public function add_glob()
	{
		if ($_POST == TRUE) {
			$krValue = str_replace('.', '', $_POST['hutang_value']);
			$krDesc = $_POST['hutang_desc'];
			$cpt = count($_POST['hutang_value']);
			for ($i = 0; $i < $cpt; $i++) {
				$params['hutang_date'] = $this->input->post('hutang_date');
				$params['hutang_value'] = $krValue[$i];
				$params['hutang_desc'] = $krDesc[$i];
				$params['hutang_input_date'] = date('Y-m-d H:i:s');
				$params['hutang_last_update'] = date('Y-m-d H:i:s');
				$params['user_user_id'] = $this->session->userdata('uid');

				$this->Hutang_model->add($params);
			}
		}
		$this->load->model('logs/Logs_model');
		$this->Logs_model->add(
			array(
				'log_date' => date('Y-m-d H:i:s'),
				'user_id' => $this->session->userdata('uid'),
				'log_module' => 'Tambah Utang',
				'log_action' => 'Tambah',
				'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
			)
		);
		$this->session->set_flashdata('success', ' Tambah Pengeluaran Berhasil');
		redirect('manage/hutang');
	}

	// Add hutang and Update
	public function add($id = NULL)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('hutang_date', 'Tanggal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('hutang_value', 'Nilai', 'trim|required|xss_clean');
		$this->form_validation->set_rules('hutang_desc', 'Keterangan', 'trim|required|xss_clean');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
		$data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

		if ($_POST and $this->form_validation->run() == TRUE) {

			if ($this->input->post('hutang_id')) {
				$params['hutang_id'] = $this->input->post('hutang_id');
			} else {
				$params['hutang_input_date'] = date('Y-m-d H:i:s');
			}

			$params['hutang_date'] = $this->input->post('hutang_date');
			$params['hutang_value'] = $this->input->post('hutang_value');
			$params['hutang_desc'] = $this->input->post('hutang_desc');
			$params['hutang_last_update'] = date('Y-m-d H:i:s');
			$params['user_user_id'] = $this->session->userdata('uid');

			$status = $this->Hutang_model->add($params);
			$paramsupdate['hutang_id'] = $status;
			$this->Hutang_model->add($paramsupdate);

			$this->session->set_flashdata('success', $data['operation'] . ' Pengeluaran berhasil');
			redirect('manage/hutang');
		} else {
			if ($this->input->post('hutang_id')) {
				redirect('manage/hutang/edit/' . $this->input->post('hutang_id'));
			}

			// Edit mode
			if (!is_null($id)) {
				$data['hutang'] = $this->Hutang_model->get(array('id' => $id));
			}
			$data['title'] = $data['operation'] . ' Pengeluaran Umum';
			$data['main'] = 'hutang/hutang_add';
			$this->load->view('manage/layout', $data);
		}
	}


	// Delete to database
	public function delete($id = NULL)
	{
		if ($_POST) {
			$this->Hutang_model->delete($id);
			// activity log
			$this->load->model('logs/Logs_model');
			$this->Logs_model->add(
				array(
					'log_date' => date('Y-m-d H:i:s'),
					'user_id' => $this->session->userdata('uid'),
					'log_module' => 'Hutang Umum',
					'log_action' => 'Hapus',
					'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
				)
			);
			$this->session->set_flashdata('success', 'Hapus Pengeluaran Umum berhasil');
			redirect('manage/hutang');
		} elseif (!$_POST) {
			$this->session->set_flashdata('delete', 'Delete');
			redirect('manage/hutang/edit/' . $id);
		}
	}
}

/* End of file Jurnal_set.php */
/* Location: ./application/modules/jurnal/controllers/Jurnal_set.php */