<style type="text/css">
	ul.nav-tabs>li.active> a[data-toggle='tab']
	,ul.nav-tabs>li> a[data-toggle='tab']:hover{
		color: #47596f;
    	background: #fff;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="row product-list">
			<?php
				$q="SELECT * FROM projects WHERE UserId=".$user_id." ORDER BY id";
				$prjs=mysqli_query($conn, $q);
				
				while($prj=mysqli_fetch_assoc($prjs)) {
					$basename=substr($prj['FileName'], 0, strpos($prj['FileName'], "."));
			?>
				<div id="tr<?php echo $prj['id']; ?>" class="col-md-3">
					<section class="panel">
						<div class="pro-img-box text-center">
						  <h4>
                              <a href="#" class="pro-title">
                                  <?php echo $prj['Title']; ?>
                              </a>
                          </h4>
							<?php if (file_exists('data/'.$user.'/done/'.$prj['uid'].'.png')){ ?>
								<img src="data/<?php echo $user; ?>/done/<?php echo $prj['uid']; ?>.png" alt="<?php echo $prj['uid']; ?>"/>
							<?php }else{ ?>
								<img src="images/default.png" alt="<?php echo $prj['uid']; ?>"/>
							<?php } ?>
							<a href="#" class="adtocart"><i class="fa fa-play-circle"></i></a>
							<script type="text/javascript">
								$(document).ready(function(){
								 	var videoid = '<?php echo $prj['uid']; ?>';
								 	var videoWidth = '<?php echo $prj['Width']; ?>';
								 	var videoHeight = '<?php echo $prj['Height']; ?>';
								 	$('body').on('click','.adtocart',function(){
								 		viewVideo('"'+videoid+'"', videoWidth, videoHeight);
								 	});
								});
							</script>
						</div>
						<div class="panel-body text-center">
							<div class="col-md-12">
								<br/>
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#optionModal<?php echo $prj['id']; ?>"><i class="fa fa-gears"></i> Options</button>
		                        <div class="btn-group">
		                            <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle" type="button"> More <span class="caret"></span></button>
		                            <ul role="menu" class="dropdown-menu">
	                                  <li><a href="#" data-toggle="modal" data-target="#actionModal<?php echo $prj['id']; ?>"><span class="text-primary"><i class="fa fa-share-square-o"></i> Action </a></span></li>
	                                  <li><a href="#"><span class="text-danger"><i class="fa fa-trash-o"></i> Delete </a></span></li>
	                                  <li class="divider"></li>
	                                  <li><a href="#"><span class="text-warning"><i class="fa fa-link"></i> Embed </a></span></li>
		                            </ul>
		                        </div><!-- /btn-group -->
							</div> <!-- /col-md-12 --> 
                        </div>
					</section>
				</div>
		      <!-- Options Modal -->
              <div class="modal fade" id="optionModal<?php echo $prj['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header text-center">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title"><i class="fa fa-gears"></i>  Options</h4>
                          </div>
                          <div class="modal-body">
                          	<div class="row">
                          		<div class="col-md-12">
                              			<section class="panel">
                                  			<ul class="nav nav-tabs options-tab">
											  <li class="active"><a data-toggle="tab" href="#home<?php echo $prj['id']; ?>"><i class="fa fa-pencil-square-o"></i> Properties</a></li>
											  <li><a data-toggle="tab" href="#iframe<?php echo $prj['id']; ?>"><i class="fa fa-code"></i> IFrame</a></li>
											  <li><a data-toggle="tab" href="#externalvideo<?php echo $prj['id']; ?>"><i class="fa fa-video-camera"></i> External Video</a></li>
											</ul>
                              			</section>
                              		<div class="tab-content">
                              			<div id="home<?php echo $prj['id']; ?>" class="tab-pane fade in active">	
                                          	<section class="panel">
                                          		<form class="form-horizontal tasi-form text-left">
													<div class="form-group">
														<div class="col-lg-12 col-md-12">
														  <label for="title" class="control-label"><strong>Title: </strong></label>
														  	<input type="text" class="form-control m-bot15" id="propertyTitle" value="<?php echo $prj['Title']; ?>" placeholder="Enter Title">
														</div>
													</div> <!-- 1st form-group -->
													<div class="form-group">
														<div class="col-lg-12 col-md-12">
															<label for="active" class="control-label"><strong>Active: </strong></label><select id='propertyActive' class="form-control m-bot15">
																<option <?php if ($prj['Active'] == 0){ ?> selected <?php } ?> value=0>Plan Free</option>
																<option <?php if ($prj['Active'] == 1){ ?> selected <?php } ?> value=1>Plan Paid</option>
				                                          	</select>
			                                          	</div>						
													</div> <!-- 2nd form-group -->
													<div class="form-group">
														<div class="col-lg-4 col-sm-4">
															<label for="position" class="control-label"><strong>Position: </strong></label>
				                                          	<select id='propertyPosition' class="form-control m-bot15">
																<option <?php if ($prj['Position'] == 0){ ?> selected <?php } ?> value=0>Centered</option>
																<option <?php if ($prj['Position'] == 1){ ?> selected <?php } ?> value=1>Top left</option>
																<option <?php if ($prj['Position'] == 2){ ?> selected <?php } ?> value=2>Top right</option>
																<option <?php if ($prj['Position'] == 3){ ?> selected <?php } ?> value=3>Bottom left</option>
																<option <?php if ($prj['Position'] == 4){ ?> selected <?php } ?> value=4>Bottom right</option>
					                                        </select>
			                                          	</div>
			                                          	<div class="col-lg-4 col-sm-4">
															<label for="offsetx" class="control-label"><strong>Offset X: </strong></label>
															<div class="spinner">
				                                                <div class="input-group input-small">
				                                                      <input type="text" id='propertyOffsetX' class="spinner-input form-control" value="<?php echo $prj['OffsetX']; ?>" placeholder="0">
				                                                      	<div class="spinner-buttons input-group-btn btn-group-vertical">
				                                                          <button type="button" class="btn spinner-up btn-xs btn-default">
				                                                              <i class="fa fa-angle-up"></i>
				                                                          </button>
				                                                          <button type="button" class="btn spinner-down btn-xs btn-default">
				                                                              <i class="fa fa-angle-down"></i>
				                                                          </button>
					                                                    </div>
					                                            </div>
					                                        </div>
					                                    </div>
				                                        <div class="col-lg-4 col-sm-4">
															<label for="offsety" class="control-label"><strong>Offset Y: </strong></label>
																<div class="spinner">
				                                                  <div class="input-group input-small">
				                                                      <input type="text" id='propertyOffsetY' class="spinner-input form-control" value="<?php echo $prj['OffsetY']; ?>" placeholder="0">
				                                                      	<div class="spinner-buttons input-group-btn btn-group-vertical">
				                                                          <button type="button" class="btn spinner-up btn-xs btn-default">
				                                                              <i class="fa fa-angle-up"></i>
				                                                          </button>
				                                                          <button type="button" class="btn spinner-down btn-xs btn-default">
				                                                              <i class="fa fa-angle-down"></i>
				                                                          </button>
					                                                    </div>
					                                                </div>
					                                            </div>
														 </div>
			                                        </div> <!-- 3rd form-group -->
			                                        <div class="form-group">
														<div class="col-lg-4 col-sm-4">
															<label for="automatically" class="control-label">
						                                      	  <strong> Display Automatically: </strong>
						                                    </label>
						                                      <div class="row m-bot15">
						                                          <div class="col-sm-6 text-center">
						                                          	<div class="switch" 
						                                          		 data-on-label="<i class=' fa fa-check'></i>"
                                   										 data-off-label="<i class='fa fa-times'></i>">
						                                              <input type="checkbox" id='propertyDisplayAutomatically' <?php if ($prj['DisplayAutomatically'] == 1){ ?> checked <?php } ?> />
						                                            </div>
						                                          </div>
						                                      </div>
			                                        	</div>
			                                        	<div class="col-lg-8 col-sm-8">
				                                        	<div class="aftersec">
						                                      	<label for="afterseconds" class="control-label">
						                                      	  <strong> After (Seconds): </strong>
						                                      	</label>		                          		
																<div class="spinner">
					                                                <div class="input-group input-small">
					                                                      <input type="text" id='propertyDisplayAfter' class="spinner-input form-control" value="<?php echo $prj['DisplayAfter']; ?>" placeholder="0">
					                                                      	<div class="spinner-buttons input-group-btn btn-group-vertical">
					                                                          <button type="button" class="btn spinner-up btn-xs btn-default">
					                                                              <i class="fa fa-angle-up"></i>
					                                                          </button>
					                                                          <button type="button" class="btn spinner-down btn-xs btn-default">
					                                                              <i class="fa fa-angle-down"></i>
					                                                          </button>
						                                                    </div>
						                                            </div>
						                                        </div>
															</div>
			                                        	</div>
			                                        </div> <!-- 4th form-group -->
			                                        <div class="form-group">
			                                        	<div class="col-lg-12 col-sm-12 row">
															<label for="dimmed" class="control-label col-md-4 col-sm-4">
						                                      	  <strong> Dimmed Background: </strong>
						                                    </label>
						                                      <div class="row m-bot15 col-md-6 col-sm-6">
						                                          <div class="col-sm-6 text-center">
						                                          	<div class="switch" 
						                                          		 data-on-label="<i class=' fa fa-check'></i>"
                                   										 data-off-label="<i class='fa fa-times'></i>">
						                                              <input type="checkbox" id='propertyDimmedBG' <?php if ($prj['DimmedBG'] == 1){ ?> checked <?php } ?> />
						                                            </div>
						                                          </div>
						                                      </div>
			                                        	</div>
			                                        	<div class="col-lg-12 col-sm-12 row">
															<label for="glass" class="control-label col-md-4 col-sm-4">
						                                      	  <strong> Glass Background: </strong>
						                                    </label>
						                                      <div class="row m-bot15 col-md-6 col-sm-6">
						                                          <div class="col-sm-6 text-center">
						                                          	<div class="switch" 
						                                          		 data-on-label="<i class=' fa fa-check'></i>"
                                   										 data-off-label="<i class='fa fa-times'></i>">
						                                              <input type="checkbox" id='propertyGlass' <?php if ($prj['GlassBG'] == 1){ ?> checked <?php } ?> />
						                                            </div>
						                                          </div>
						                                      </div>
			                                        	</div>
			                                        </div>
			                                       	<div class="form-group">
			                                        	<div class="col-lg-12 col-sm-12 row">
			                                        		<label for="stopshowing" class="control-label col-md-4 col-sm-4"> 
			                                        			Stop Showing When: 
			                                        		</label>
			                                        	</div>
			                                        	<div class="col-lg-12 col-sm-12 row">
															<label for="exitonend" class="control-label col-md-4 col-sm-4">
						                                      	  <strong> Clicked: </strong>
						                                    </label>
						                                      <div class="row m-bot15 col-md-6 col-sm-6">
						                                          <div class="col-sm-6 text-center">
						                                          	<div class="switch" 
						                                          		 data-on-label="<i class=' fa fa-check'></i>"
                                   										 data-off-label="<i class='fa fa-times'></i>">
						                                              <input type="checkbox" id='propertyClicked' <?php if ($prj['StopShowingWhen'] == 0){ ?> checked <?php } ?> />
						                                            </div>
						                                          </div>
						                                      </div>
			                                        	</div>
			                                        	<div class="col-lg-12 col-sm-12 row">
															<label for="exitonend" class="control-label col-md-4 col-sm-4">
						                                      	  <strong> Closed: </strong>
						                                    </label>
						                                      <div class="row m-bot15 col-md-6 col-sm-6">
						                                          <div class="col-sm-6 text-center">
						                                          	<div class="switch" 
						                                          		 data-on-label="<i class=' fa fa-check'></i>"
                                   										 data-off-label="<i class='fa fa-times'></i>">
						                                              <input type="checkbox" id='propertyClosed' <?php if ($prj['StopShowingWhen'] == 1){ ?> checked <?php } ?> />
						                                            </div>
						                                          </div>
						                                      </div>
			                                        	</div>
			                                        	<div class="col-lg-12 col-sm-12 row">
															<label for="exitonend" class="control-label col-md-4 col-sm-4">
						                                      	  <strong> Exit On End: </strong>
						                                    </label>
						                                      <div class="row m-bot15 col-md-6 col-sm-6">
						                                          <div class="col-sm-6 text-center">
						                                          	<div class="switch" 
						                                          		 data-on-label="<i class=' fa fa-check'></i>"
                                   										 data-off-label="<i class='fa fa-times'></i>">
						                                              <input type="checkbox" id='propertyExitOnEnd' <?php if ($prj['ExitOnEnd'] == 1){ ?> checked <?php } ?> />
						                                            </div>
						                                          </div>
						                                      </div>
			                                        	</div>
			                                        </div> <!-- 6th form-group -->
			                                        <div class="form-group">
			                                        	<div class="col-lg-8 col-md-8">
														  <label for="cookielife" class="control-label"><strong>Cookie Life: </strong></label>
															<div class="spinner">
				                                                <div class="input-group input-small">
				                                                      <input type="text" id='propertyCookieLife' class="spinner-input form-control" value="<?php echo $prj['CookieLife']; ?>" placeholder="0">
				                                                      	<div class="spinner-buttons input-group-btn btn-group-vertical">
				                                                          <button type="button" class="btn spinner-up btn-xs btn-default">
				                                                              <i class="fa fa-angle-up"></i>
				                                                          </button>
				                                                          <button type="button" class="btn spinner-down btn-xs btn-default">
				                                                              <i class="fa fa-angle-down"></i>
				                                                          </button>
					                                                    </div>
					                                            </div>
					                                        </div>  	
														</div>
													</div> <!-- 6th form-group -->
                                          		</form>
                                          	</section>
                                      	</div>
                                      	<div id="iframe<?php echo $prj['id']; ?>" class="tab-pane fade">
                                          	<section class="panel">
												<form class="form-horizontal tasi-form text-left">
													<div class="form-group">
														<div class="col-lg-12 col-md-12">
														  <label for="iframeurl" class="control-label"><strong>URL: </strong></label>
														  	<input type="text" class="form-control m-bot15" id="IframeURL" value="<?php echo $prj['Url']; ?>">
														</div>
													</div> <!-- 1st form-group -->
												</form>
                                          	</section>
                                        </div>
                                        <div id="externalvideo<?php echo $prj['id']; ?>" class="tab-pane fade">
                                          	<section class="panel">
												<form class="form-horizontal tasi-form text-left">
													<div class="form-group">
														<div class="col-lg-4 col-md-4">
														  <label for="duration" class="control-label"><strong>Duration: </strong></label>
															<div class="input-group input-small">
			                                                    <input type="text" id='propertyExtVideoDuration' class="spinner-input form-control"  placeholder="0">
		                                                      	<div class="spinner-buttons input-group-btn btn-group-vertical">
		                                                          <button type="button" class="btn spinner-up btn-xs btn-default">
		                                                              <i class="fa fa-angle-up"></i>
		                                                          </button>
		                                                          <button type="button" class="btn spinner-down btn-xs btn-default">
		                                                              <i class="fa fa-angle-down"></i>
		                                                          </button>
			                                                    </div>
				                                            </div>														
														</div>													
														<div class="col-lg-8 col-md-8">
														  <label for="embed" class="control-label"><strong>Embed Code: </strong></label>
														  	<input type="text" class="form-control m-bot15" id="propertyExtVideoURL" >
														</div>
													</div> <!-- 2nd form-group -->																			
												</form>
                                          	</section>
                                      	</div>
                                    </div>  						                                          		
								</div>
							</div>
                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-times"></i> Close</button>
                              <button class="btn btn-primary" type="button"><i class="fa fa-save"></i> Save</button>
                          </div>
                      </div>
                  </div>
              </div>
            <!-- Options modal -->
		      <!-- Action Modal -->
              <div class="modal fade text-center" id="actionModal<?php echo $prj['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title"><i class="fa fa-share-square-o"></i>  Actions</h4>
                          </div>
	                      <div class="modal-body">
	                      	<div class="row">
	                      		<div class="col-md-12">
                      			    <section class="panel">                     			    	
                              			<ul class="nav nav-tabs actions-tab">
										  <li class="active"><a data-toggle="tab" href="#linkurl<?php echo $prj['id']; ?>"><i class="fa fa-link"></i> Link URL &amp; Text Overlay</a></li>
										  <li><a data-toggle="tab" href="#clicktocall<?php echo $prj['id']; ?>"><i class="fa fa-hand-o-up"></i> Click to Call</a></li>
										  <li><a data-toggle="tab" href="#formoverlay<?php echo $prj['id']; ?>"><i class="fa fa-file-text"></i> Form &amp; Button Overlay</a></li>
										</ul>	
                          			</section>
									<div class="tab-content">
                              			<div id="linkurl<?php echo $prj['id']; ?>" class="tab-pane fade in active">
                                          	<section class="panel">
                                          		<form class="form-horizontal tasi-form text-left">
                                          			<div class="form-group">
														<div class="col-lg-12 col-md-12">
														  <label for="linkurl" class="control-label"><strong> Link URL: </strong></label>
														  	<input type="text" class="form-control m-bot15" id="linkURL" >
														</div>
													</div> <!-- 1st form-group -->
                                          			<div class="form-group">
														<div class="col-lg-12 col-md-12">
														  <label for="textpverlay" class="control-label"> Text Overlay: </label>
														</div>
														<div class="col-lg-12 col-sm-12 row">
															<label for="line1" class="control-label col-md-3 col-sm-3">
						                                      	  <strong> Line1: </strong>
						                                    </label>
						                                    <div class="row m-bot15 col-md-9 col-sm-9">
						                                    	<input type="text" class="form-control m-bot15" id="textLine1" >
						                                    </div>
						                                </div>
														<div class="col-lg-12 col-sm-12 row">
															<label for="line2" class="control-label col-md-3 col-sm-3">
						                                      	  <strong> Line2: </strong>
						                                    </label>
						                                    <div class="row m-bot15 col-md-9 col-sm-9">
						                                    	<input type="text" class="form-control m-bot15" id="textLine2" >
						                                    </div>
						                                </div>	
						                                <div class="col-lg-12 col-sm-12 row">
															<label for="valignment" class="control-label col-md-3 col-sm-3">
						                                      	   <strong> Vertical Alignment: </strong>
						                                    </label>
						                                    <div class="row m-bot15 col-md-3 col-sm-3">
					                                          	<select id='textPosition' class="form-control m-bot15">
																	<option <?php if ($prj['Position'] == 0){ ?> selected <?php } ?> value=0>Bottom</option>
																	<option <?php if ($prj['Position'] == 1){ ?> selected <?php } ?> value=1>Middle</option>
																	<option <?php if ($prj['Position'] == 2){ ?> selected <?php } ?> value=2>Top</option>
																</select>						                                    
						                                    </div>
						                                </div>
						                                <div class="col-lg-12 col-sm-12 row">
						                                   <label for="starttime" class="control-label col-md-3 col-sm-3">
						                                      	   <strong> Start Time: </strong>
						                                    </label>
						                                    <div class="row m-bot15 col-md-3 col-sm-3">
																<div class="spinner">
				                                                  <div class="input-group input-small">
				                                                      <input type="text" id='textShowSec' class="spinner-input form-control" value="0">
				                                                      	<div class="spinner-buttons input-group-btn btn-group-vertical">
				                                                          <button type="button" class="btn spinner-up btn-xs btn-default">
				                                                              <i class="fa fa-angle-up"></i>
				                                                          </button>
				                                                          <button type="button" class="btn spinner-down btn-xs btn-default">
				                                                              <i class="fa fa-angle-down"></i>
				                                                          </button>
					                                                    </div>
					                                                </div>
					                                            </div>		
						                                    </div>
															<label for="textduration" class="control-label col-md-3 col-sm-3">
						                                      	   <strong> Duration: </strong>
						                                    </label>
						                                    <div class="row m-bot15 col-md-3 col-sm-3">
																<div class="spinner">
				                                                  <div class="input-group input-small">
				                                                      <input type="text" id='textShowDuration' class="spinner-input form-control" value="0">
				                                                      	<div class="spinner-buttons input-group-btn btn-group-vertical">
				                                                          <button type="button" class="btn spinner-up btn-xs btn-default">
				                                                              <i class="fa fa-angle-up"></i>
				                                                          </button>
				                                                          <button type="button" class="btn spinner-down btn-xs btn-default">
				                                                              <i class="fa fa-angle-down"></i>
				                                                          </button>
					                                                    </div>
					                                              </div>
					                                            </div>		
						                                    </div>						                                    
						                                </div> <!-- end of col-lg-12 -->
													</div> <!-- 2nd form-group -->
													<div class="form-group">
														<div class="col-lg-12 col-md-12">
															<div class="panel-group" id="accordion">
									                          <div class="panel panel-success">
									                              <div class="panel-heading">
									                                  <h4 class="panel-title">
									                                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $prj['id']; ?>">
									                                          <i class="fa fa-pencil"></i>  Advance <i class="fa fa-caret-down pull-right"></i></span>
									                                      </a>
									                                  </h4>
									                              </div>
									                              <div id="collapse<?php echo $prj['id']; ?>" class="panel-collapse collapse in">
									                                <div class="panel-body">
									                                	<div class="form-group">				                            	
								                                  			<div class="well">
								                                  				<p> The quick brown fox...</p>
								                                  			</div>
							                                  			</div>
							                                  			<div class="form-group">
																			<label for="fontstyle" class="control-label col-md-3 col-sm-3 row">
										                                      	   <strong> Font Style: </strong>
										                                    </label>
										                                    <div class="row m-bot15 col-md-4 col-sm-4">
									                                          	<select id='textFontProperty' class="form-control m-bot15">
																					<option value="Helvetica">Arial</option>
																					<option value="Arial Black">Arial Black</option>
																					<option value="Comic Sans MS">Comic Sans MS</option>
																					<option value="Impact">Impact</option>
																					<option value="Lucida">Lucida</option>
																					<option value="Tahoma">Tahoma</option>
																					<option value="Verdana">Verdana</option>
																					<option value="Georgia">Georgia</option>
																					<option value="Times New Roman">Times New Roman</option>
																					<option value="Courier New">Courier New</option>
																					<option value="Lucida Console">Lucida Console</option>
																				</select>	                               	
																			</div>
																			<label for="fontsize" class="control-label col-md-3 col-sm-3">
						                                      	   				<strong> Font Size: </strong>
						                                    				</label>
										                                    <div class="row m-bot15 col-md-3 col-sm-3">
																				<div id="fontsize" class="spinner">
								                                                  <div class="input-group input-small">
								                                                      <input type="text" id='textShowDuration' class="spinner-input form-control" value="10">
								                                                      	<div class="spinner-buttons input-group-btn btn-group-vertical">
								                                                          <button type="button" class="btn spinner-up btn-xs btn-default">
								                                                              <i class="fa fa-angle-up"></i>
								                                                          </button>
								                                                          <button type="button" class="btn spinner-down btn-xs btn-default">
								                                                              <i class="fa fa-angle-down"></i>
								                                                          </button>
									                                                    </div>
									                                              </div>
									                                            </div>		
										                                    </div>				
										                                </div>
										                                <div class="form-group">
																			<label for="boldtext" class="control-label col-md-2 col-sm-2 row">
										                                      	  <strong> Bold: </strong>
										                                    </label>
										                                    <div class="row m-bot15 col-md-4 col-sm-4">
										                                        <div class="col-sm-6 text-center">
										                                          	<div class="switch" 
										                                          		 data-on-label="<i class=' fa fa-check'></i>"
				                                   										 data-off-label="<i class='fa fa-times'></i>">
										                                              <input type="checkbox" id='textWeightProperty' />
										                                            </div>
										                                        </div>
										                                    </div>
																			<label for="italictext" class="control-label col-md-2 col-sm-2 row">
										                                      	  <strong> Italic: </strong>
										                                    </label>
										                                    <div class="row m-bot15 col-md-4 col-sm-4">
										                                        <div class="col-sm-6 text-center">
										                                          	<div class="switch" 
										                                          		 data-on-label="<i class=' fa fa-check'></i>"
				                                   										 data-off-label="<i class='fa fa-times'></i>">
										                                              <input type="checkbox" id='textStyleProperty' />
										                                            </div>
										                                        </div>
										                                    </div>											                 	
										                                </div>
										                                <div class="form-group">
																			<label for="textalignment" class="control-label col-md-3 col-sm-3 row">
										                                      	  <strong> Alignment: </strong>
										                                    </label>
										                                    <div class="row col-md-3 col-sm-3">
									                                          	<select id='textFontProperty' class="form-control m-bot15">
																					<option value="left">Left</option>
																					<option value="center">Center</option>
																					<option value="right">Right</option>
																				</select>	                               	
																			</div>
																		</div>
																		<div class="form-group">
																			<label for="textpverlay" class="m-bot15 control-label col-md-6 col-sm-6 row"><strong> Text Color: </strong></label>				
										                                    <label for="rgba" class="control-label col-md-2 col-sm-2 row">
										                                    	  RGB 
										                                    </label>
										                                   <div class="row m-bot15 col-md-4 col-sm-4">
										                                        <input type="text" class="colorpicker-rgba form-control" value="rgb(0,0,0)" data-color-format="rgb" />
										                                    </div>                               
										                               	</div>
										                               	<div class="form-group">
																			<label for="textpverlay" class="m-bot15 control-label col-md-6 col-sm-6 row"><strong> Background Color: </strong></label>				
										                                    <label for="rgba" class="control-label col-md-2 col-sm-2 row">
										                                    	  RGBA 
										                                    </label>
										                                   <div class="row m-bot15 col-md-4 col-sm-4">
										                                        <input type="text" class="colorpicker-rgba form-control" value="rgba(0,0,0,0)" data-color-format="rgba" />
										                                    </div>                               
										                                </div>												
									                                </div><!--  end of panel-body -->
									                              </div>
									                          </div>
									                        </div>
								                        </div>													
													</div> <!-- 3rd form-group -->
                                          		</form>
                                          	</section>	                              			
                              			</div> <!-- end of linkurl -->
                              			<div id="clicktocall<?php echo $prj['id']; ?>" class="tab-pane fade">
                                          	<section class="panel">
                                          		<form class="form-horizontal tasi-form text-left">
                                          			<div class="form-group">
														<div class="col-lg-12 col-md-12">
														  <label for="phonenumber" class="control-label"><strong> Phone Number: </strong></label>
														  <input type="text" class="form-control m-bot15" id="phoneNumber" >
														</div>
														<div class="col-lg-12 col-sm-12 row">
															<label for="valignment" class="control-label col-md-3 col-sm-3">
						                                      	   <strong> Vertical Alignment: </strong>
						                                    </label>
						                                    <div class="row m-bot15 col-md-3 col-sm-3">
					                                          	<select id='phonePosition' class="form-control m-bot15">
																	<option <?php if ($prj['Position'] == 0){ ?> selected <?php } ?> value=0>Bottom</option>
																	<option <?php if ($prj['Position'] == 1){ ?> selected <?php } ?> value=1>Middle</option>
																	<option <?php if ($prj['Position'] == 2){ ?> selected <?php } ?> value=2>Top</option>
																</select>						                                    
						                                    </div>
						                                </div>
						                                <div class="col-lg-12 col-sm-12 row">
															<label for="phoneshow" class="control-label col-md-3 col-sm-3">
						                                      	   <strong> Start Time: </strong>
						                                    </label>
						                                    <div class="row m-bot15 col-md-3 col-sm-3">
																<div class="spinner">
				                                                  <div class="input-group input-small">
				                                                      <input type="text" id='phoneShowSec' class="spinner-input form-control" value="0">
				                                                      	<div class="spinner-buttons input-group-btn btn-group-vertical">
				                                                          <button type="button" class="btn spinner-up btn-xs btn-default">
				                                                              <i class="fa fa-angle-up"></i>
				                                                          </button>
				                                                          <button type="button" class="btn spinner-down btn-xs btn-default">
				                                                              <i class="fa fa-angle-down"></i>
				                                                          </button>
					                                                    </div>
					                                                </div>
					                                            </div>		
						                                    </div>
															<label for="phoneduration" class="control-label col-md-3 col-sm-3">
						                                      	   <strong> Duration: </strong>
						                                    </label>
						                                    <div class="row m-bot15 col-md-3 col-sm-3">
																<div class="spinner">
				                                                  <div class="input-group input-small">
				                                                      <input type="text" id='phoneShowDuration' class="spinner-input form-control" value="0">
				                                                      	<div class="spinner-buttons input-group-btn btn-group-vertical">
				                                                          <button type="button" class="btn spinner-up btn-xs btn-default">
				                                                              <i class="fa fa-angle-up"></i>
				                                                          </button>
				                                                          <button type="button" class="btn spinner-down btn-xs btn-default">
				                                                              <i class="fa fa-angle-down"></i>
				                                                          </button>
					                                                    </div>
					                                              </div>
					                                            </div>		
						                                    </div>											                                
						                                </div>
													</div> <!-- 1st form-group -->                                          		
                                          	</section>
                                        </div>  <!-- end of clicktocall -->
                              		</div>	
	                      		</div>
	                      	</div>
	                      </div>
	                      <div class="modal-footer">
	                          <button data-dismiss="modal" class="btn btn-danger" type="button"><i class="fa fa-times"></i> Close</button>
	                          <button class="btn btn-primary" type="button"><i class="fa fa-save"></i> Save</button>
	                      </div>
	                   </div> <!--  end of modal content -->
	               </div> <!--  end of modal dialog -->
	            </div>  <!--  end of modal -->
			<?php } ?>

		</div>
	</div>
</div>

<script type="text/javascript" src="loader.js"></script>