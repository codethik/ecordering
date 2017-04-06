<?php
class DataSecure{
	public function CheckTextInputs($data){
		if(!empty($data)){
			$data=trim(data);
			$data=html_entity_decode($data);
			$data=strtolower($data);
			$patern='/[^\w]|[\d]/';
			if(preg_match($patern,$data)===0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}

?>