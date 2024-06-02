<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_set extends CI_Controller
{

	public function __construct()
	{
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('guru/Guru_model', 'logs/Logs_model'));
		$this->load->library('upload');
	}

	// guru view in list
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
			$params['guru_nik'] = $f['n'];
		}

		$paramsPage = $params;
		$params['limit'] = 100;
		$params['offset'] = $offset;
		$data['guru'] = $this->Guru_model->get($params);

		$config['per_page'] = 100;
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('manage/guru/index');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['total_rows'] = count($this->Guru_model->get($paramsPage));
		$this->pagination->initialize($config);

		$data['title'] = 'DATA GURU';
		$data['main'] = 'guru/guru_list';
		$this->load->view('manage/layout', $data);
	}

	public function add_glob()
	{
		if ($_POST == TRUE) {
			$krValue = str_replace('.', '', $_POST['guru_nik']);
			$nuptk = $_POST['guru_nuptk'];
			$krDesc = $_POST['guru_nama'];
			$cpt = count($_POST['guru_nik']);
			for ($i = 0; $i < $cpt; $i++) {
				$params['guru_nik'] = $krValue[$i];
				$params['guru_nuptk'] = $nuptk[$i];
				$params['guru_nama'] = $krDesc[$i];
				$this->Guru_model->add($params);
			}
		}
		$this->session->set_flashdata('success', ' Tambah GU Berhasil');
		redirect('manage/guru');
	}

	// Add guru and Update
	public function add($id = NULL)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('guru_nik', 'nik', 'trim|required|xss_clean');
		$this->form_validation->set_rules('guru_nuptk', 'nuptk', 'trim|required|xss_clean');
		$this->form_validation->set_rules('guru_nama', 'nama', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
		$data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

		if ($_POST and $this->form_validation->run() == TRUE) {

			if ($this->input->post('guru_id')) {
				$params['guru_id'] = $this->input->post('guru_id');
			} 

			$params['guru_nik'] = $this->input->post('guru_nik');
			$params['guru_nuptk'] = $this->input->post('guru_nuptk');
			$params['guru_nama'] = $this->input->post('guru_nama');

			$status = $this->Guru_model->add($params);
			$paramsupdate['guru_id'] = $status;
			$this->Guru_model->add($paramsupdate);

			$this->session->set_flashdata('success', $data['operation'] . ' Pengeluaran berhasil');
			redirect('manage/guru');
		} else {
			if ($this->input->post('guru_id')) {
				redirect('manage/guru/edit/' . $this->input->post('guru_id'));
			}

			// Edit mode
			if (!is_null($id)) {
				$data['guru'] = $this->Guru_model->get(array('id' => $id));
			}
			$data['title'] = $data['operation'] . ' EDIT DATA GURU';
			$data['main'] = 'guru/guru_add';
			$this->load->view('manage/layout', $data);
		}
	}


	// Delete to database
	public function delete($id = NULL)
	{
		if ($_POST) {
			$this->Guru_model->delete($id);
			// activity log
			$this->load->model('logs/Logs_model');
			$this->Logs_model->add(
				array(
					'log_date' => date('Y-m-d H:i:s'),
					'user_id' => $this->session->userdata('uid'),
					'log_module' => 'DATA GURU',
					'log_action' => 'Hapus',
					'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
				)
			);
			$this->session->set_flashdata('success', 'Hapus DATA GURU berhasil');
			redirect('manage/guru');
		} elseif (!$_POST) {
			$this->session->set_flashdata('delete', 'Delete');
			redirect('manage/guru/edit/' . $id);
		}
	}
}

/* End of file Jurnal_set.php */
/* Location: ./application/modules/jurnal/controllers/Jurnal_set.php */