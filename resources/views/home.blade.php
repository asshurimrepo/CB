@extends('layouts.app')

@section('content')
    
<div class="row">
    <div class="col-md-12">
      <div class="row product-list">

        <pre>@{{ active_project | json }}</pre>
                      
            <project v-for="project in projects" 
                     :data="project"
            >        
            </project>

      </div>
    </div>
</div>


@endsection
