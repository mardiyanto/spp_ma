<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Debit_jenis_set extends CI_Controller
{

	public function __construct()
	{
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('debit_jenis/Debit_jenis_model', 'logs/Logs_model'));
		$this->load->library('upload');
	}

	// debit view in list
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
			$params['debit_jenis_desc'] = $f['n'];
		}

		$paramsPage = $params;
		$params['limit'] = 50;
		$params['offset'] = $offset;
		$data['debit_jenis'] = $this->Debit_jenis_model->get($params);

		$config['per_page'] = 50;
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('manage/debit_jenis/index');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['total_rows'] = count($this->Debit_jenis_model->get($paramsPage));
		$this->pagination->initialize($config);

		$data['title'] = 'Jenis Penerimaan Umum';
		$data['main'] = 'debit_jenis/debit_jenis_list';
		$this->load->view('manage/layout', $data);
	}


	public function add_glob()
	{
		if ($_POST == TRUE) {
			$krDesc = $_POST['debit_jenis_desc'];
			$cpt = count($_POST['debit_jenis_desc']);
			for ($i = 0; $i < $cpt; $i++) {
				$params['debit_jenis_date'] = $this->input->post('debit_jenis_date');
				$params['debit_jenis_desc'] = $krDesc[$i];
				$params['debit_jenis_last_update'] = date('Y-m-d H:i:s');
				$this->Debit_jenis_model->add($params);
			}
		}
		$this->session->set_flashdata('success', ' Tambah Jenis Penerimaan Berhasil');
		redirect('manage/debit_jenis');
	}


	// Add debit_jenis and Update
	public function add($id = NULL)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('debit_jenis_date', 'Tanggal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('debit_jenis_desc', 'Keterangan', 'trim|required|xss_clean');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
		$data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

		if ($_POST and $this->form_validation->run() == TRUE) {

			if ($this->input->post('debit_jenis_id')) {
				$params['debit_jenis_id'] = $this->input->post('debit_jenis_id');
			} else {
				$params['debit_jenis_last_update'] = date('Y-m-d H:i:s');
			}

			$params['debit_jenis_date'] = $this->input->post('debit_jenis_date');
			$params['debit_jenis_desc'] = $this->input->post('debit_jenis_desc');
			$params['debit_jenis_last_update'] = date('Y-m-d H:i:s');

			$status = $this->Debit_jenis_model->add($params);
			$paramsupdate['debit_jenis_id'] = $status;
			$this->Debit_jenis_model->add($paramsupdate);


			// activity log
			$this->Logs_model->add(
				array(
					'log_date' => date('Y-m-d H:i:s'),
					'user_id' => $this->session->userdata('user_id'),
					'log_module' => 'EDIT Penerimaan',
					'log_action' => $data['operation'],
					'log_info' => 'ID:null;Title:' . $params['debit_desc']
				)
			);

			$this->session->set_flashdata('success', $data['operation'] . ' Penerimaan berhasil');
			redirect('manage/debit_jenis');
		} else {
			if ($this->input->post('debit_jenis_id')) {
				redirect('manage/debit_jenis/edit/' . $this->input->post('debit_jenis_id'));
			}

			// Edit mode
			if (!is_null($id)) {
				$data['debit_jenis'] = $this->Debit_jenis_model->get(array('id' => $id));
			}
			$data['title'] = $data['operation'] . ' jenis Penerimaan Umum';
			$data['main'] = 'debit_jenis/debit_jenis_add';
			$this->load->view('manage/layout', $data);
		}
	}


	// Delete to database
	public function delete($id = NULL)
	{
		if ($_POST) {
			$this->Debit_jenis_model->delete($id);
			// activity log
			$this->load->model('logs/Logs_model');
			$this->Logs_model->add(
				array(
					'log_date' => date('Y-m-d H:i:s'),
					'user_id' => $this->session->userdata('uid'),
					'log_module' => 'Hapus Jeni Penerimaan Umum',
					'log_action' => 'Hapus',
					'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
				)
			);
			$this->session->set_flashdata('success', 'Hapus Jenis Penerimaan Umum berhasil');
			redirect('manage/debit_jenis');
		} elseif (!$_POST) {
			$this->session->set_flashdata('delete', 'Delete');
			redirect('manage/debit_jenis/edit/' . $id);
		}
	}
}

/* End of file Jurnal_set.php */
/* Location: ./application/modules/jurnal/controllers/Jurnal_set.php */