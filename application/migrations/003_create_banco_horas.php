<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_banco_horas extends CI_Migration {

	public function up() {
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'id_user' => array(
				'type' => 'INT',
			),
			'date' => array(
				'type' => 'DATE',
				'default' => null
			),
			'start' => array(
				'type' => 'TIME',
				'default' => null
			),
			'pause' => array(
				'type' => 'TIME',
				'default' => null
			),
			'return' => array(
				'type' => 'TIME',
				'default' => null
			),
			'finish' => array(
				'type' => 'TIME', 
				'default' => null
			),
			'total' => array(
				'type' => 'TIME', 
				'default' => null
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field('deleted_at TIMESTAMP NULL DEFAULT NULL');
		$this->dbforge->add_field('updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE NOW()');
		$this->dbforge->add_field('created_at TIMESTAMP NOT NULL DEFAULT NOW()');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_user) REFERENCES users(id)');
		$this->dbforge->create_table('banco_horas');
	}

	public function down() {
		$this->dbforge->drop_table('banco_horas');
	}
}
