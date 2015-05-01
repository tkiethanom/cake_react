<div class="container">
	<div class="actions">
		<p class="text-right">
			<a href="/admin/<?php echo $this->params['controller'] ?>/add" class="btn btn-default">
				<i class="fa fa-plus"></i> Add
			</a>
		</p>
	</div>
	<div class="index-table">
		<table class="table table-striped table-bordered table-responsive">
			<thead>
				<tr>
					<th>ID</th>
					<th>Email</th>
					<th>Active</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($data as $row): ?>
					<tr>
						<td><?php echo $row[$model]['id'] ?></td>
						<td><?php echo $row[$model]['email'] ?></td>
						<td>
							<?php echo (!empty($row[$model]['active']))? 'True' : 'False' ?>
						</td>
						<td>
							<a class="btn" href="/admin/<?php echo $this->params['controller'] ?>/edit/<?php echo $row[$model]['id'] ?>" >
								Edit <i class="fa fa-edit"></i>
							</a>
							<a class="btn" href="/admin/<?php echo $this->params['controller'] ?>/delete/<?php echo $row[$model]['id'] ?>" >
								Delete <i class="fa fa-trash"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>