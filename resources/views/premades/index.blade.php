@extends('layouts.app')

@section('scripts')
	<script src="/js/premade.js"></script>
@stop

@section('content')
	
	<section id="premade-app">
		<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Premade Videos
                          </header>
                          <table class="table table-striped table-advance table-hover">
                              <tbody>
                                <tr v-for="premade in premades">
                                  <td>
                                    <img width="240px" :src="'/premades/' + premade.filename + '.png'" :alt="premade.filename">
                                  </td>
                                  <td class="hidden-phone">@{{ premade.title }}</td>
                                  <td>
                                      
                                      <button class="btn btn-danger"><i class="fa fa-plus "></i> Add to project</button>
                                  </td>
                              </tr>
                              </tbody>
                          </table>
                      </section>
                  </div>
              </div>
	</section>

@stop