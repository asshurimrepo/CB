@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
	
	  {{-- <video>
	  	 <source src="/video/OTeXAf2OqmShort.mp4" type="video/mp4">
	  </video> --}}

      <div class="row product-list">

            <project v-for="project in projects"
                     :data="project"
            >
            </project>

      </div>
    </div>
</div>


<project-options :project="active_project"></project-options>
<project-actions :project="active_project"></project-actions>
@endsection
