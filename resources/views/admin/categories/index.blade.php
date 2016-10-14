@extends('layouts.admin')

@section('scripts')
	<script src="/js/categories.js"></script>
@stop

@section('content')

<section class="panel" id="categories-app">
  <header class="panel-heading">
      <h4><i class="fa fa-cogs"></i> Categories</h4>
  </header>
  <div class="panel-body">
	
		<p>
  			<button class="btn btn-info"><i class="fa fa-plus"></i> Add New Category</button>
		</p>

		<table class="table table-stripped table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Slug</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for="category in categories">
					<td>@{{ category.name }}</td>
					<td>@{{ category.slug }}</td>
					<td>
						<button :click="edit(category)" class="btn btn-sm btn-primary">Edit</button>
						<button :click="delete(category)" class="btn btn-sm btn-danger">Delete</button>
					</td>
				</tr>
			</tbody>
		</table>

  </div>
</section>
	
	

@stop