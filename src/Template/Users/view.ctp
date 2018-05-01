<!-- File: /app/View/User/index.ctp -->
<div ng-controller="AppCtrl" layout="column" ng-cloak>
<h1 class="titleAdmin"> Bienvenido, <?php echo $current_user['username']; ?> </h1>
<?= $this->Flash->render() ?>

<div class="col-md-12">
	<div class="buttonMenuProfile">
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#userInfo">
  			Ver mis datos
		</button>
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#updateInfo">
  			Modificar mis datos
		</button>
	</div>
</div>
<div class="col-md-12">
	<p class="headSubjects"> Mis Materias </p>
	<ul>
		<li ng-repeat="dataUser in dataUsers" class="subjectMenu">
			<p class="titleSubjects"> {{ dataUser.SubjectName }} </p>
			<ul>
				<p> Competencias </p>
				<div ng-repeat="competences in dataUser.Competences">
					<li ng-repeat="competence in competences">

						<a href="/competences/view/{{competence.id}}"> {{ competence.name }} </a>
					</li>
				</div>
			</ul>
		</li>

	</ul>

</div>

<div class="col-md-12">
 	<div ng-show="menuCompetences">
		<p> Competencias </p>
		<ul>

			<li ng-repeat="competence in competences[0]">
				<a href="/competences/view/{{competence.id}}"> {{ competence.name }} </a>
			</li>

		</ul>
	</div>
</div>

<!-- Modal show info-->
<div class="modal fade" id="userInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mis datos</h4>
      </div>
      <div class="modal-body">
        	<p><b>Nombre:</b> <?php echo $current_user['username']; ?> </p>
        	<p><b>DNI:</b> <?php echo $current_user['dni']; ?> </p>
        	<p><b>Email:</b> <?php echo $current_user['email']; ?> </p>
        	<p><b>Dirección:</b> <?php echo $current_user['address']; ?> </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal update info-->
<div class="modal fade" id="updateInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modificar datos</h4>
      </div>
      <div class="modal-body">
      	<?php 
            echo $this->Form->create('Post', array('url' => '/users/profileUpdate'));

            echo $this->Form->hidden('id', ['value' => $current_user['id']]);
            echo $this->Form->input('Nombre de usuario', 
              ['type' => 'text', 'class' => 'form-control', 'value' => $current_user['username'], 'name' => 'username'  ]);
			echo $this->Form->input('DNI', 
              ['type' => 'text', 'class' => 'form-control', 'value' => $current_user['dni'] ]);
          	echo $this->Form->input('Email', 
            ['type' => 'text', 'class' => 'form-control', 'value' => $current_user['email'] ]);
            echo $this->Form->input('Dirección', 
            ['type' => 'text', 'class' => 'form-control', 'value' => $current_user['address'], 'name' => 'address' ]);
            echo $this->Form->input('Cambiar constraseña', 
            ['type' => 'password', 'class' => 'form-control', 'name' => 'password' ]);
          	echo $this->Form->submit('Modificar Datos', ['class' => 'btn btn-default buttonAddForm']) ;
          	echo $this->Form->end() 
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


</div>
<script>
	var dataUsers = <?php echo json_encode(compact('dataUsers')) ?>;
</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<?= $this->Html->script('usersProfile.js') ?>