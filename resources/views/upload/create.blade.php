@extends('layouts.app')

@section('styles')
    {{-- Dropzone --}}
    <link href="/assets/dropzone/css/dropzone.css" rel="stylesheet"/>
@stop

@section('content')
  <section class="container" id="upload-section">

    <form action="/upload" method="POST" class="row" id="fileupload">  
        <section class="panel col-md-12 ">
            
            <div class="panel-body" v-if="in_progress">
              <h3 class="upload-header">@{{ process_text }}</h3>

              <div class="progress progress-striped active" v-if="step == 1">
                    <div class="progress-bar progress-bar-success" role="progressbar" :style="{width: progress + '%'}"></div>
              </div>

              <div class="progress progress-striped active" v-if="step == 2">
                    <div class="progress-bar progress-bar-primary" role="progressbar" :style="{width: progress + '%'}"></div>
              </div>
              
              <h4 class="funnies" style="text-align:center; font-style: italic; font-weight: 600">
                "@{{ funnies }}"
              </h4>

            </div>

            <div class="panel-body upload-body" v-if="!in_progress">
                    <input type="file" name="file" style="display:none;">

                    <button class="btn btn-upload" type="button">
                        <i class="fa fa-cloud-upload"></i>
                    </button>
                    <h3>
                      Select file to upload <br>
                      <small>Or Select from premade videos</small>
                    </h3>
            </div>
        </section>


    </form>
  </section>
@stop

@section('scripts')
  <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
  <script src="/js/blueimp/jquery.ui.widget.js"></script>
  <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
  <script src="/js/blueimp/jquery.iframe-transport.js"></script>
  <!-- The basic File Upload plugin -->
  <script src="/js/blueimp/jquery.fileupload.js"></script>

  <script src="/js/upload.js"></script>
@stop