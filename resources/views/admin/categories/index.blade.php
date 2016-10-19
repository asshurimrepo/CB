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
					<th style="width: 200px;"></th>
					<th>Name</th>
					<th>Slug</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for="category in categories">
					<td><img :src="category.featured_img" class="img-responsive"></td>
					<td>@{{ category.name }}</td>
					<td>@{{ category.slug }}</td>
					<td>
						<button @click="editCategory(category)" class="btn btn-sm btn-primary">Edit</button>
						<button @click="deleteCategory(category)" class="btn btn-sm btn-danger">Delete</button>
					</td>
				</tr>
			</tbody>
		</table>

  </div>

<add-category></add-category>
<edit-category :category="active"></edit-category>
</section>
	

@stop