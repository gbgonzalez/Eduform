<!-- File: /app/View/User/index.ctp -->
<div ng-controller="AppCtrl" layout="column" ng-cloak>
<h1 class="titleAdmin"> Administración de contenidos</h1>
<?= $this->Flash->render() ?>

<?php if( $current_user['role'] == 'Administrador')
{
?>
<button class="btn btn-success" data-toggle="modal" data-target="#addContent">Añadir Contenido </button>
<?php
}
?>
<form class="form-inline formSearch">
  <div class="form-group">
    <label for="email">Buscar:</label>
    <input type="text" class="form-control" ng-model="criteria" ng-change="searchContent(criteria)">
  </div>
  <select name="repeatSelect" id="repeatSelect"  class="form-control" ng-model="filterSelected">
      <option ng-repeat="option in filterType.types" value="{{option.name}}">{{option.name}}
      </option>
   </select>
</form>

<table ng-show=!showFilter class="table table-striped">
    <thead>
      <tr>
        <th>Nombre </th>
        <th class="visible-lg">Competencia</th>
        <th>Archivos Adjuntos</th>
        <th>Mostrar </th>
        <?php if( $current_user['role'] == 'Administrador')
        {
        ?>
        <th class="visible-lg">Modificar </th>
        <th>Eliminar </th>
        <?php
        }
        ?>

      </tr>
    </thead>
    <tbody>
    	<tr ng-repeat="content in contents">
    		<td> {{content.name}}</td>
			<td class="visible-lg"> {{content.competence.name}}</td>		
			<td>
				<button class="btn btn-warning" data-toggle="modal" data-target="#files{{content.id}}">
					<span class="visible-lg">Archivos </span> 
					<span class="hidden-lg"> · </span>
				</button>
			</td>
			<td>
				<button class="btn btn-info" data-toggle="modal" data-target="#content{{content.id}}">
					<span class="visible-lg">Mostrar </span> 
					<span class="hidden-lg"> · </span>
				</button>
			</td>
      <?php if( $current_user['role'] == 'Administrador')
      {
      ?>
			<td class="visible-lg">
				<button class="btn btn-default" data-toggle="modal" data-target="#updateContent{{content.id}}">Modificar </button>
			</td>
			<td>
				<button class="btn btn-danger" data-toggle="modal" data-target="#deleteContent{{content.id}}">
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
        <th class="visible-lg">Competencia</th>
        <th>Archivos Adjuntos</th>
        <th>Mostrar </th>
        <?php if( $current_user['role'] == 'Administrador')
        {
        ?>
        <th class="visible-lg">Modificar </th>
        <th>Eliminar </th>
        <?php
        }
        ?>

      </tr>
    </thead>
    <tbody>
    	<tr ng-repeat="content in resultSearch">
    		<td> {{content.name}}</td>
			<td class="visible-lg"> {{content.competence.name}}</td>		
			<td>
				<button class="btn btn-warning" data-toggle="modal" data-target="#files{{content.id}}">
					<span class="visible-lg">Archivos </span> 
					<span class="hidden-lg"> · </span>
				</button>
			</td>
			<td>
				<button class="btn btn-info" data-toggle="modal" data-target="#content{{content.id}}">
					<span class="visible-lg">Mostrar </span> 
					<span class="hidden-lg"> · </span>
				</button>
			</td>
      <?php if( $current_user['role'] == 'Administrador')
      {
      ?>
			<td class="visible-lg">
				<button class="btn btn-default" data-toggle="modal" data-target="#updateContent{{content.id}}">Modificar </button>
			</td>
			<td>
				<button class="btn btn-danger" data-toggle="modal" data-target="#deleteContent{{content.id}}">
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
<?php foreach ($contents as $content) 
{ ?>
		<div id="content<?php echo $content['id']; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Información de contenido</h4>
		      </div>
		      <div class="modal-body">
		        <p><b>Nombre: </b> <?php echo $content['name']; ?></p>
		        <p><b>Descripcion: </b> <?php echo $content['description']; ?></p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>
<?php } ?>


<?php if( $current_user['role'] == 'Administrador')
{
?>
<!-- modal add user -->
<div id="addContent" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Añadir Contenido</h4>
      </div>
      <div class="modal-body">
        <?php 
        	
		  	echo $this->Form->create('Post', array('url' => '/contents/add'));
		  	echo $this->Form->input('Nombre', 
		  			['type' => 'text', 'class' => 'form-control', 'name' => 'name']);

		  	echo "<label> Competencia Asociada </label>";
			echo $this->Form->select('competence_id', $competencesForm, 
					['class' => 'form-control']);

			echo $this->Form->input('Descripción', ['type' => 'textarea', 'class' => 'form-control', 'name' => 'description']);



			echo $this->Form->submit('Crear Contenido', ['class' => 'btn btn-success buttonAddForm']) ;
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
<?php foreach ($contents as $content) 
{ ?>
		<div id="deleteContent<?php echo $content['id']; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Eliminar</h4>
		      </div>
		      <div class="modal-body">
		        <p> ¿Deseas borrar este contenido? </p>
		      </div>
		      <div class="modal-footer">
		      	<div class="buttonsFooter">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			        <?php
			        	echo $this->Form->create('Post', array('url' => '/contents/delete'));
			  			echo $this->Form->hidden('id', ['value' => $content['id']]);
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
<?php foreach ($contents as $content) 
{ ?>
		<div id="updateContent<?php echo $content['id']; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Modificar</h4>
		      </div>
		      <div class="modal-body">
		        <?php 

				  	echo $this->Form->create('Post', array('url' => '/contents/update'));

				  	echo $this->Form->hidden('id', ['value' => $content['id']]);

					echo $this->Form->input('Nombre', 
						['type' => 'text', 'name' => 'name',
						'class' => 'form-control', 'value' => $content['name'] ]);

					echo "<label> Competencia: </label>";
					echo $this->Form->select('competence_id', $competencesForm, 
						['default' => $content['competence_id'], 'class' => 'form-control']);

					echo $this->Form->input('Descripción', 
						['type' => 'textarea', 'name' => 'description',
						'class' => 'form-control', 'value' => $content['description'] ]);

					echo $this->Form->submit('Modificar Contenido', ['class' => 'btn btn-default buttonAddForm']) ;

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

<!-- Modal upload file-->
<?php foreach ($contents as $content) 
{ ?>
		<div id="files<?php echo $content['id']; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Archivos asociados</h4>
		      </div>
		    	<div class="modal-body">
		    	<p> Archivos asociados </p>
		    	<table class="table">
		    		<thead>
		    		<tr>
			    		<th> Archivo </th>
			    		<th> Descargar </th>
			    		<th> Borrar </th>
			    	</tr>
			    	</thead>
			    	<tbody>

		    	<?php foreach ($files as $file)
		    	{
		    		if ( $content['id'] == $file['content_id'])
		    		{
		    			$url =  WWW_ROOT.$file['content_id']."/".$file['name'];
		    			echo "<tr>";
		    			echo "<div class='showFile' >";

		    			$link = '/contents/download/'.$file['content_id'].'/'.$file['name'];
		    			echo "<td>". $file['name']. "</td>";


		    			echo "<td>";
		    			echo $this->Html->link( 'Descargar', $link, ['target' =>'_blank', 
		    				'class' => 'btn btn-default'] );
		    			echo "</td>";


		    			echo $this->Form->create('Post', array('url' => '/contents/deleteFile'));
				  	
					  	echo $this->Form->hidden('id', ['value' => $file['id']]);
						echo "<td>";
						echo $this->Form->submit('Eliminar', ['class' => 'btn btn-danger']) ;
						echo "</td>";
						echo $this->Form->end(); 


						echo "</div>";

		    		}
		    		
		    	}
		    	?>
		    	</tbody>
		    	</table>
		        <?php 
		      if( $current_user['role'] == 'Administrador'){

				  	echo $this->Form->create($content, ['type'=> 'file', 'url' => '/contents/uploadFile']);
				  	
				  	echo $this->Form->hidden('id', ['value' => $content['id']]);
					
				  	echo $this->Form->input('contents.files', ['type' => 'file', 
				  				'label'=> 'Añadir Archivo']);

					echo $this->Form->submit('Subir Archivo', ['class' => 'btn btn-success buttonAddForm']) ;

					echo $this->Form->end();

          }

				?>
      		</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
    	</div>

		  </div>
		</div>
<?php } ?>

</div>
<script>
	var contents = <?php echo json_encode(compact('contents')); ?>;
</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<?= $this->Html->script('contents.js') ?>