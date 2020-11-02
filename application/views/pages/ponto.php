<div class="container">
	<div class="row">
		<div class="col-12 mt-5">
			<div class="card">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<h1 class="mb-3">Seu ponto</h1>
							</div>
							<div class="col-md-6 text-right">
								<a href="<?= base_url('lancar-horas'); ?>" class="btn btn-success mb-2">Lançar horas</a>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col">Data</th>
										<th scope="col">
											<i class="fas fa-chevron-circle-right"></i>
											<span class="d-none d-lg-inline-block">Início</span>
										</th>
										<th scope="col">
											<i class="far fa-pause-circle"></i>
											<span class="d-none d-lg-inline-block">Saída para Almoço</span>
										</th>
										<th scope="col">
											<i class="far fa-play-circle"></i>
											<span class="d-none d-lg-inline-block">Volta do Almoço</span>
										</th>
										<th scope="col">
											<i class="fas fa-door-open"></i>
											<span class="d-none d-lg-inline-block">Encerramento</span>
										</th>
										<th scope="col">
											<i class="fas fa-clock"></i>
											<span class="d-none d-lg-inline-block">Saldo</span>
										</th>
										<th scope="col">
										</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($bancoHoras as $dia) { ?>
										<tr>
											<th scope="row"><?= date("d/m/Y", strtotime($dia->date)); ?></th>
											<td><?= $dia->start ? date('H:i', strtotime($dia->start)) : '-'; ?></td>
											<td><?= $dia->pause ? date('H:i', strtotime($dia->pause)) : '-'; ?></td>
											<td><?= $dia->return ? date('H:i', strtotime($dia->return)) : '-'; ?></td>
											<td><?= $dia->finish ? date('H:i', strtotime($dia->finish)) : '-'; ?></td>
											<td><?= $dia->total ? date('H:i', strtotime($dia->total)) : '-'; ?></td>
											<td><a href="<?= base_url('editar-horas/'.$dia->id); ?>" class="btn btn-success mb-2"><i class="fas fa-edit"></i></a></td>
										</tr>
									<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<th scope="row" colspan="5">Saldo total:</th>
										<th><?= $totalTime; ?>
										</th>
										<th></th>
									</tr>
								</tfoot>
							</table>
						</div>
						
						<div class="col-md-12 d-flex justify-content-between">
							<a href="<?= base_url('alterar-dados'); ?>" class="btn btn-info">Alterar dados cadastrais</a>
							<a href="<?= base_url('logout'); ?>" class="btn btn-danger d-flex align-items-center">Logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
