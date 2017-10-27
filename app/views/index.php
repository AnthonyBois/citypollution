<?php  include __DIR__ ."./header.php" ?>
<h1 class="text-center"> Air Quality </h1>
<h3 class="text-center"> Select a city </h3>

<hr>


<?php if (count($cityModel->city) > 0): ?>

	<section class="text-center" style="margin-bottom: 75%; margin-top: 40px;">
		<div class="list-group ">
 			<?php foreach ($cityModel->city as $city): ?>
 				<a href="./<?= $city->getCityApiName() ?>" class="list-group-item col-xs-4 col-xs-offset-4"><?= $city->getCityName() ?></a>
			<?php endforeach ?>
		</div>
	</section>

<?php endif ?>


<?php  include __DIR__ ."./footer.php" ?>
