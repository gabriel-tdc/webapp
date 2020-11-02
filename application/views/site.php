<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view("template/head"); ?>
	</head>
	<body>

		<?php $this->load->view("pages/$page"); ?>

		<?php $this->load->view("template/scripts"); ?>

	</body>
</html>
