<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Insert_user extends CI_Migration {

	public function up() {
        foreach ($this->seedData as $seed ) {
            $sql = 'INSERT INTO users (`name`, `email`, `password`) VALUES '.$seed;
            $this->db->query($sql);
        }
	}

	public function down() {
		$sql = "DELETE FROM users WHERE id <= " . count($this->seedData);
		$this->db->query($sql);
		$this->db->query('ALTER TABLE users AUTO_INCREMENT = 1;');
	}

	private $seedData = array(
		'("Gabriel Tedeschi", "gabriel-tdc@hotmail.com", "$2y$10$nTO67RRvZmLyaryMWOgYQeE3Badqv/vQO7QsY.vI377Dk9d.Xei46")' // senha = "teste"
    );
}
