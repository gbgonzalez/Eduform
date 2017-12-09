<!-- File: /app/View/User/index.ctp -->
<div ng-controller="AppCtrl" layout="column" ng-cloak>
<h1 class="titleAdmin"> Administración de usuario </h1>

<button class="btn btn-success" data-toggle="modal" data-target="#addUser">Añadir Usuario </button>
<form class="form-inline formSearch">
  <div class="form-group">
    <label for="email">Buscar:</label>
    <input type="text" class="form-control" ng-model="criteria" ng-change="searchUser(criteria)">
  </div>
  <select name="repeatSelect" id="repeatSelect"  class="form-control" ng-model="filterSelected">
      <option ng-repeat="option in filterType.types" value="{{option.name}}">{{option.name}}</option>
    </select>
</form>

<table ng-show=!showFilter class="table table-striped">
    <thead>
      <tr>
        <th>Nombre </th>
        <th>DNI</th>
        <th>Tipo</th>
        <th>Email </th>
        <th>Masterias </th>
        <th>Mostrar </th>
        <th>Modificar </th>
        <th>Eliminar </th>
      </tr>
    </thead>
    <tbody>
    	
    	<tr ng-repeat="user in users">
    		<td> {{user.username}}</td>
			<td> {{user.dni}}</td>
			<td> {{user.role}}</td>
			<td> {{user.email}}</td>
		
			<td>
				<button class="btn btn-warning" data-toggle="modal" data-target="#subjects{{user.id}}">Materias </button>
			</td>
			<td>
				<button class="btn btn-info" data-toggle="modal" data-target="#user{{user.id}}">Mostrar </button>
			</td>
			<td>
				<button class="btn btn-default" data-toggle="modal" data-target="#updateUser{{user.id}}">Modificar </button>
			</td>
			<td>
				<button class="btn btn-danger" data-toggle="modal" data-target="#deleteUser{{user.id}}">Eliminar </button>
			</td> 
    	</tr>
    	
     
    </tbody>
</table>
<table ng-show=showFilter class="table table-striped">
    <thead>
      <tr>
        <th>Nombre </th>
        <th>DNI</th>
        <th>Tipo</th>
        <th>Email </th>
        <th>Masterias </th>
        <th>Mostrar </th>
        <th>Modificar </th>
        <th>Eliminar </th>
      </tr>
    </thead>
    <tbody>
    	
    	<tr ng-repeat="user in resultSearch">
    		<p> {{user}} </p>
    		<td> {{user.username}}</td>
			<td> {{user.dni}}</td>
			<td> {{user.role}}</td>
			<td> {{user.email}}</td>
		
			<td>
				<button class="btn btn-warning" data-toggle="modal" data-target="#subjects{{user.id}}">Materias </button>
			</td>
			<td>
				<button class="btn btn-info" data-toggle="modal" data-target="#user{{user.id}}">Mostrar </button>
			</td>
			<td>
				<button class="btn btn-default" data-toggle="modal" data-target="#updateUser{{user.id}}">Modificar </button>
			</td>
			<td>
				<button class="btn btn-danger" data-toggle="modal" data-target="#deleteUser{{user.id}}">Eliminar </button>
			</td> 
    	</tr>
    	
     
    </tbody>
</table>


<!-- Modal show info-->
<?php foreach ($users as $user) 
{ ?>
		<div id="user<?php echo $user['id']; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Información de usuario</h4>
		      </div>
		      <div class="modal-body">
		        <p><b>Nombre: </b> <?php echo $user['username']; ?></p>
		        <p><b>DNI: </b> <?php echo $user['dni']; ?></p>
		        <p><b>Tipo: </b> <?php echo $user['role']; ?></p>
		        <p><b>Dirección: </b> <?php echo $user['address']; ?></p>
		        <p><b>Email: </b> <?php echo $user['email']; ?></p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>
<?php } ?>

<!-- Modal Delete-->
<?php foreach ($users as $user) 
{ ?>
		<div id="deleteUser<?php echo $user['id']; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Eliminar</h4>
		      </div>
		      <div class="modal-body">
		        <p> ¿Deseas borrar este usuario? </p>
		      </div>
		      <div class="modal-footer">
		      	<div class="buttonsFooter">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			        <?php
			        	echo $this->Form->create('Post', array('url' => '/users/delete'));
			  			echo $this->Form->hidden('id', ['value' => $user['id']]);
			  			echo $this->Form->submit('Eliminar', ['class' => 'btn btn-danger']) ;
						echo $this->Form->end();
			  		?>
			  	</div>
		      </div>
		    </div>

		  </div>
		</div>
<?php } ?>


<!-- modal add user -->
<div id="addUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Añadir Usuario</h4>
      </div>
      <div class="modal-body">
        <?php 
        	$roles = ['Alumno' => 'Alumno', 'Gestor de contenidos' => 'Gestor de contenidos', 'Administrador' => 'Administrador'];
		  	echo $this->Form->create('Post', array('url' => '/users/add'));
		  	echo $this->Form->input('DNI', ['type' => 'number', 'class' => 'form-control']);
			echo $this->Form->input('Usuario', ['type' => 'text', 'class' => 'form-control']);
			echo $this->Form->input('Contraseña', ['type' => 'password', 'class' => 'form-control', 'name'=>'password']);
			echo $this->Form->input('Email', ['type' => 'email', 'class' => 'form-control', 'name'=>'email']);
			echo $this->Form->input('Dirección', ['type' => 'text', 'class' => 'form-control', 'name'=>'address']);
			echo "<label> Rol:</label>";
			echo $this->Form->select('role', $roles, ['default' => 'Alumno', 'class' => 'form-control']);
			echo $this->Form->submit('Crear Usuario', ['class' => 'btn btn-success buttonAddForm']) ;
			echo $this->Form->end() 

		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal Update-->
<?php foreach ($users as $user) 
{ ?>
		<div id="updateUser<?php echo $user['id']; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Modificar</h4>
		      </div>
		      <div class="modal-body">
		        <?php 
		        	$roles = ['Alumno' => 'Alumno', 'Gestor de contenidos' => 'Gestor de contenidos', 'Administrador' => 'Administrador'];
				  	echo $this->Form->create('Post', array('url' => '/users/update'));

				  	echo $this->Form->hidden('id', ['value' => $user['id']]);

				  	echo $this->Form->input('DNI', 
				  		['type' => 'text', 'class' => 'form-control', 'value' => $user['dni'] ]);
					echo $this->Form->input('Usuario', 
						['type' => 'text', 'class' => 'form-control', 'value' => $user['username'] ]);
					echo $this->Form->input('Contraseña', 
						['type' => 'password', 'class' => 'form-control', 'name'=>'password', 'value' => $user['dni'] ]);
					echo $this->Form->input('Email', 
						['type' => 'email', 'class' => 'form-control', 'name'=>'email', 'value' => $user['email'] ]);
					echo $this->Form->input('Dirección', 
						['type' => 'text', 'class' => 'form-control', 'name'=>'address', 'value' => $user['address'] ]);
					echo "<label> Rol: </label>";
					echo $this->Form->select('role', $roles, 
						['default' => $user['role'], 'class' => 'form-control']);
					echo $this->Form->submit('Modificar Usuario', ['class' => 'btn btn-default buttonAddForm']) ;
					echo $this->Form->end() 

				?>
		      </div>
		      <div class="modal-footer">
		      	<div class="buttonsFooter">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			  	</div>
		      </div>
		    </div>

		  </div>
		</div>
<?php } ?>

<!-- Modal Add Subject-->
<?php foreach ($users as $user) 
{ ?>
		<div id="subjects<?php echo $user['id']; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Materias</h4>
		      </div>
		      <div class="modal-body">
		        <?php 
		        	echo "<p>".$user['name']."</p>";
		        	echo "<p> Materias asignadas: </p>";
		        	$k = 0;
		        	$arrayFiltered = array();
		        	$subjectUser = array();	
		        	foreach ( $user['competences'] as $userCompetence)
		        	{
		        		foreach ($competences as $competence)
		        		{
		        			if( $competence['id'] == $userCompetence['id'])
		        			{
		        				
		        				$subjectUser[$k] = [
		        					'user_id' => $user['id'],
		        					'subject_id' => $competence['subject']['id'],
		        					'subjectName' => $competence['subject']['name']
		        				];
		        				$k++;
		        				
		        		 	}
		        		}
		        		
		        	}

		        	if ( count($subjectUser) != 0 )
		        	{
			        	$arrayFiltered = array_map('unserialize', array_unique(array_map('serialize', $subjectUser)));

			        	$arrayKeys =  array_keys($arrayFiltered);
			        	for ($i = 0; $i < count($arrayKeys); $i++)
			        	{
			        		echo $this->Form->create('Post', 
			        			array('url' => '/users/deleteSubject'));

			        		echo $this->Form->hidden('user_id', 
			        			['value' => $arrayFiltered[ $arrayKeys[$i] ]['user_id']]);

			        		echo $this->Form->hidden('subject_id', 
			        			['value' => $arrayFiltered[ $arrayKeys[$i] ]['subject_id']]);

			        		echo "<span class='subjectModal'>";
			        		
			        		echo $arrayFiltered[ $arrayKeys[$i] ]['subjectName'];
			        				
			        		echo $this->Form->submit('X', ['class' => 'buttonDeleteSubject']) ;
			        		
			        		echo "</span>";

							echo $this->Form->end() ;
			        	}
			        }
		        	
		        	

				?>
				<hr>
				<h4> Asignar nueva materia </h4>
				<?php 
		
				  	echo $this->Form->create('Post', array('url' => '/users/addSubject'));

				  	echo $this->Form->hidden('id', ['value' => $user['id']]);
				  	

				  	echo $this->Form->select('subject_id', $subjectsForm, 
						['class' => 'form-control' ]);

					echo $this->Form->submit('Añadir Materia', ['class' => 'btn btn-default buttonAddForm']) ;
					echo $this->Form->end(); 
				 ?>

		      </div>
		      <div class="modal-footer">
		      	<div class="buttonsFooter">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			  	</div>
		      </div>
		    </div>

		  </div>
		</div>
<?php } ?>

</div> <!-- end of div controller -->
<script>
	var users = <?php echo json_encode(compact('users')) ?>;
	var subjects = <?php echo json_encode(compact('subjects')) ?>;
	var competences = <?php echo json_encode(compact('competences')) ?>;
</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<?= $this->Html->script('users.js') ?>
