<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gaji_set extends CI_Controller
{

	public function __construct()
	{
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('gaji/Gaji_model','gaji_pay/Gaji_pay_model', 'logs/Logs_model'));
		$this->load->library('upload');
	}

	// gaji view in list
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
			$params['gaji_desc'] = $f['n'];
		}

		$paramsPage = $params;
		$params['limit'] = 100;
		$params['offset'] = $offset;
		$data['gaji'] = $this->Gaji_model->get($params);

		$config['per_page'] = 100;
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('manage/gaji/index');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['total_rows'] = count($this->Gaji_model->get($paramsPage));
		$this->pagination->initialize($config);

		$data['title'] = 'Gaji Karyawan';
		$data['main'] = 'gaji/gaji_list';
		$this->load->view('manage/layout', $data);
	}

	public function add_glob()
	{
		if ($_POST == TRUE) {
			$krValue = str_replace('.', '', $_POST['gaji_value']);
			$krDesc = $_POST['gaji_desc'];
			$cpt = count($_POST['gaji_value']);
			for ($i = 0; $i < $cpt; $i++) {
				$params['gaji_date'] = $this->input->post('gaji_date');
				$params['gaji_value'] = $krValue[$i];
				$params['gaji_desc'] = $krDesc[$i];
				$params['gaji_jenis'] = $this->input->post('gaji_jenis');
				$params['gaji_input_date'] = date('Y-m-d H:i:s');
				$params['gaji_last_update'] = date('Y-m-d H:i:s');
				$params['user_user_id'] = $this->session->userdata('uid');

				$this->Gaji_model->add($params);
			}
		}
		$this->load->model('logs/Logs_model');
		$this->Logs_model->add(
			array(
				'log_date' => date('Y-m-d H:i:s'),
				'user_id' => $this->session->userdata('uid'),
				'log_module' => 'Tambah Gaji',
				'log_action' => 'Tambah',
				'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
			)
		);
		$this->session->set_flashdata('success', ' Tambah Pengeluaran Berhasil');
		redirect('manage/gaji');
	}

	// Add gaji and Update
	public function add($id = NULL)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('gaji_date', 'Tanggal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gaji_value', 'Nilai', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gaji_desc', 'Keterangan', 'trim|required|xss_clean');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
		$data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

		if ($_POST and $this->form_validation->run() == TRUE) {

			if ($this->input->post('gaji_id')) {
				$params['gaji_id'] = $this->input->post('gaji_id');
			} else {
				$params['gaji_input_date'] = date('Y-m-d H:i:s');
			}

			$params['gaji_date'] = $this->input->post('gaji_date');
			$params['gaji_value'] = $this->input->post('gaji_value');
			$params['gaji_desc'] = $this->input->post('gaji_desc');
			$params['gaji_last_update'] = date('Y-m-d H:i:s');
			$params['user_user_id'] = $this->session->userdata('uid');

			$status = $this->Gaji_model->add($params);
			$paramsupdate['gaji_id'] = $status;
			$this->Gaji_model->add($paramsupdate);

			$this->session->set_flashdata('success', $data['operation'] . ' GAJI berhasil');
			redirect('manage/gaji');
		} else {
			if ($this->input->post('gaji_id')) {
				redirect('manage/gaji/edit/' . $this->input->post('gaji_id'));
			}

			// Edit mode
			if (!is_null($id)) {
				$data['gaji'] = $this->Gaji_model->get(array('id' => $id));
			}
			$data['title'] = $data['operation'] . ' Pengeluaran Umum';
			$data['main'] = 'gaji/gaji_add';
			$this->load->view('manage/layout', $data);
		}
	}


	// Delete to database
	public function delete($id = NULL)
	{
		if ($_POST) {
			$this->Gaji_model->delete($id);
			// activity log
			$this->load->model('logs/Logs_model');
			$this->Logs_model->add(
				array(
					'log_date' => date('Y-m-d H:i:s'),
					'user_id' => $this->session->userdata('uid'),
					'log_module' => 'gaji Guru',
					'log_action' => 'Hapus',
					'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
				)
			);
			$this->session->set_flashdata('success', 'Hapus Gaji berhasil');
			redirect('manage/gaji');
		} elseif (!$_POST) {
			$this->session->set_flashdata('delete', 'Delete');
			redirect('manage/gaji/edit/' . $id);
		}
	}
}

/* End of file Jurnal_set.php */
/* Location: ./application/modules/jurnal/controllers/Jurnal_set.php */