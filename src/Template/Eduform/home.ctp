
	<div class="col-md-6">
		<div class="containerPanel">
			<div class="visible-lg">
				<?php
					echo $this->Html->image("users.svg", [
					    'width' => '150',
					    'url' => ['controller' => 'users',  'action' => 'index']
					]);
				?>
			</div>
			<div class="hidden-lg">
				<?php
					echo $this->Html->image("users.svg", [
					    'width' => '90',
					    'url' => ['controller' => 'users',  'action' => 'index']
					]);
				?>
			</div>
			<p>Usuarios</p>
			<p><b> Número:</b><?php echo $totals['users']; ?></p>
			<p><b> Último usuario:</b> 27/10/2017</p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="containerPanel">
			<div class="visible-lg">
				<?php
					echo $this->Html->image("materia.svg", [
					    'width' => '150',
					    'url' => ['controller' => 'subjects',  'action' => 'index']
					]);
				?>
			</div>
			<div class="hidden-lg">
				<?php
					echo $this->Html->image("materia.svg", [
					    'width' => '90',
					    'url' => ['controller' => 'subjects',  'action' => 'index']
					]);
				?>
			</div>
			<p>Materias</p>
			<p><b> Número:</b><?php echo $totals['subjects']; ?></p>
			<p><b> Última materia:</b> 27/09/2017</p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="containerPanel">
			<div class="visible-lg">
				<?php
					echo $this->Html->image("category.svg", [
					    'width' => '150',
					    'url' => ['controller' => 'categories',  'action' => 'index']
					]);
				?>
			</div>
			<div class="hidden-lg">
				<?php
					echo $this->Html->image("category.svg", [
					    'width' => '90',
					    'url' => ['controller' => 'categories',  'action' => 'index']
					]);
				?>
			</div>
			<p>Categorias</p>
			<p><b> Número:</b> <?php echo $totals['categories']; ?></p>
			<p><b> Última categoría:</b> 2/8/2017</p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="containerPanel">
			<div class="visible-lg">
				<?php
					echo $this->Html->image("contenido.svg", [
					    'width' => '150',
					    'url' => ['controller' => 'contents',  'action' => 'index']
					]);
				?>
			</div>
			<div class="hidden-lg">
				<?php
					echo $this->Html->image("contenido.svg", [
					    'width' => '90',
					    'url' => ['controller' => 'contents',  'action' => 'index']
					]);
				?>
			</div>
			<p>Contenidos</p>
			<p><b> Número:</b> <?php echo $totals['contents']; ?></p>
			<p><b> Último contenido:</b> 1/6/2017</p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="containerPanel">
			<div class="visible-lg">
				<?php
					echo $this->Html->image("evaluation.svg", [
					    'width' => '150',
					    'url' => ['controller' => 'competences',  'action' => 'index']
					]);
				?>
			</div>
			<div class="hidden-lg">
				<?php
					echo $this->Html->image("evaluation.svg", [
					    'width' => '90',
					    'url' => ['controller' => 'competences',  'action' => 'index']
					]);
				?>
			</div>
			<p>Competencias</p>
			<p><b> Número:</b> <?php echo $totals['competences']; ?></p>
			<p><b> Última evaluación:</b> 6/2/2017</p>
		</div>
	</div>

	
</div><!-- end of container -->




