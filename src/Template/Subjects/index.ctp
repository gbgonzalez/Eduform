<!-- File: /app/View/Materia/index.ctp -->
<div ng-controller="AppCtrl" layout="column" ng-cloak>
<h1 class="titleAdmin"> Administración de Materia </h1>
<?= $this->Flash->render() ?>

<?php if( $current_user['role'] == 'Administrador')
{
?>
<button class="btn btn-success" data-toggle="modal" data-target="#addSubject">Añadir Materia </button>
<?php
}
?>
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
        <th>Mostrar </th>

        <?php if( $current_user['role'] == 'Administrador')
        {
        ?>
          <th>Modificar </th>
          <th>Eliminar </th>
        <?php
        }
        ?>

      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="subject in subjects">
        <td> {{subject.name}}</td>
      <td>
        <button class="btn btn-info" data-toggle="modal" data-target="#subject{{subject.id}}">
          <span class="visible-lg">Mostrar </span> 
          <span class="hidden-lg"> · </span>
        </button>
      </td>

      <?php if( $current_user['role'] == 'Administrador')
      {
      ?>
      <td>
        <button class="btn btn-default" data-toggle="modal" data-target="#updateSubject{{subject.id}}">
          <span class="visible-lg">Modificar </span> 
          <span class="hidden-lg"> · </span>
        </button>
      </td>
      <td>
        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteSubject{{subject.id}}">
          <span class="visible-lg">Eliminar </span> 
          <span class="hidden-lg"> · </span>
        </button>
      </td> 
      <?php
      }
      ?>
      </tr>
      
     
    </tbody>
</table>
<table ng-show=showFilter class="table table-striped">
    <thead>
      <tr>
        <th>Nombre </th>
        <th>Mostrar </th>
        <?php if( $current_user['role'] == 'Administrador')
        {
        ?>
        <th>Modificar </th>
        <th>Eliminar </th>
        <?php
        }
        ?>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="subject in resultSearch">
        <td> {{subject.name}}</td>
    
      <td>
        <button class="btn btn-info" data-toggle="modal" data-target="#subject{{subject.id}}">
          <span class="visible-lg">Mostrar </span> 
          <span class="hidden-lg"> · </span>
        </button>
      </td>
      <?php if( $current_user['role'] == 'Administrador')
        {
        ?>
      <td>
        <button class="btn btn-default" data-toggle="modal" data-target="#updateSubject{{subject.id}}">
          <span class="visible-lg">Modificar </span> 
          <span class="hidden-lg"> · </span>
        </button>
      </td>
      <td>
        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteSubject{{subject.id}}">
          <span class="visible-lg">Eliminar </span> 
          <span class="hidden-lg"> · </span>
        </button>
      </td> 
        <?php
        }
        ?>
      </tr>
      
     
    </tbody>
</table>

<!-- Modal show info-->
<?php foreach ($subjects as $subject) 
{ ?>
    <div id="subject<?php echo $subject['id']; ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Información de materia</h4>
          </div>
          <div class="modal-body">
            <p><b>Nombre: </b> <?php echo $subject['name']; ?></p>
            <p><b>Descripcion: </b> <?php echo $subject['description']; ?></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
<?php } ?>


<!-- modal add subjects -->
<?php if( $current_user['role'] == 'Administrador')
{
?>
<div id="addSubject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Añadir Materia</h4>
      </div>
      <div class="modal-body">
        <?php 
      
		  	echo $this->Form->create('Post', array('url' => '/subjects/add'));
		  	echo $this->Form->input('Nombre', ['type' => 'text', 'class' => 'form-control'
		  			, 'name' => 'name']);
			echo $this->Form->input('Descripción', ['type' => 'textarea', 'class' => 'form-control'
				, 'name' => 'description']);
			echo $this->Form->submit('Crear Materia', ['class' => 'btn btn-success buttonAddForm']) ;
			echo $this->Form->end() 

		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php
}
?>


<!-- Modal Delete-->
<?php if( $current_user['role'] == 'Administrador')
{
?>
<?php foreach ($subjects as $subject) 
{ ?>
    <div id="deleteSubject<?php echo $subject['id']; ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Eliminar</h4>
          </div>
          <div class="modal-body">
            <p> ¿Deseas borrar esta materia? </p>
          </div>
          <div class="modal-footer">
            <div class="buttonsFooter">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <?php
                echo $this->Form->create('Post', array('url' => '/subjects/delete'));
              echo $this->Form->hidden('id', ['value' => $subject['id']]);
              echo $this->Form->submit('Eliminar', ['class' => 'btn btn-danger']) ;
            echo $this->Form->end();
            ?>
          </div>
          </div>
        </div>

      </div>
    </div>
<?php } ?>
<?php
}
?>


<!-- Modal Update-->
<?php if( $current_user['role'] == 'Administrador')
{
?>
<?php foreach ($subjects as $subject) 
{ ?>
    <div id="updateSubject<?php echo $subject['id']; ?>" class="modal fade" role="dialog">
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
            echo $this->Form->create('Post', array('url' => '/subjects/update'));

            echo $this->Form->hidden('id', ['value' => $subject['id']]);

            echo $this->Form->input('name', 
              ['type' => 'text', 'class' => 'form-control', 'value' => $subject['name'] ]);
          echo $this->Form->input('description', 
            ['type' => 'text', 'class' => 'form-control', 'value' => $subject['description'] ]);
          echo $this->Form->submit('Modificar Materia', ['class' => 'btn btn-default buttonAddForm']) ;
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
<?php
}
?>
</div>
<script>
  var subjects = <?php echo json_encode(compact('subjects')) ?>
</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<?= $this->Html->script('subjects.js') ?>
