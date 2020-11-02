<script>
	const baseUrl = "<?= base_url(); ?>";
	$(document).ready(function() { 
		var options = { 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       showResponse,  // post-submit callback 
			clearForm: true,
			error: showError
		}; 
	
		$('form').ajaxForm(options); 
	});

	let buttonContent = '';
	function beforeSubmit() { 
		const button = $('button[type="submit"]');
		buttonContent = button.html();
		button.html('<i class="fas fa-circle-notch fa-spin"></i>');
		button.prop('disabled', true);
		return true; 
	}

	function finishRequest() {
		const button = $('button[type="submit"]');
		button.html(buttonContent);
		button.prop('disabled', false);
	}
	
	function showResponse(res, statusText, xhr, $form)  { 
		finishRequest();
		window.location.href = baseUrl+"ponto";

	}

	function showError(res, jqForm, options) { 
		finishRequest();
		
		const response = JSON.parse(res.responseText);

		Toastify({
			text: response.message ? response.message : 'Ocorreu um erro ao realizar login',
			duration: 3000,
			backgroundColor: "linear-gradient(to right, #b00010, #da4747)"
		}).showToast();
	}

</script>
