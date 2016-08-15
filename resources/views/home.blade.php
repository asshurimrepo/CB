@extends('layouts.app')

@section('scripts')
    {{-- Video Caster Core Scripts --}}
    <script src="{{ elixir('js/main.js') }}"></script>
@endsection

@section('content')

<div class="loader-2"></div>

<section class="error-wrapper timeout-wrapper" v-if="isTimeout">
      <h1>Oops!</h1><br/>
      <h2>Something went wrong. <a href="#" @click="loadProjects">Retry</a></h2>
</section>


<section class="error-wrapper empty-wrapper" v-if="projects.length < 1">
      <img src="/img/empty.png" class="empty-img" alt="Caster Buddy No Videos">
      <h3>I have no videos, rendering me worthless.</h3>
      <h4 class="page-505">Now I am sad. <a href="/upload">Fix Me!</a></h4>
 </section>

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
<project-embed :project="active_project"></project-embed>
<project-player :project="active_project"></project-player>
@endsection
