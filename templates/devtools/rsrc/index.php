<header class="page-header">
	<h1 class="page-header__title">Static resources</h1>

	<nav class="page-header__actions">
		<a class="page-header__action button button--primary" href="<?php echo url_endpoint('devtools/rsrc/add'); ?>">Add static resource</a>
	</nav>
</header>

<main class="page-content">
	<?php if(count($unbundled_resources) > 0): ?>
		<div class="panel panel--open">
			<h2 class="panel__title">
				<a class="panel__title__action" href="#">-</a>
				<span class="panel__title__text">(unbundled)</span>
			</h2>

			<div class="panel__body">
				<table>
					<thead>
						<th>Filename</th>
						<th>Type</th>
						<th>Active revision</th>
						<th>Actions</th>
					</thead>

					<tbody>
						<?php foreach($unbundled_resources as $rsrc): ?>
							<tr>
								<td><?php echo $rsrc->name; ?></td>
								<td><?php echo $rsrc->type->name; ?></td>
								<td>
									<a href="<?php echo url_endpoint('devtools/rsrc/revision', ['revision_id' => $rsrc->active_revision_id, 'name' => $rsrc->name]); ?>"><?php echo $rsrc->active_revision_id; ?></a>
								</td>
								<td>.</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php endif; ?>

	<?php foreach($rsrc_bundles as $rsrc_bundle): ?>
		<div class="panel panel--open">
			<h2 class="panel__title">
				<a class="panel__title__action" href="#">-</a>
				<span class="panel__title__text"><?php echo $rsrc_bundle->name; ?></span>
			</h2>

			<div class="panel__body">
				<table>
					<thead>
						<th>Filename</th>
						<th>Type</th>
						<th>Active revision</th>
						<th>Actions</th>
					</thead>

					<tbody>
						<?php foreach($rsrc_bundle->resources as $rsrc): ?>
							<tr>
								<td><?php echo $rsrc->name; ?></td>
								<td><?php echo $rsrc->type->name; ?></td>
								<td>
									<a href="<?php echo url_endpoint('devtools/rsrc/revision', ['rev' => $rsrc->active_revision_id, 'rsrc' => $rsrc->id]); ?>"><?php echo $rsrc->active_revision_id; ?></a>
								</td>
								<td>
									<a href="<?php echo url_endpoint('devtools/rsrc/view', ['rev' => $rsrc->active_revision_id, 'rsrc' => $rsrc->id]); ?>">View</a> |
									<a href="/rsrc.php/<?php echo $rsrc->active_revision_id . '/' . $rsrc->name; ?>">Source</a> |
									<a href="<?php echo url_endpoint('devtools/rsrc/update', ['rev' => $rsrc->active_revision_id, 'rsrc' => $rsrc->id]); ?>">Edit</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	<?php endforeach; ?>
</main>
</div>