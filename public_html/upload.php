<?php
//turn on php error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$name     = $_FILES['file']['name'];
	$tmpName  = $_FILES['file']['tmp_name'];
	$error    = $_FILES['file']['error'];
	$size     = $_FILES['file']['size'];
    $ext	  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
  
	switch ($error) {
		case UPLOAD_ERR_OK:
			$valid = true;
			//validate file extensions
			if ( !in_array($ext, array('xlsm','xlsx')) ) {
				$valid = false;
				echo "<script>alert(' Invalid file extension!');window.location='index.php';</script>";
			}
			//validate file size
			if ( $size/5000/5000 > 2 ) {
				$valid = false;
				echo "<script>alert(' File size is exceeding maximum allowed size.');window.location='index.php';</script>";
			}
			//upload file
			if ($valid) { 
		    echo "<script>alert(' successfully upload');
		    window.location='index.php';
			</script>";
			    
				$targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR. $name;
				move_uploaded_file($tmpName,$targetPath); 
				header( 'Location: index.php' ) ;
				exit;
				
			}
			break;
		case UPLOAD_ERR_INI_SIZE:
			echo "<script>alert(' The uploaded file exceeds the upload_max_filesize directive in php.ini.');window.location='erepo.php';</script>";
			break;
		case UPLOAD_ERR_PARTIAL:
			echo "<script>alert(' The uploaded file was only partially uploaded.');window.location='index.php';</script>";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "<script>alert(' No file was uploaded.');window.location='index.php';</script>";
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
		    echo "<script>alert(' Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.');window.location='index.php';</script>";
			break;
		case UPLOAD_ERR_CANT_WRITE:
		    echo "<script>alert(' Failed to write file to disk. Introduced in PHP 5.1.0.');window.location='index.php';</script>";
			break;
		default:
			echo "<script>alert(' Unknown error');window.location='index.php';</script>";
		break;
	}
	echo $response;
}
