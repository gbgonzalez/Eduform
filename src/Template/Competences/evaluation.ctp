<!-- File: /app/View/Competences/index.ctp -->
<div ng-controller="AppCtrl" layout="column" ng-cloak>
<h1 class="titleAdmin"> Administración de Competencia </h1>
<?= $this->Flash->render() ?>
<form class="form-inline formSearch">
  <div class="form-group">
    <label for="email">Buscar:</label>
    <input type="text" class="form-control" ng-model="criteria" ng-change="searchEvaluation(criteria)">
  </div>
  <select name="repeatSelect" id="repeatSelect"  class="form-control" ng-model="filterSelected">
      <option ng-repeat="option in filterType.types" value="{{option.name}}">{{option.name}}</option>
    </select>
</form>

<table ng-show=!showFilter class="table table-striped">
    <thead>
      <tr>
        <th>Nombre Usuario </th>
        <th class="visible-lg">Email</th>
        <th>Competencia </th>
        <th>Nota </th>
        <th>Evaluar </th>

      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="evaluation in evaluations">
	      <td> {{evaluation.username}}</td>
	      <td class="visible-lg"> {{evaluation.email}}</td>
	      <td> {{evaluation.name}}</td>
        <td> {{evaluation.numericnote}}{{evaluation.booleannote}}</td>
	      <td>
	        <button class="btn btn-success" data-toggle="modal" data-target="#evaluation{{evaluation.id}}">
              <span class="visible-lg">Evaluar </span> 
              <span class="hidden-lg"> · </span>
          </button>
	      </td>
      </tr>    
    </tbody>
</table>

<!-- filter search -->
<table ng-show=showFilter class="table table-striped">
    <thead>
      <tr>
        <th>Nombre Usuario </th>
        <th class="visible-lg">Email</th>
        <th>Competencia </th>
        <th>Nota </th>
        <th>Evaluar </th>

      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="evaluation in resultSearch">
        <td> {{evaluation.username}}</td>
        <td class="visible-lg"> {{evaluation.email}}</td>
        <td> {{evaluation.name}}</td>
        <td> {{evaluation.numericnote}}{{evaluation.booleannote}}</td>
        <td>
          <button class="btn btn-success" data-toggle="modal" data-target="#evaluation{{evaluation.id}}">
              <span class="visible-lg">Evaluar </span> 
              <span class="hidden-lg"> · </span>
          </button>
        </td>
      </tr>    
    </tbody>
</table>

<!-- Modal show info-->
<?php foreach ($evaluations as $evaluation) 
{ ?>
    <div id="evaluation<?php echo $evaluation['id']; ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Información de usuario</h4>
          </div>
          <div class="modal-body">
            <p><b>Nombre: </b> <?php echo $evaluation['username']; ?></p>
            <p><b>Email: </b> <?php echo $evaluation['email']; ?></p>
            <p><b>Competencia: </b> <?php echo $evaluation['name']; ?></p>
            <div class="evaluationFormDelete">
	            <p><b> Calificación: </b> 
	            <?php 
	            if ( $evaluation['numericnote'] == '' && $evaluation['booleannote'] == '' )
	            {
	            	echo "Esta competencia no ha sido calificada todavía";
	            }else{
	            	if ( $evaluation['numericnote'] != '' ){
	            		echo $evaluation['numericnote'];
	            	}else{
	            		echo $evaluation['booleannote'];
	            	}
	            	echo $this->Form->create('Post', 
				    array('url' => '/competences/deleteEvaluation'));
				    echo $this->Form->hidden('id', ['value' => $evaluation['id']] );
				    echo $this->Form->submit('Borrar Calificación', ['class' => 'btn btn-danger']) ;
					echo $this->Form->end() ;
	            }
	            ?>
	            </p>
	        </div>
            <p class="noteModal"><b> Introduce tu nota </b></p>
            <?php 
            $notes = ['a' => 'Aprobado', 's' => 'Suspenso', 'c' => 'Seleccione Calificación'];
		  	echo $this->Form->create('Post', array('url' => '/competences/addEvaluation'));
		  	echo $this->Form->hidden('id', ['value' => $evaluation['id'] ]);
        	echo $this->Form->input('Nota numérica', ['type' => 'number', 'class' => 'form-control'
		  			, 'name' => 'numericNote', 'note' => 'note', 'mix' => 0, 'max' => 10, 'step' => '.01']);
        	echo "<p><b> Nota dual </b></p>";
			echo $this->Form->select('dualNote', $notes, ['default' => 'c', 'class' => 'form-control']);
			echo $this->Form->submit('Evaluar', ['class' => 'btn btn-success buttonAddForm']);
			echo $this->Form->end() 
		  ?>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>

      </div>
    </div>
<?php } ?>






</div><!-- div of angular controller -->
<script>
  
  var evaluations = <?php echo json_encode(compact('evaluations')); ?>;

</script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<?= $this->Html->script('evaluations.js'); ?>