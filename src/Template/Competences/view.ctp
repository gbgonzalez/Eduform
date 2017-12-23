<!-- File: /app/View/User/index.ctp -->
<div ng-controller="AppCtrl" layout="column" ng-cloak>
<h1 class="titleAdmin"> {{ competenceContentFile.name }}</h1>

<div class="col-md-12">
	<h2> Contenido </h2>
	<table class ="table table-zebra">
		<thead>
			<tr>
				<th> Contenido </th>
				<th> Información </th>
				<th> Adjuntos </th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="content in competencesContentFile.contents"> 
				<td> {{ content.name }}</td>
				<td> <button class="btn btn-info" data-toggle="modal" data-target="#info{{content.id}}">Información </button> </td>
				<td>
					<ul>
						<li ng-repeat="file in content.files">
							<a href="/Eduform/contents/download/{{content.id}}/{{file.name}}" target="_blank">
								{{ file.name }}
							</a>
						</li>
					</ul>
				</td>
			</tr>

		</tbody>
	</table>
</div>


</div>

<!-- Modal show info-->
<?php for ( $i=0; $i<count($competencesContentFile['contents']); $i++) 
{ 
	$content =  $competencesContentFile['contents'][$i];	
	?>
		<div id="info<?php echo $content['id']; ?>" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Información de contenido</h4>
		      </div>
		      <div class="modal-body">
		        <p>
		        	<?php echo $content['description']; ?>
		        </p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>

		  </div>
		</div>
<?php } ?>

<script>
	var competencesContentFile = <?php echo json_encode(compact('competencesContentFile')) ?>;
</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<?= $this->Html->script('CompetenceProfile.js') ?>