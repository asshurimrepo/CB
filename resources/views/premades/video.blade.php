@extends('layouts.app')

@section('scripts')
  <script type="text/javascript">
    window.premades = {!! $premades !!};
  </script>
  <script src="/js/premade.js"></script>
@endsection

@section('content')
<div class="col-md-12">
      <div id="premade-app" class="row product-list" style="display: flex; flex-wrap: wrap;">
          <div class="col-md-3 col-sm-6" v-for="premade in premades">
            <section class="panel">
              <!-- Title & Preview Image -->
                  <div class="pro-img-box text-center">
                        <h3>
                            <a href="#" class="pro-title">@{{ premade.title }}</a>
                        </h3>

                        <div class="vid-thumbnail">
                            <img width="240px" :src="'/premades/' + premade.filename + '.png'" :alt="premade.filename">
                        </div>

                        <!-- <a href="#preview" @click="showPreview" class="adtocart"><i class="fa fa-play-circle"></i></a> -->

                  </div>

                  <!-- Actions -->
                  <div class="panel-body text-center">
                      <div class="col-md-12">

                          <br/>

                          <button type="button"
                              class="btn btn-primary btn-sm"
                              @click="showPreview(premade)"
                          >
                              <i class="fa fa-play"></i> Preview
                          </button>

                          <button type="button"
                              class="btn btn-danger btn-sm"
                              @click="addProject(premade.filename)"
                          >
                              <i class="fa fa-plus"></i> Add to Project
                          </button>
                      </div> <!-- /col-md-12 -->
                  </div>
            </section>
          </div>
      </div>
</div>


<!-- preview player -->
<div id="premade-preview-container">
    <div id="premade-section"></div>
</div>

@endsection