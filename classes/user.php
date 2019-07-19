<?php

class user extends db{



	public function select(){

		$sql ="SELECT * from test order by id DESC";
		$result = $this->connect()->query($sql);
		if($result->rowCount() > 0 ){
			while($row = $result->fetch()){
				$data[] = $row;
			}
			return $data;
		}
	}




	public function insert($data,$data1){


		$sql ="INSERT INTO test (data,data1) VALUES (:data,:data1)";

		$stmt = $this->connect()->prepare($sql);

		$stmt->bindParam(":data",$data);
		$stmt->bindParam(":data1",$data1);

		$stmtExec = $stmt->execute();

	}


	public function delete($id){

		$sql ="DELETE FROM test where id =:id";

		$stmt = $this->connect()->prepare($sql);

		$stmt->bindParam(":id",$id);

		$stmtExec = $stmt->execute();
	}



	public function viewone($id){

		$sql ="SELECT * from test where id ='$id'";
		$result = $this->connect()->query($sql);
		if($result->rowCount() > 0 ){
			$row = $result->fetch();
			return $row;
		}

	}



	public function edit($id,$data,$data1){

		$sql = "UPDATE test set data = :data, data1 = :data1 where id ='$id'";

		$stmt = $this->connect()->prepare($sql);

		$stmt->bindParam(":data",$data);
		$stmt->bindParam(":data1",$data1);

		$stmtExec = $stmt->execute();
	}





}




?>