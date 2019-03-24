<?php
namespace Models;

use \Core\Model;

class Products extends Model {

	public function getAll() {
        $array = array();
        $cat = new Categories();
        $brands = new Brands();
		
		$sql = "SELECT id,id_category, id_brand, name, stock, price, price_from FROM products";					
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
            
            foreach($array as $key =>  $item) {
                $catInfo = $cat->get($item['id_category']);
                $array[$key]['name_category'] = $catInfo['name'];
                $brandInfo = $brands->get($item['id_brand']); 

                $array[$key]['name_brand'] = $catInfo['name'];
                $array[$key]['name_brand'] = $brandInfo['name'];
            }
		}

		return $array;
    }
    /*

	public function add($name) {

		$sql = "INSERT INTO brands (name) VALUES (:name)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':name', $name);		
		$sql->execute();

	}

	public function get($id) {
		$array = array();

		$sql = "SELECT * FROM brands WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch(\PDO::FETCH_ASSOC);
		}

		return $array;
	}
	public function update($name, $id) {

		$sql = "UPDATE brands SET name = :name WHERE id = :id";
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
			$sql = "DELETE FROM brands WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id', $id);
			$sql->execute();
		}	

    }  
    */  

}













