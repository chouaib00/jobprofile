<?php

class Copy_Model extends CI_Model{

	public function copyFile($info){

		$source_dir = "upload/files/";
		$destination_dir = "upload/temp/";
		$file_name = $info['file_name'].'.'.pathinfo($info['encrypted_name'], PATHINFO_EXTENSION);


		$result = copy($source_dir.$info['encrypted_name'], $destination_dir.$file_name);

		if($result){
			return array('file_name'=>$file_name);
		}
		return array();

	}

	private function generateKey(){
		return uniqid().'_'.uniqid();
	}
}
