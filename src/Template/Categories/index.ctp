<!-- File: /app/View/Categorie/index.ctp -->
<div ng-controller="AppCtrl" layout="column" ng-cloak>
<h1 class="titleAdmin"> Administración de Categoria </h1>
<?= $this->Flash->render() ?>
<?php if( $current_user['role'] == 'Administrador')
{
?>
<button class="btn btn-success" data-toggle="modal" data-target="#addCategory">Añadir Categoria </button>
<?php
}
?>
<form class="form-inline formSearch">
  <div class="form-group">
    <label for="email">Buscar:</label>
    <input type="text" class="form-control" ng-model="criteria" ng-change="searchCategory(criteria)">
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
      <tr ng-repeat="category in categories">
      <td> {{category.name}}</td>
      <td>
        <button class="btn btn-info" data-toggle="modal" data-target="#category{{category.id}}">
          <span class="visible-lg">Mostrar </span> 
          <span class="hidden-lg"> · </span>
        </button>
      </td>
      <?php if( $current_user['role'] == 'Administrador')
      {
      ?>
      <td>
        <button class="btn btn-default" data-toggle="modal" data-target="#updateCategory{{category.id}}"> 
          <span class="visible-lg">Modificar </span> 
          <span class="hidden-lg"> · </span>
        </button>
      </td>
      <td>
        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCategory{{category.id}}">
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
      <tr ng-repeat="category in resultSearch">
      <td> {{category.name}}</td>
      <td>
        <button class="btn btn-info" data-toggle="modal" data-target="#category{{category.id}}">
          <span class="visible-lg">Mostrar </span> 
          <span class="hidden-lg"> · </span>
        </button>
      </td>
        <?php if( $current_user['role'] == 'Administrador')
        {
        ?>
      <td>
        <button class="btn btn-default" data-toggle="modal" data-target="#updateCategory{{category.id}}">
          <span class="visible-lg">Modificar </span> 
          <span class="hidden-lg"> · </span>
        </button>
      </td>
      <td>
        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCategory{{category.id}}">
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
<?php foreach ($categories as $category) 
{ ?>
    <div id="category<?php echo $category['id']; ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Información de usuario</h4>
          </div>
          <div class="modal-body">
            <p><b>Nombre: </b> <?php echo $category['name']; ?></p>
            <p><b>Descripcion: </b> <?php echo $category['description']; ?></p>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
<?php } ?>

  <!-- modal add categories -->
<?php if( $current_user['role'] == 'Administrador')
{
?>
<div id="addCategory" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Añadir Categoria</h4>
      </div>
      <div class="modal-body">
        <?php 

		  	echo $this->Form->create('Post', array('url' => '/categories/add'));
		  	
        echo $this->Form->input('Nombre', ['type' => 'text', 'class' => 'form-control'
		  			, 'name' => 'name']);

			  echo $this->Form->input('Descripción', ['type' => 'textarea', 'class' => 'form-control', 'name' => 'description']);

			  echo $this->Form->submit('Crear Categoria', ['class' => 'btn btn-success buttonAddForm']);

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
<?php foreach ($categories as $category) 
{ ?>
    <div id="deleteCategory<?php echo $category['id']; ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Eliminar</h4>
          </div>
          <div class="modal-body">
            <p> ¿Deseas borrar esta categoria? </p>
          </div>
          <div class="modal-footer">
            <div class="buttonsFooter">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <?php
                echo $this->Form->create('Post', array('url' => '/categories/delete'));
              echo $this->Form->hidden('id', ['value' => $category['id']]);
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
<?php foreach ($categories as $category) 
{ ?>
    <div id="updateCategory<?php echo $category['id']; ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modificar</h4>
          </div>
          <div class="modal-body">
            <?php 
            echo $this->Form->create('Post', array('url' => '/categories/update'));

            echo $this->Form->hidden('id', ['value' => $category['id']]);

            echo $this->Form->input('name', 
              ['type' => 'text', 'class' => 'form-control', 'value' => $category['name'] ]);
            

            echo $this->Form->input('description', 
            ['type' => 'textarea', 'class' => 'form-control', 'value' => $category['description'] ]);

          

          echo $this->Form->submit('Modificar Categoria', ['class' => 'btn btn-default buttonAddForm']) ;
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
</div> <!-- end of angular controller div -->
<script>
  var categories = <?php echo json_encode(compact('categories')); ?>
</script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<?= $this->Html->script('categories.js'); ?>