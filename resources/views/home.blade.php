@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">

      <div class="row product-list">
            <project-player :project="active_project"></project-player>

            <project v-for="project in projects"
                     :data="project"
            >
            </project>

      </div>
    </div>
</div>


<project-options :project="active_project"></project-options>
<project-actions :project="active_project"></project-actions>
<project-player :project="active_project"></project-player>
@endsection
