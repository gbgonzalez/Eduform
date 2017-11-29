<!-- File: /app/View/Materia/index.ctp -->

<h1 class="titleAdmin"> Administración de Materia </h1>
<button class="btn btn-success" data-toggle="modal" data-target="#addMatter">Añadir Materia </button>
<table class="table table-striped">
    <thead>
      <tr>
        <th>Nombre </th>
        <th>Descripcion</th>
        <th>Mostrar</th>
        <th>Modificar </th>
        <th>Eliminar </th>
      </tr>
    </thead>
    <tbody>
    	<?php    		
			foreach ($subjects as $subject) {
				?>
					<tr>
						<td> <?php echo $subject['name']; ?> </td>
						<td> <?php echo $subject['description']; ?> </td>
	
            <td>
              <button class="btn btn-info" data-toggle="modal" data-target="#subject<?php echo $subject['id']; ?>">Mostrar </button>
            </td>
						<td>
							<button class="btn btn-default" data-toggle="modal" data-target="#updateMatter<?php echo $subject['id']; ?>">Modificar </button>
						</td>
						<td>
							<button class="btn btn-danger" data-toggle="modal" data-target="#deleteMatter<?php echo $subject['id']; ?>">Eliminar </button>
						</td>
					</tr>
		<?php
			}
		?>
     
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
            <h4 class="modal-title">Información de usuario</h4>
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
<div id="addMatter" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Añadir Materia</h4>
      </div>
      <div class="modal-body">
        <?php 
        	$roles = ['Alumno' => 'Alumno', 'Gestor de contenidos' => 'Gestor de contenidos', 'Administrador' => 'Administrador'];
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

<!-- Modal Delete-->
<?php foreach ($subjects as $subject) 
{ ?>
    <div id="deleteMatter<?php echo $subject['id']; ?>" class="modal fade" role="dialog">
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


<!-- Modal Update-->
<?php foreach ($subjects as $subject) 
{ ?>
    <div id="updateMatter<?php echo $subject['id']; ?>" class="modal fade" role="dialog">
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