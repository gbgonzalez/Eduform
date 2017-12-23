<!-- File: /app/View/User/index.ctp -->
<div ng-controller="AppCtrl" layout="column" ng-cloak>
<h1 class="titleAdmin"> Bienvenido, <?php echo $current_user['username']; ?> </h1>

<div class="col-md-12">
	<div class="buttonMenuProfile">
		<button class="btn btn-default"> Ver mis datos </button>
		<button class="btn btn-default"> Modificar mís datos </button>
	</div>
</div>
<div class="col-md-12">
	<p class="headSubjects"> Mis Materias </p>
	<ul>
		<li ng-repeat="dataUser in dataUsers" class="subjectMenu">
			<p class="titleSubjects"> {{ dataUser.SubjectName }} </p>
			<ul>
				<p> Competencias </p>
				<div ng-repeat="competences in dataUser.Competences">
					<li ng-repeat="competence in competences">

						<a href="/Eduform/competences/view/{{competence.id}}"> {{ competence.name }} </a>
					</li>
				</div>
			</ul>
		</li>

	</ul>

</div>

<div class="col-md-12">
 	<div ng-show="menuCompetences">
		<p> Competencias </p>
		<ul>

			<li ng-repeat="competence in competences[0]">
				<a href="/competences/view/{{competence.id}}"> {{ competence.name }} </a>
			</li>

		</ul>
	</div>
</div>

</div>
<script>
	var dataUsers = <?php echo json_encode(compact('dataUsers')) ?>;
</script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<?= $this->Html->script('usersProfile.js') ?>