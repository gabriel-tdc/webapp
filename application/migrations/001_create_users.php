<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration {

	public function up() {
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '64',
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '64',
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '128',
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field('deleted_at TIMESTAMP NULL DEFAULT NULL');
		$this->dbforge->add_field('updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE NOW()');
		$this->dbforge->add_field('created_at TIMESTAMP NOT NULL DEFAULT NOW()');
		$this->dbforge->create_table('users');
	}

	public function down() {
		$this->dbforge->drop_table('users');
	}
}
