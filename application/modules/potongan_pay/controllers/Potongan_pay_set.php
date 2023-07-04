<?php
defined('BASEPATH') or exit('No direct script access allowed');

class potongan_pay_set extends CI_Controller
{

	public function __construct()
	{
		parent::__construct(TRUE);
		if ($this->session->userdata('logged') == NULL) {
			header("Location:" . site_url('manage/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
		}
		$this->load->model(array('potongan_pay/Potongan_pay_model', 'guru/Guru_model','logs/Logs_model'));
		$this->load->library('upload');
	}

	// potongan_pay view in list
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
			$params['potongan_pay_desc'] = $f['n'];
		}

		$paramsPage = $params;
		$params['limit'] = 100;
		$params['offset'] = $offset;
		$data['potongan_pay'] = $this->Potongan_pay_model->get($params);

		$config['per_page'] = 100;
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('manage/potongan_pay/index');
		$config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$config['total_rows'] = count($this->Potongan_pay_model->get($paramsPage));
		$this->pagination->initialize($config);

		$data['title'] = 'potongan_pay Umum';
		$data['main'] = 'potongan_pay/potongan_pay_list';
		$this->load->view('manage/layout', $data);
	}

	public function add_glob()
	{
		if ($_POST == TRUE) {
			$krValue = $_POST['potongan_pay_value'];
			$krDesc = $_POST['potongan_pay_desc'];
			$cpt = count($_POST['potongan_pay_value']);
			for ($i = 0; $i < $cpt; $i++) {
				$params['potongan_pay_date'] = $this->input->post('potongan_pay_date');
				$params['guru_guru_id'] =  $this->input->post('guru_guru_id');
				$params['potongan_pay_value'] = $krValue[$i];
				$params['potongan_pay_desc'] = $krDesc[$i];
				$params['potongan_pay_input_date'] = date('Y-m-d H:i:s');
				$params['potongan_pay_last_update'] = date('Y-m-d H:i:s');
				$params['user_user_id'] = $this->session->userdata('uid');

				$this->Potongan_pay_model->add($params);
			}

				}
				$this->load->model('logs/Logs_model');
				$this->Logs_model->add(
					array(
						'log_date' => date('Y-m-d H:i:s'),
						'user_id' => $this->session->userdata('uid'),
						'log_module' => 'input potongan',
						'log_action' => 'Tambah',
						'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
					)
				);
		$this->session->set_flashdata('success', ' Pembayaran potongan Berhasil');
		redirect('manage/potongan_pay');
	}

	// Add potongan_pay and Update
	public function add($id = NULL)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('potongan_pay_date', 'Tanggal', 'trim|required|xss_clean');
		$this->form_validation->set_rules('potongan_pay_value', 'Nilai', 'trim|required|xss_clean');
		$this->form_validation->set_rules('potongan_pay_desc', 'Keterangan', 'trim|required|xss_clean');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
		$data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

		if ($_POST and $this->form_validation->run() == TRUE) {

			if ($this->input->post('potongan_pay_id')) {
				$params['potongan_pay_id'] = $this->input->post('potongan_pay_id');
			} else {
				$params['potongan_pay_input_date'] = date('Y-m-d H:i:s');
			}

			$params['potongan_pay_date'] = $this->input->post('potongan_pay_date');
			$params['potongan_pay_value'] = $this->input->post('potongan_pay_value');
			$params['potongan_pay_desc'] = $this->input->post('potongan_pay_desc');
			$params['potongan_pay_last_update'] = date('Y-m-d H:i:s');
			$params['user_user_id'] = $this->session->userdata('uid');

			$status = $this->Potongan_pay_model->add($params);
			$paramsupdate['potongan_pay_id'] = $status;
			$this->Potongan_pay_model->add($paramsupdate);

			$this->session->set_flashdata('success', $data['operation'] . ' potongan_pay berhasil');
			redirect('manage/potongan_pay');
		} else {
			if ($this->input->post('potongan_pay_id')) {
				redirect('manage/potongan_pay/edit/' . $this->input->post('potongan_pay_id'));
			}

			// Edit mode
			if (!is_null($id)) {
				$data['potongan_pay'] = $this->Potongan_pay_model->get(array('id' => $id));
			}
			$data['title'] = $data['operation'] . ' Pengeluaran Umum';
			$data['main'] = 'potongan_pay/potongan_pay_add';
			$this->load->view('manage/layout', $data);
		}
	}


	// Delete to database
	public function delete($id = NULL)
	{
	
			$this->Potongan_pay_model->delete($id);
			// activity log

			$this->load->model('logs/Logs_model');
			$this->Logs_model->add(
				array(
					'log_date' => date('Y-m-d H:i:s'),
					'user_id' => $this->session->userdata('uid'),
					'log_module' => 'potongan Umum',
					'log_action' => 'Hapus',
					'log_info' => 'ID:' . $id . ';Title:' . $this->input->post('delName')
				)
			);
			$this->session->set_flashdata('success', 'Hapus potongan Umum berhasil');
			redirect('manage/potongan_pay');
		
	}
}

/* End of file Jurnal_set.php */
/* Location: ./application/modules/jurnal/controllers/Jurnal_set.php */