<div class="container">
	<div class="row">
		<div class="col-12 mt-5">
			<div class="card">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<h1 class="mb-3">Lançar horas</h1>
							</div>
							<div class="col-md-6">
								<a href="<?= base_url('ponto'); ?>" class="btn btn-info mb-2">Voltar</a>
							</div>
						</div>

						<form action="<?= base_url('banco-horas/' . $bancoHoras->id); ?>" method="post">

							<label class="sr-only" for="date">Data</label>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-calendar"></i></div>
								</div>
								<input type="date" class="form-control" id="date" name="date" placeholder="Data" value="<?= $bancoHoras->date; ?>">
							</div>

							<label class="sr-only" for="start">Início</label>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-chevron-circle-right"></i></div>
								</div>
								<input type="time" class="form-control" id="start" name="start" placeholder="Início" value="<?= $bancoHoras->start ? date('H:i', strtotime($bancoHoras->start)) : ''; ?>">
							</div>

							<label class="sr-only" for="pause">Saída para Almoço</label>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-pause-circle"></i></div>
								</div>
								<input type="time" class="form-control" id="pause" name="pause" placeholder="Saída para Almoço" value="<?= $bancoHoras->pause ? date('H:i', strtotime($bancoHoras->pause)) : ''; ?>">
							</div>

							<label class="sr-only" for="return">Volta do Almoço</label>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-play-circle"></i></div>
								</div>
								<input type="time" class="form-control" id="return" name="return" placeholder="Volta do Almoço" value="<?= $bancoHoras->return ? date('H:i', strtotime($bancoHoras->return)) : ''; ?>">
							</div>

							<label class="sr-only" for="finish">Encerramento</label>
							<div class="input-group mb-2">
								<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-door-open"></i></div>
								</div>
								<input type="time" class="form-control" id="finish" name="finish" placeholder="Encerramento" value="<?= $bancoHoras->finish ? date('H:i', strtotime($bancoHoras->finish)) : ''; ?>">
							</div>

							
							<button type="submit" class="btn btn-success mb-2">Salvar</button>
						
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
