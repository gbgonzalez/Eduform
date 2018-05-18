<!-- File: /app/View/Competences/index.ctp -->
<div ng-controller="AppCtrl" layout="column" ng-cloak>
<h1 class="titleAdmin"> Administración de Competencia </h1>
<?= $this->Flash->render() ?>
  <button class="btn btn-success" data-toggle="modal" data-target="#addCompetence">
  Añadir Competencia </button>
<form class="form-inline formSearch">
  <div class="form-group">
    <label for="email">Buscar:</label>
    <input type="text" class="form-control" ng-model="criteria" ng-change="searchCompetence(criteria)">
  </div>
  <select name="repeatSelect" id="repeatSelect"  class="form-control" ng-model="filterSelected">
      <option ng-repeat="option in filterType.types" value="{{option.name}}">{{option.name}}</option>
    </select>
</form>

   
<?php
?>
  <table ng-show=!showFilter class="table table-striped">
      <thead>
        <tr>
          <th>Nombre </th>
          <th class="visible-lg">Categoria asignada </th>
          <th class="visible-lg">Materia asignada </th>
          <th>Mostrar </th>
          <th>Modificar </th>
          <th>Eliminar </th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="competence in competences">
          <td> {{competence.name}}</td>
          <td class="visible-lg">
              <p ng-repeat="category in competence.categories">
                {{ category.name  }}
              </p>
          </td>
          <td class="visible-lg"> {{ competence.subject.name }}</td>
          <td>
            <button class="btn btn-info" data-toggle="modal" data-target="#competence{{competence.id}}">
              <span class="visible-lg">Mostrar </span> 
              <span class="hidden-lg"> · </span>
            </button>
          </td>
          <td>
            <button class="btn btn-default" data-toggle="modal" data-target="#updateCompetence{{competence.id}}"> 
              <span class="visible-lg">Modificar </span> 
              <span class="hidden-lg"> · </span>
            </button>
          </td>
          <td>
            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCompetence{{competence.id}}"> 
              <span class="visible-lg">Eliminar </span> 
              <span class="hidden-lg"> · </span>
            </button>
          </td> 
        </tr>
        
       
      </tbody>
  </table>
  <table ng-show=showFilter class="table table-striped">
      <thead>
        <tr>
          <th>Nombre </th>
          <th class="visible-lg">Categoria asignada </th>
          <th class="visible-lg">Materia asignada </th>
          <th>Mostrar </th>
          <th>Modificar </th>
          <th>Eliminar </th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="competence in resultSearch">
          <td> {{competence.name}}</td>
          <td class="visible-lg">
              <p ng-repeat="category in competence.categories">
                {{ category.name  }}
              </p>
          </td>
          <td class="visible-lg"> {{ competence.subject.name }}</td>
          <td>
            <button class="btn btn-info" data-toggle="modal" data-target="#competence{{competence.id}}">
              <span class="visible-lg">Mostrar </span> 
              <span class="hidden-lg"> · </span>
            </button>
          </td>
          <td>
            <button class="btn btn-default" data-toggle="modal" data-target="#updateCompetence{{competence.id}}"> 
              <span class="visible-lg">Modificar </span> 
              <span class="hidden-lg"> · </span>
            </button>
          </td>
          <td>
            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCompetence{{competence.id}}"> 
              <span class="visible-lg">Eliminar </span> 
              <span class="hidden-lg"> · </span>
            </button>
          </td> 
        </tr>
        
       
      </tbody>
  </table>

    <!-- table filters -->
    <!-- Modal show info-->
    <?php foreach ($competences as $competence) 
    { ?>
        <div id="competence<?php echo $competence['id']; ?>" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Información de competencia</h4>
              </div>
              <div class="modal-body">
                <p><b>Nombre: </b> <?php echo $competence['name']; ?></p>
                <p><b>Descripcion: </b> <?php echo $competence['description']; ?></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
    <?php } ?>

    <!-- modal add competence -->
    <div id="addCompetence" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Añadir Competencia</h4>
          </div>
          <div class="modal-body">
            <?php

            	
    		  	echo $this->Form->create('Post', array('url' => '/competences/add'));

    		  	echo $this->Form->input('Nombre', ['type' => 'text', 'class' => 'form-control'
    		  			, 'name' => 'name']);

            echo $this->Form->input('category_id',['options' => $categoriesForms , 
                'label' => 'Categoria: ', 'class' => '', 'multiple' => 'checkbox']);

        		echo $this->Form->input('subject_id',['options' => $subjectsForms , 
        				'label' => 'Materia: ', 'class' => 'form-control']);

    			  echo $this->Form->input('Descripción', ['type' => 'textarea', 'class' => 'form-control'
    				, 'name' => 'description']);
    		  	echo $this->Form->submit('Crear Competencia', ['class' => 'btn btn-success buttonAddForm']) ;

    			  echo $this->Form->end() 

    		?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal Delete-->
    <?php foreach ($competences as $competence) 
    { ?>
        <div id="deleteCompetence<?php echo $competence['id']; ?>" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar</h4>
              </div>
              <div class="modal-body">
                <p> ¿Deseas borrar esta competencia? </p>
              </div>
              <div class="modal-footer">
                <div class="buttonsFooter">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                  <?php
                    echo $this->Form->create('Post', array('url' => '/competences/delete'));
                	echo $this->Form->hidden('id', ['value' => $competence['id']]);
                	echo $this->Form->submit('Eliminar', ['class' => 'btn btn-danger']) ;
                	echo $this->Form->end();
                ?>
              </div>
              </div>
            </div>

          </div>
        </div>
    <?php } ?>

    <!-- Modal Update-->

    <?php foreach ($competences as $competence) 
    { ?>
        <div id="updateCompetence<?php echo $competence['id']; ?>" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modificar</h4>
              </div>
              <div class="modal-body">
                <?php 
                echo $this->Form->create('Post', array('url' => '/competences/update'));

                echo $this->Form->hidden('id', ['value' => $competence['id']]);

                echo $this->Form->input('name', 
                  ['type' => 'text', 'class' => 'form-control', 'value' => $competence['name'] ]);
              	
               // print_r( $competence['categories'] );
                $arrayId = array();
                $j = 0;
                for ( $i = 0; $i < count( $competence['categories'] ) ; $i++)
                {
                  $arrayId[$j] = $competence['categories'][$i]['id'];
                  $j++;
                }

                echo $this->Form->input('category_id',['options' => $categoriesForms , 
                'label' => 'Categoria: ', 'class' => '', 'multiple' => 'checkbox',
                'value' => $arrayId ]);

                
                echo $this->Form->input('subject_id',['options' => $subjectsForms , 
        				'label' => 'Materia: ', 'class' => 'form-control', 'value' => $competence['subject_id']]) ; 
              	
                echo $this->Form->input('description', 
                ['type' => 'textarea', 'class' => 'form-control', 'value' => $competence['description'] ]);
             	
             	echo $this->Form->submit('Modificar Competencia', ['class' => 'btn btn-default buttonAddForm']) ;
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

</div><!-- div of angular controller -->
<script>
  
  var competences = <?php echo json_encode(compact('competences')); ?>;
  var categoriesCompetences = <?php echo json_encode(compact('categoriesCompetences')); ?>;
  var user = <?php echo json_encode(compact('current_user')); ?>;

</script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<?= $this->Html->script('competences.js'); ?>