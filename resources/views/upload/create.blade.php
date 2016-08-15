@extends('layouts.app')

@section('styles')
    {{-- Dropzone --}}
    <link href="/assets/dropzone/css/dropzone.css" rel="stylesheet"/>
@stop

@section('content')
      
      <section id="fileupload"></section>

@stop

@section('scripts')
  <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
  <script src="/js/blueimp/vendor/jquery.ui.widget.js"></script>
  <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
  <script src="/js/blueimp/jquery.iframe-transport.js"></script>
  <!-- The basic File Upload plugin -->
  <script src="/js/blueimp/jquery.fileupload.js"></script>

<script>
  $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        }
    });
</script>
@stop