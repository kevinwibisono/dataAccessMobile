<?php
	$conn = mysqli_connect("localhost", "root", "", "trialDB");
	$response = array();
	
	if(isset($_POST['function'])){
		if($_POST['function'] == "getalluser"){
			getalluser($conn);
		}
		if($_POST['function'] == "adduser"){
			adduser($conn);
		}
	}
	
	function getalluser($conn){
		$array = [];
		$result = mysqli_query($conn, "SELECT * FROM user");
		while($row = mysqli_fetch_array($result)){
			$data["username"] = $row['username'];
			$data["password"] = $row['password'];
			$data["nama"] = $row['nama'];
			$data["alamat"] = $row['alamat'];
			array_push($array, $data);
		}
		mysqli_free_result($result);
		$response['alluser'] = $array;
		echo json_encode($response);
	}

	function adduser($conn){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$result = mysqli_query($conn, "INSERT INTO user VALUES('$username','$password','$nama','$alamat')");
		if($result){
			$response['code'] = 1;
			$response['message'] = "Berhasil insert user";
		}
		if(!$result){
			$response['code'] = -1;
			$response['message'] = mysqli_error($conn);
		}
		mysqli_free_result($result);
		echo json_encode($response);
	}
?>