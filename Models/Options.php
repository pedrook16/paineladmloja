<?php
namespace Models;

use \Core\Model;

class Options extends Model {

	public function getAll($show_product_count = false) {
		$array = array();
		if($show_product_count = true) {
			$sql = "SELECT * FROM options";
		}else { 	
			$sql = "SELECT * FROM options";
		}			
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function add($name) {

		$sql = "INSERT INTO options (name) VALUES (:name)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':name', $name);		
		$sql->execute();

	}

	public function get($id) {
		$array = array();

		$sql = "SELECT * FROM options WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch(\PDO::FETCH_ASSOC);
		}

		return $array;
	}
	public function update($name, $id) {

		$sql = "UPDATE options SET name = :name WHERE id = :id";
		$sql = $this->db->prepare($sql);		
		$sql->bindValue(':name', $name);
		$sql->bindValue(':id', $id);
		$sql->execute();

	}
	public function del($id) {

		$sql = "SELECT count(*) FROM products WHERE products.id_brand = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		$data = $sql->fetch();

		if($data['c'] == '0') { 
			$sql = "DELETE FROM options WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();
		}	

	}    

}













