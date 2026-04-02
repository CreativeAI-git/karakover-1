<?php
defined('BASEPATH') or exit('No direct script access allowed');
#[\AllowDynamicProperties]
class Home extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/index';
		$data['home'] = $this->common->getData('web_home', array(), array());
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$data['about'] = $this->common->getData('web_about', array(), array());
		$data['instrument'] = $this->common->getData('web_instrument', array());
		$data['home_page_banners'] = $this->common->getData('home_page_banners', array(), array('sort_by' => 'id', 'sort_direction' => 'ASC'));
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$this->load->view('frontend/include/index', $data);
	}

	public function about()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/about';
		$data['about'] = $this->common->getData('web_about', array(), array());
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$data['ourteam'] = $this->common->getData('web_ourteam', array());
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$this->load->view('frontend/include/index', $data);
	}

	public function instruments()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/instruments';
		$data['instrument'] = $this->common->getData('web_instrument', array());
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$this->load->view('frontend/include/index', $data);
	}

	public function tutorials()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/tutorials';
		$data['tutorial'] = $this->common->getData('web_tutorial', array());
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$this->load->view('frontend/include/index', $data);
	}

	public function terms()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/terms';
		$data['terms'] = $this->common->getData('tbl_terms_and_condition', array('id' => '1'), array('single'));
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$this->load->view('frontend/include/index', $data);
	}

	public function privacy()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/privacy';
		$data['privacy'] = $this->common->getData('tbl_terms_and_condition', array('id' => '2'), array('single'));
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$this->load->view('frontend/include/index', $data);
	}

	public function chatroom()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/chatroom';
		$data['footer'] = $this->common->getData('web_footer', array(), array());
		$data['bgimage'] = $this->common->getData('web_bgimage', array());
		$this->load->view('frontend/include/index', $data);
	}

	public function delete_account()
	{
		$data['title'] = 'Karakover';
		$data['page'] = 'frontend/delete_account';

		if ($this->input->method() === 'post') {
			$email = trim($this->input->post('email', true));
			$password = (string) $this->input->post('password', true);

			if ($email === '' || $password === '') {
				$this->session->set_flashdata('delete_error', 'Please enter your email and password.');
				redirect(base_url('delete-account'));
				return;
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$this->session->set_flashdata('delete_error', 'Please enter a valid email address.');
				redirect(base_url('delete-account'));
				return;
			}

			$user = $this->common->getData('tbl_users', array('email' => $email), array('single'));
			if (!$user) {
				$this->session->set_flashdata('delete_error', 'User not found.');
				redirect(base_url('delete-account'));
				return;
			}
			if ((isset($user['is_deleted']) && (int) $user['is_deleted'] === 1) || (!empty($user['deleted_at']))) {
				$this->session->set_flashdata('delete_error', 'This account has already been deleted.');
				redirect(base_url('delete-account'));
				return;
			}

			$stored = isset($user['password']) ? $user['password'] : '';
			$password_match = false;
			if ($stored !== '') {
				if (hash_equals($stored, $password)) {
					$password_match = true;
				} elseif (hash_equals($stored, md5($password))) {
					$password_match = true;
				} elseif (password_verify($password, $stored)) {
					$password_match = true;
				}
			}

			if (!$password_match) {
				$this->session->set_flashdata('delete_error', 'Invalid email or password.');
				redirect(base_url('delete-account'));
				return;
			}

			$fields = $this->db->list_fields('tbl_users');
			$update = array();
			if (in_array('status', $fields)) {
				$update['status'] = 0;
			}
			if (in_array('login_status', $fields)) {
				$update['login_status'] = 0;
			}
			if (in_array('is_deleted', $fields)) {
				$update['is_deleted'] = 1;
			}
			if (in_array('deleted_at', $fields)) {
				$update['deleted_at'] = date('Y-m-d H:i:s');
			}

			if (empty($update)) {
				$this->session->set_flashdata('delete_error', 'Account deletion is not configured on this server.');
				redirect(base_url('delete-account'));
				return;
			}

			$result = $this->common->updateData('tbl_users', $update, array('id' => $user['id']));
			if ($result) {
				if ($this->db->table_exists('users')) {
					$this->db->delete('users', array('user_id' => $user['id']));
				}
				$this->session->set_flashdata('delete_success', 'Your account has been deleted successfully.');
			} else {
				$this->session->set_flashdata('delete_error', 'Unable to delete account. Please try again.');
			}

			redirect(base_url('delete-account'));
			return;
		}
		$this->load->view('frontend/delete_account', $data);
	}
}
