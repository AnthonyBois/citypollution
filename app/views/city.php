<?php  include __DIR__ ."./header.php" ?>
<h1 class="text-center"> Air Quality - <?= $cityModel->api->getCity()->getCityName() ?></h1>

<hr>
<?php if ($cityModel->error): ?>
	<div class="alert alert-<?= $cityModel->success ? "success" : "danger" ?> alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	 	<?=  $cityModel->error ?>
	</div>
<?php endif ?>
	<section class="text-center" style="margin-bottom: 100px; margin-top: 40px;">
		<div class="row">
		<?php foreach ($cityModel->json->data as $data) : ?>
			<div class="col-md-4">
				<div class="panel panel-default">
				  <div class="panel-heading"><?= $data->station->name ?></div>
				  <div class="panel-body">
						<h1><span class="label label-<?=
							$data->aqi< 50 ? "success"
								: ($data->aqi < 100 ? "warning"
								: ($data->aqi < 150 ? "danger" : "default"))
						?>"><?= $data->aqi ?></span></h1>
						<p> <b>Last statement</b> : <?= $data->time->stime ?> </p>
					</div>
				</div>
			</div>
		<?php endforeach ?>
		</div>
		<div class="row">
			<a  type="button" class="btn btn-default" href="./"><</a></li>
		</div>
	</section>



<?php  include __DIR__ ."./footer.php" ?>
