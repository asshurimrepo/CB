@extends('layouts.admin')

@section('scripts')
	<script src="{{ elixir('js/members.js') }}"></script>
@stop

@section('content')

<section class="panel" id="members-app">
  <header class="panel-heading">
      <h4><i class="fa fa-users"></i> Members</h4>
  </header>
  <div class="panel-body">
	
		<p>
  			<button class="btn btn-info" @click="addNewMember"><i class="fa fa-plus"></i> Add New Member</button>
		</p>

		<table class="table table-stripped table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for="member in members" track-by="id">
					<td>@{{ member.name }}</td>
					<td>@{{ member.email }}</td>
					<td>
						<button @click="editMember(member)" class="btn btn-sm btn-primary">Edit</button>
						<button @click="deleteMember(member)" class="btn btn-sm btn-danger">Delete</button>
					</td>
				</tr>
			</tbody>
		</table>

  </div>

<add-member></add-member>
<edit-member :member="active"></edit-member>
</section>
@stop