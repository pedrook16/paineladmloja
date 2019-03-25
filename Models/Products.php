<?php
namespace Models;

use \Core\Model;

class Products extends Model {

	public function getAll() {
		$array = array();

		$cat = new Categories();
		$brands = new Brands();

		$sql = "SELECT id, id_category, id_brand, name, stock, price, price_from FROM products";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);

			foreach($array as $key => $item) {
				$catInfo = $cat->get($item['id_category']);
				$brandInfo = $brands->get($item['id_brand']);

				$array[$key]['name_category'] = $catInfo['name'];
				$array[$key]['name_brand'] = $brandInfo['name'];
			}
		}

		return $array;
	}

	public function add($id_category,
					$id_brand,
					$name,
					$description,
					$stock,
					$price_from,
					$price,

					$weight,
					$width,
					$height,
					$length,
					$diameter,

					$featured,
					$sale,
					$bestseller,
					$new_product,
					
					$options) {

		if(!empty($id_category) && !empty($id_brand) && !empty($name) && !empty($stock) && !empty($price)) {

			$options_selected = array();
			foreach($options as $optk => $opt) {
				if(!empty($opt)) {
					$options_selected[$optk] = $opt;
				}
			}

			$options_ids = implode(',', array_keys($options_selected));

			$sql = "INSERT INTO products (id_category, id_brand, name, description, stock, price, price_from, featured, sale, bestseller, new_product, options, weight, width, height, length, diameter) VALUES (:id_category, :id_brand, :name, :description, :stock, :price, :price_from, :featured, :sale, :bestseller, :new_product, :options, :weight, :width, :height, :length, :diameter)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_category', $id_category);
			$sql->bindValue(':id_brand', $id_brand);
			$sql->bindValue(':name', $name);
			$sql->bindValue(':description', $description);
			$sql->bindValue(':stock', $stock);
			$sql->bindValue(':price', $price);
			$sql->bindValue(':price_from', $price_from);
			$sql->bindValue(':featured', $featured);
			$sql->bindValue(':sale', $sale);
			$sql->bindValue(':bestseller', $bestseller);
			$sql->bindValue(':new_product', $new_product);
			$sql->bindValue(':options', $options_ids);
			$sql->bindValue(':weight', $weight);
			$sql->bindValue(':width', $width);
			$sql->bindValue(':height', $height);
			$sql->bindValue(':length', $length);
			$sql->bindValue(':diameter', $diameter);
			$sql->execute();

			$id = $this->db->lastInsertId();

			foreach($options_selected as $optk => $opt) {

				$sql = "INSERT INTO products_options (id_product, id_option, p_value) VALUES (:id_product, :id_option, :p_value)";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(':id_product', $id);
				$sql->bindValue(':id_option', $optk);
				$sql->bindValue(':p_value', $opt);
				$sql->execute();

			}

			// Adicionar as imagens
			

		}

	}

	/*
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

		$sql = "SELECT count(*) as c FROM products WHERE id_brand = :id";
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













