@extends('layouts.app')

@section('styles')
    {{-- Dropzone --}}
    <link href="/assets/dropzone/css/dropzone.css" rel="stylesheet"/>
@stop

@section('scripts')
	{{-- Dropzone --}}
    <script src="/assets/dropzone/dropzone.js"></script>
@stop

@section('content')
	
	<section class="panel">
      <header class="panel-heading">
          Start Uploading Your Project
      </header>
      <div class="panel-body">
          <form action="/upload" class="dropzone" id="project-dropzone"></form>
      </div>
  	</section>

@stop