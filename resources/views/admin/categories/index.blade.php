@extends('layouts.admin')

@section('scripts')
	<script src="{{ elixir('js/categories.js') }}"></script>
@stop

@section('content')

<section class="panel" id="categories-app">
  <header class="panel-heading">
      <h4><i class="fa fa-th-large"></i> Categories</h4>
  </header>
  <div class="panel-body">
	
		<p>
  			<button class="btn btn-info" @click="addNewCategory"><i class="fa fa-plus"></i> Add New Category</button>
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
				<tr v-for="cat in categories">
					<td>@{{ cat.name }}</td>
					<td>@{{ cat.slug }}</td>
					<td>
						<button @click="editCategory(cat)" class="btn btn-sm btn-primary">Edit</button>
						<button @click="deleteCategory(cat)" class="btn btn-sm btn-danger">Delete</button>
					</td>
				</tr>
			</tbody>
		</table>

  </div>

<add-category></add-category>
<edit-category :category="active"></edit-category>
</section>
	

@stop