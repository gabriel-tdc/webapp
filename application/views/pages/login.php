<div class="container">
	<div class="row">
		<div class="col-12 mt-5">
			<div class="card">
				<div class="row align-items-center">
					<div class="col-md-4 col-lg-6 text-center">
						<i class="fas fa-user-shield fa-4x"></i>
					</div>
					<div class="col-md-6">
						<h1 class="mb-3">Login</h1>
						<form action="<?= base_url('authentication'); ?>" method="post">
							<div class="form-row align-items-center">
								<div class="col-12">
									<label class="sr-only" for="email">E-mail</label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-envelope"></i></div>
										</div>
										<input type="text" class="form-control" id="email" name="email" placeholder="E-mail">
									</div>
								</div>
								<div class="col-12">
									<label class="sr-only" for="password">Senha</label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-lock"></i></div>
										</div>
										<input type="password" class="form-control" id="password" name="password" placeholder="Senha">
									</div>
								</div>
								<div class="col-sm-9">
									Ainda não tem cadastro?<br> <a href="<?= base_url('cadastro'); ?>">Clique aqui</a>
								</div>
								<div class="col-sm-3 text-right">
									<button type="submit" class="btn btn-success mb-2">Login</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
