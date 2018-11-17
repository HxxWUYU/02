<?php 
namespace App\Classes;

class UploadFile{

	protected $filename;
	protected $max_filesize = 2097152;
	protected $extension;
	protected $path;

	public function getName(){
		return $this->filename;
	}

	protected function setName($file,$name=''){

		if($name===''){
			$name = pathinfo($file,8);
			//PATHINFO_FILENAME is 8
			//PATHINFO_BASENAME is 2
			//PATHINFO_DIRNAME is 1
			//PATHINFO_EXTENSION is 4
		}

		$name = strtolower(str_replace(['_',' '], '-', $name));
		$hash = md5(microtime());
		$ext = $this->fileExtension($file);

		$this->filename = "{$name}-{$hash}.{$ext}";


	}

	protected function fileExtension($file){
		return $this->extension = pathinfo($file,4);
	}

	public static function fileSize($file){
		$fileobj = new static;
		return ($file > $fileobj->max_filesize ? true:false);
	}

	public static function isImage($file){

		$fileobj = new static;
		$ext = $fileobj->fileExtension();
		$validExt = array('jpg','jpeg','png','bmp','gif');
		if(!in_array(strtolower($ext), $validExt)){
			return false;
		}
		return true;
	}

	public function path(){
		return $this->path;
	}

	public static function move($temp_path,$folder,$file,$new_filename){
		$fileobj = new static;
		$ds = DIRECTORY_SEPARATOR; //slash

		$fileobj->setName($file,$new_filename);
		$file_name = $fileobj->getName();
		if(!is_dir($folder)){
			mkdir($folder,0777,true);
		}

		$fileobj->path = "{$folder}{$ds}{file_name}";
		$absolute_path = BASE_PATH."{$ds}public{$ds}$fileobj->path";
		if(move_uploaded_file($temp_path, $absolute_path)){
			return $fileobj;
		}
		return null;
	}


}
?>