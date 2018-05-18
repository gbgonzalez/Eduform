 <div class="container">
    <h1 class="titleEDUFORM">EDUFORM</h1>
    <div class="sentenceEDUFORM">
      <div id="atomImageEDUFORM">
      	<?php echo $this->Html->image('atom.png', ['alt' => 'CakePHP']); ?>
      </div>
      <p>
        EDUFORM es Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam egestas velit eu ullamcorper. Vestibulum risus urna, mollis vel interdum sit amet, mattis vel elit. Donec at volutpat urna. Suspendisse non tempor felis. Nullam pulvinar dictum erat eu pretium. In eu fermentum quam. Nunc placerat scelerisque blandit.
      </p>
      <div id="shelvesImageEDUFORM">
      	<?php echo $this->Html->image('shelves.png', ['alt' => 'CakePHP']); ?>
      </div>
    </div>
  </div> <!-- FIN DE CONTAINER -->



<div class="col-md-4">
	<div class="indexMenu">
		<h2>Licencias</h2>
		<div class="visible-lg">
			<?php echo $this->Html->image('study1.png', ['alt' => 'CakePHP', 'width' => 300]); ?>
		</div>
		<div class="hidden-lg">
		<?php echo $this->Html->image('study1.png', ['alt' => 'CakePHP', 'width' => 200, 'class' => 'imageMobileIndex']); ?>
		</div>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam egestas velit eu ullamcorper. Vestibulum risus urna, mollis vel interdum sit amet, mattis vel elit. Donec at volutpat urna. Suspendisse non tempor felis. Nullam pulvinar dictum erat eu pretium. In eu fermentum quam. 
		</p>
	</div>

</div>
<div class="col-md-4">
	<div class="indexMenu">
		<h2>Area personalizada</h2>
		<div class="visible-lg">
			<?php echo $this->Html->image('study2.png', ['alt' => 'CakePHP', 'width' => 300]); ?>
		</div>
		<div class="hidden-lg">
		<?php echo $this->Html->image('study2.png', ['alt' => 'CakePHP', 'width' => 200, 'class' => 'imageMobileIndex']); ?>
		</div>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam egestas velit eu ullamcorper. Vestibulum risus urna, mollis vel interdum sit amet, mattis vel elit. Donec at volutpat urna. Suspendisse non tempor felis. Nullam pulvinar dictum erat eu pretium. In eu fermentum quam. 
		</p>
	</div>
</div>
<div class="col-md-4">
	<div class="indexMenu">
		<h2>Seguimiento</h2>
		<div class="visible-lg">
			<?php echo $this->Html->image('study3.png', ['alt' => 'CakePHP', 'width' => 300]); ?>
		</div>
		<div class="hidden-lg">
		<?php echo $this->Html->image('study3.png', ['alt' => 'CakePHP', 'width' => 200, 'class' => 'imageMobileIndex']); ?>
		</div>
		<p>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam egestas velit eu ullamcorper. Vestibulum risus urna, mollis vel interdum sit amet, mattis vel elit. Donec at volutpat urna. Suspendisse non tempor felis. Nullam pulvinar dictum erat eu pretium. In eu fermentum quam. 
		</p>
	</div>
</div>

<div id="add" class="modal fade" role="dialog">
  	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Login</h4>
	      </div>
	      	<div class="modal-body">
		        <?= $this->Flash->render('auth') ?>
				<?= $this->Form->create() ?>
				<?= $this->Form->input('Usuario', ['class' => 'form-control', 'name' => 'username']) ?>
	    		<?= $this->Form->input('Contraseña',['type' => 'password', 'class' => 'form-control', 'name' => 'password']) ?>
				<?= $this->Form->submit('Login', ['class' => 'btn btn-success buttonAddForm'] ); ?>
				<?= $this->Form->end() ?>
	    	</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

  	</div>
</div> <!-- modal add -->