<?php  include __DIR__ ."/../header.php" ?>
<h1 class="text-center"> Admin </h1>

<hr>

<?php if ($cityModel->success || $cityModel->error): ?>
	<div class="alert alert-<?= $cityModel->success ? "success" : "danger" ?> alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	 	<?= $cityModel->success ? $cityModel->success : $cityModel->error ?>
	</div>
<?php endif ?>

<section class="text-center" style="margin: 40px;">
	<form action="" method="post" class="form-inline">
	  <div class="form-group">
	    <input name="city_name" class="form-control" id="city_name" placeholder="Nom de la ville">
	  </div>
	  <div class="form-group">
	    <input name="city_api_name" class="form-control" id="city_api_name" placeholder="ID de la ville">
	  </div>
	  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>
	</form>
</section>

<hr>

<?php if (count($cityModel->city) > 0): ?>

	<section class="text-center" style="margin-bottom: 100px; margin-top: 40px;">
		<table class="table table-striped">
		  <tbody>
		  	<?php foreach ($cityModel->city as $city): ?>
			    <tr>
			      <td><?= $city->getCityName() ?></td>
			      <td><?= $city->getCityApiName() ?></td>
			      <td><a class="btn btn-danger" href="./admin?delete=<?= $city->getCityApiName() ?>"><span class=" 	glyphicon glyphicon-trash"></span></a></td>
			    </tr>
			<?php endforeach ?>
		  </tbody>
		</table>
	</section>

<?php endif ?>

<?php  include __DIR__ ."/../footer.php" ?>
