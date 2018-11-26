<?php
class Upload_Model extends CI_Model{

	public function upload_profile_image($file){
		$key = array_keys($file);

		$ext = pathinfo($file[$key[0]]['name'], PATHINFO_EXTENSION);
		$new_image_name = $this->generateKey().'.'.$ext;

		$config =  array(
				  'upload_path'     => 'upload/profile/',
				  'upload_url'      => UPLOAD,
				  'allowed_types'   => "gif|jpg|png|jpeg",
				  'file_name'		=> $new_image_name,
				  'file_ext_tolower'=> TRUE,
				  'overwrite'       => TRUE,
				  'max_size'        => "1000KB",
				  'max_height'      => "2500",
				  'max_width'       => "2500"
				);

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload($key[0])){
			echo $this->upload->display_errors();
		}
		else{
			return array('image_name'=>$new_image_name);
		}
	}

	public function upload_file($file){
		$key = array_keys($file);
		if (!file_exists('upload/files/')) {
		    mkdir('upload/files/', 0777, true);
		}
		$ext = pathinfo($file[$key[0]]['name'], PATHINFO_EXTENSION);
		$file_name = pathinfo($file[$key[0]]['name'], PATHINFO_BASENAME );
		$new_file_name = $this->generateKey().'.'.$ext;

		$config =  array(
				  'upload_path'     => 'upload/files/',
				  'upload_url'      => UPLOAD,
					'allowed_types'   => "*",
				  'file_name'		=> $new_file_name,
				  'file_ext_tolower'=> TRUE,
				  'max_size'        => "1000000KB"
				);

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload($key[0])){
			echo $this->upload->display_errors();
		}
		else{
			return array('new_file_name'=>$new_file_name,
						 'file_name'=>$file_name);
		}
	}

	public function delete_file($file){
		return unlink($file);
	}

	public function upload_document($file){
		$key = array_keys($file);

		$ext = pathinfo($file[$key[0]]['name'], PATHINFO_EXTENSION);
		$file_name = pathinfo($file[$key[0]]['name'], PATHINFO_BASENAME );
		$new_file_name = $this->generateKey().'.'.$ext;

		$config =  array(
				  'upload_path'     => 'upload/files/',
				  'upload_url'      => UPLOADS,
				  'file_name'		=> $new_file_name,
				  'allowed_types'   => "docx|docm|dotx|dotm|docb|pdf|txt",
				  'file_ext_tolower'=> TRUE,
				  'max_size'        => "1000000KB"
				);

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload($key[0])){
			echo $this->upload->display_errors();
		}
		else{
			return array('new_file_name'=>$new_file_name,
						 'file_name'=>$file_name);
		}
	}

	private function generateKey(){
		return uniqid().'_'.uniqid();
	}
}
