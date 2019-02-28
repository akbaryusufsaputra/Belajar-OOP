<?php 

	$username = "root";
    $password = "";
    $database = "db_updsenbud";
    $hostname = "localhost";
    $conn = mysqli_connect($hostname,$username,$password,$database) or die("Connection Corrupt");

    class oop{
    	public function tampil($table){
            global $conn;
            $sql = "SELECT * FROM $table";
            $query = mysqli_query($conn,$sql);
            $data = [];
            while ($tampung = mysqli_fetch_assoc($query)) {
                $data[] = $tampung;
            }
            return $data;
        }

    	public function simpan($table,$values,$redirect){
        	global $conn;

        	$sql = "INSERT INTO $table VALUES($values)";
        	$query = mysqli_query($conn,$sql);
        	if ($query) {
        		echo "<script>alert('Berhasil');document.location.href='$redirect'</script>";
        	}
        	else{
        		echo mysqli_error($conn);
        	}
        }

        public function selectWhere($table,$where,$whereValues){
            global $conn;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($conn,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function countWhere($field,$name,$table,$where,$value){
            global $conn;
            $sql = "SELECT COUNT($field) AS $name FROM $table WHERE $where = '$value'";
            $query = mysqli_query($conn,$sql);
            $datas = mysqli_fetch_assoc($query);
            return $datas;
        }

        public function ubah($table,$isi,$where,$whereisi,$redirect){
        	global $conn;
        	$sql = "UPDATE $table SET $isi WHERE $where = '$whereisi'";
        	$query = mysqli_query($conn,$sql);
        	if ($query) {
        		echo "<script>alert('Berhasil');document.location.href='$redirect'</script>";
        	}
        	else{
        		echo mysqli_error($conn);
        		// echo "<script>alert('Failed');document.location.href='$redirect'</script>";
        	}
        }

        public function delete($table,$where,$whereValues,$redirect){
            global $conn;
            $sql = "DELETE FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($conn,$sql);
            if($query){
                echo "<script>alert('Berhasil');document.location.href='$redirect'</script>";
            }else{
                echo mysqli_error($conn);
            }
        }

    }

 ?>