@extends('layouts.app')

@section('content')
    

<div class="row">
    <div class="col-md-12">
        <div class="row product-list">
                
            <div id="project-1" class="col-md-3">
                    <section class="panel">
                        <div class="pro-img-box text-center">
                          <h3>
                              <a href="#" class="pro-title">
                                  Title
                              </a>
                          </h3>
                                <img src="/img/default.png" />
                            <a href="#" class="adtocart"><i class="fa fa-play-circle"></i></a>
                        </div>
                        <div class="panel-body text-center">
                            <div class="col-md-12">
                                <br/>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"><i class="fa fa-gears"></i> Options</button>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle" type="button"> More <span class="caret"></span></button>
                                    <ul role="menu" class="dropdown-menu">
                                      <li><a href="#" data-toggle="modal"><span class="text-primary"><i class="fa fa-share-square-o"></i> Action </a></span></li>
                                      <li><a href="#"><span class="text-danger"><i class="fa fa-trash-o"></i> Delete </a></span></li>
                                      <li class="divider"></li>
                                      <li><a href="#"><span class="text-warning"><i class="fa fa-link"></i> Embed </a></span></li>
                                    </ul>
                                </div><!-- /btn-group -->
                            </div> <!-- /col-md-12 -->
                        </div>
                    </section>
                </div>

        </div>
    </div>
</div>


@endsection
