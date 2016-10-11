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
                            <li>
                              <figure>
                                  <img src="img/gallery/4.jpg" alt="img04">
                                  <figcaption>
                                      <h3>Special Offer</h3>
                                      <span>Button Click </span>
                                      <a class="fancybox" rel="group" href="premade/1">Take a look</a>
                                  </figcaption>
                              </figure>
                            </li>
                            <li>
                              <figure>
                                  <img src="img/gallery/4.jpg" alt="img04">
                                  <figcaption>
                                      <h3>Instant Access</h3>
                                      <span>Button Click </span>
                                      <a class="fancybox" rel="group" href="premade/2">Take a look</a>
                                  </figcaption>
                              </figure>
                            </li>
                            <li>
                              <figure>
                                  <img src="img/gallery/4.jpg" alt="img04">
                                  <figcaption>
                                      <h3>Latest Tips</h3>
                                      <span>Email Optin </span>
                                      <a class="fancybox" rel="group" href="premade/3">Take a look</a>
                                  </figcaption>
                              </figure>
                            </li>
                            <li>
                              <figure>
                                  <img src="img/gallery/4.jpg" alt="img04">
                                  <figcaption>
                                      <h3>Free Products</h3>
                                      <span>Email Optin </span>
                                      <a class="fancybox" rel="group" href="premade/4">Take a look</a>
                                  </figcaption>
                              </figure>
                            </li>
                            <li>
                              <figure>
                                  <img src="img/gallery/4.jpg" alt="img04">
                                  <figcaption>
                                      <h3>Instant Access</h3>
                                      <span>Email Optin </span>
                                      <a class="fancybox" rel="group" href="premade/5">Take a look</a>
                                  </figcaption>
                              </figure>
                            </li>                                                                                    
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