@extends('layouts.app')


@section('content')

	<section id="premade-app">
		<div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Premade Videos
                </header>
                    <div class="panel-body">
                        <ul class="grid cs-style-3">
                          @foreach($categories as $category)

                          <li>
                              <figure style="background: #ebebeb;">
                                  <h2 style="padding:100px 0; text-align: center;">{{ $category->name }}</h2>
                                  <figcaption>
                                      <h3>{{ $category->name }}</h3>
                                      <span>{{ $category->sub_text }}</span>
                                      <a class="fancybox" rel="group" href="premade/{{ $category->id }}">Take a look</a>
                                  </figcaption>
                              </figure>
                            </li>
                        
                          @endforeach
                        </ul>
                    </div>


                <!-- <table class="table table-striped table-advance table-hover">
                    <tbody>
                      <tr v-for="premade in premades">
                        <th>#@{{$index + 1}}</th>
                        <td>
                          <img width="240px" :src="'/premades/' + premade.filename + '.png'" :alt="premade.filename">
                        </td>

                        <td><h4>@{{ premade.title }}</h4></td>
                        <td>
                            <button class="btn btn-primary" @click="showPreview(premade)"><i class="fa fa-play"></i> Preview</button>
                            <button class="btn btn-danger" @click="addProject(premade.filename)"><i class="fa fa-plus "></i> Add to project</button>
                        </td>
                    </tr>
                    </tbody>
                </table> -->
            </section>
        </div>
    </div>
        <!-- <project-player :project="active_project"></project-player> -->
	</section>



@endsection