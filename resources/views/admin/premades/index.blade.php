@extends('layouts.admin')

@section('scripts')
    {{-- Video Caster Core Scripts --}}
    <link rel="stylesheet" href="https://jmblog.github.io/color-themes-for-google-code-prettify/themes/github.min.css">
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script src="/admin/main.js"></script>
@endsection

@section('content')

<div class="col-lg-12">
	<section class="panel">
	  <header class="panel-heading">
	      <h4><i class="fa fa-video-camera"></i> Premade Videos</h4>
	  </header>
	  <div class="panel-body" style="background: #eff1f7;">
	  	<div class="row">
				<div class="col-md-12">
				  <div class="row product-list" style="display: flex; flex-wrap: wrap;">
				        <project v-for="project in projects"
				                 :data="project"
				        >
				        </project>
				  </div>
				</div>
			</div>
	  </div>
	</section>
</div>



<project-options :project="active_project"></project-options>
<project-actions :project="active_project"></project-actions>
<project-embed :project="active_project">{{ url('/') }}</project-embed>
<project-player :project="active_project"></project-player>
		

@endsection
