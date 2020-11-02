<script src="<?= base_url("public/js/jquery-3.1.1.min.js"); ?>"></script> 

<!-- Toastify -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script src="//malsup.github.com/jquery.form.js"></script> 

<?php
	$auxPage = explode('/', $page);
	$auxPage = end($auxPage);
	if(file_exists(FCPATH."application/views/scripts/".$auxPage.".php")){
		$this->load->view("scripts/".$auxPage);
	}
?>
