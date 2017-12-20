<!-- File: /app/View/User/index.ctp -->
<div ng-controller="AppCtrl" layout="column" ng-cloak>
<h1 class="titleAdmin"> {{ competence.name }}</h1>

<div class="col-md-12">
	<h2> Contenido </h2>
	<ul class="listCompetences">
		<li ng-repeat="content in contents"> 
			<ul class="listCompetencesMenu">
				<li> {{ content.name }} </li>
				<li> <button class="btn btn-info" data-toggle="modal" data-target="#info{{content.id}}">Información </button> </li>
				<li> <button ng-click="showFiles(content.id)" class="btn btn-default"> Adjuntos </button> </li>
			</ul>
		</li>
	</ul>

	<div class="col-md-12">
		<div ng-show="showFilesFlag">
			<ul>
				<li ng-repeat="contentFile in contentFiles">
					<a target='_blank' href="/Eduform/contents/download/{{contentFile.content.id}}/{{contentFile.name}}">
						{{ contentFile.name}}
					</a>	
				</li>
			</ul>


		</div>
	</div>
</div>


</div>

<!-- Modal show info-->
<?php foreach ($contents as $content) 
{ ?>
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
	var competence = <?php echo json_encode(compact('competence')) ?>;
	var contents = <?php echo json_encode(compact('contents')) ?>;
	var files = <?php echo json_encode(compact('files')) ?>;


</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<?= $this->Html->script('CompetenceProfile.js') ?>