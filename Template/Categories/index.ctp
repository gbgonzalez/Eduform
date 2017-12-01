<!-- File: /app/View/Categorie/index.ctp -->

<h1 class="titleAdmin"> Administración de Categoria </h1>
<button class="btn btn-success" data-toggle="modal" data-target="#addCategorie">Añadir Categoria </button>
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
			foreach ($categories as $categorie) {
				?>
					<tr>
						<td> <?php echo $categorie['name']; ?> </td>
						<td> <?php echo $categorie['description']; ?> </td>
	
            <td>
              <button class="btn btn-info" data-toggle="modal" data-target="#categorie<?php echo $categorie['id']; ?>">Mostrar </button>
            </td>
						<td>
							<button class="btn btn-default" data-toggle="modal" data-target="#updateCategorie<?php echo $categorie['id']; ?>">Modificar </button>
						</td>
						<td>
							<button class="btn btn-danger" data-toggle="modal" data-target="#deleteCategorie<?php echo $categorie['id']; ?>">Eliminar </button>
						</td>
					</tr>
		<?php
			}
		?>
     
    </tbody>
  </table>	

<!-- Modal show info-->
<?php foreach ($categories as $categorie) 
{ ?>
    <div id="categorie<?php echo $categorie['id']; ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Información de usuario</h4>
          </div>
          <div class="modal-body">
            <p><b>Nombre: </b> <?php echo $categorie['name']; ?></p>
            <p><b>Descripcion: </b> <?php echo $categorie['description']; ?></p>
            <?php foreach ($subjectsb as $subject){
              if ($subject['id'] == $categorie['subject_id']){ ?>
                    
                 <p><b>Nombre Materia: </b> <?php echo $subject->name; ?></p>
              <?php
              }
            }?>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>
<?php } ?>

  <!-- modal add categories -->
<div id="addCategorie" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Añadir Categoria</h4>
      </div>
      <div class="modal-body">
        <?php 
        	$roles = ['Alumno' => 'Alumno', 'Gestor de contenidos' => 'Gestor de contenidos', 'Administrador' => 'Administrador'];
		  	echo $this->Form->create('Post', array('url' => '/categories/add'));
		  	echo $this->Form->input('Nombre', ['type' => 'text', 'class' => 'form-control'
		  			, 'name' => 'name']);
			 echo $this->Form->input('Descripción', ['type' => 'textarea', 'class' => 'form-control'
				, 'name' => 'description']);

      echo $this->Form->input('subject_id',['options' => $subjects , 'label' => 'Materia: '])  ;

			echo $this->Form->submit('Crear Categoria', ['class' => 'btn btn-success buttonAddForm']) ;

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
<?php foreach ($categories as $categorie) 
{ ?>
    <div id="deleteCategorie<?php echo $categorie['id']; ?>" class="modal fade" role="dialog">
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
              echo $this->Form->hidden('id', ['value' => $categorie['id']]);
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
<?php foreach ($categories as $categorie) 
{ ?>
    <div id="updateCategorie<?php echo $categorie['id']; ?>" class="modal fade" role="dialog">
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

            echo $this->Form->hidden('id', ['value' => $categorie['id']]);

            echo $this->Form->input('name', 
              ['type' => 'text', 'class' => 'form-control', 'value' => $categorie['name'] ]);
          echo $this->Form->input('description', 
            ['type' => 'text', 'class' => 'form-control', 'value' => $categorie['description'] ]);

          echo $this->Form->input('subject_id',['options' => $subjects , 'label' => 'Materia: '])  ;

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