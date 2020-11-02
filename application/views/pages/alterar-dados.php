<div class="container">
	<div class="row">
		<div class="col-12 mt-5">
			<div class="card">
				<div class="row align-items-center">
					<div class="col-md-4 col-lg-6 text-center">
						<i class="fas fa-user-edit fa-4x"></i>
					</div>
					<div class="col-md-6">
						<h1 class="mb-3">Cadastro</h1>
						<form action="<?= base_url('users/'.$user->id); ?>" method="post">
							<div class="form-row align-items-center">
								<div class="col-12">
									<label class="sr-only" for="nome">Nome</label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-user"></i></div>
										</div>
										<input type="text" class="form-control" id="nome" name="name" placeholder="Nome" value="<?= $user->name; ?>">
									</div>
								</div>
								<div class="col-12">
									<label class="sr-only" for="email">E-mail</label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-envelope"></i></div>
										</div>
										<input type="text" class="form-control" id="email" name="email"  placeholder="E-mail" value="<?= $user->email; ?>">
									</div>
								</div>
								<div class="col-12">
									<label class="sr-only" for="password">Senha</label>
									<div class="input-group mb-2">
										<div class="input-group-prepend">
										<div class="input-group-text"><i class="fas fa-lock"></i></div>
										</div>
										<input type="text" class="form-control" id="password" name="password" placeholder="Senha" value="">
									</div>
									<small>Deixe em branco, caso não queira alterar sua senha</small>
								</div>
								<div class="col-sm-12 text-right d-flex justify-content-between">
									<a href="<?= base_url('ponto'); ?>" class="btn btn-danger mb-2">Voltar</a>
									<button type="submit" class="btn btn-success mb-2">Alterar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
