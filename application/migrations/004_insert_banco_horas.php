<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insert_banco_horas extends CI_Migration {

	public function up() {
        foreach ($this->seedData as $seed ) {
            $sql = 'INSERT INTO banco_horas (`id_user`, `date`, `start`, `pause`, `return`, `finish`, `total`) VALUES '.$seed;
            $this->db->query($sql);
        }
	}

	public function down() {
		$sql = "DELETE FROM banco_horas WHERE id <= " . count($this->seedData);
		$this->db->query($sql);
		$this->db->query('ALTER TABLE banco_horas AUTO_INCREMENT = 1;');
	}

	private $seedData = array(
		'(1, "2020-11-01", "08:00", "12:00", "13:00", "18:00", "09:00")',	
		'(1, "2020-11-02", "08:10", "12:10", "13:10", "17:10", "08:10")',		
		'(1, "2020-11-03", "08:05", "12:05", "13:05", "18:35", "09:30")',		
		'(1, "2020-11-04", "09:10", "13:10", "14:10", "19:10", "09:10")',		
		'(1, "2020-11-05", "08:00", "12:00", "13:00", null, null)'		
    );
}
