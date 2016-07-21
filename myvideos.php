<script type="text/javascript">
	function deleteVideo(id) {
		var delConfirm=confirm("Are you sure you want to delete this video?");
		if(!delConfirm) return;
		
		var fd = new FormData();
		fd.append("vid", id);

		xhr = new XMLHttpRequest();

		xhr.addEventListener("load", delVideoResponse, false);

		xhr.open("POST", "del.php");
		xhr.send(fd);
	}

	function delVideoResponse() {
	    if (xhr.readyState==4) {
	        var r=xhr.responseText;
	        if(r=="Login") location.replace('<?php echo $_ROOT_; ?>');
	        if(r!="OK") alert("Video deletion failed!\n"+r);
	        else location.href="";
		}
	}

	var forPreview=true;
	function viewVideo(videoUID) {
		loadVideo(videoUID);
	}

	function showUpload() {
		document.getElementById('file').value=null;
		enableButtons();
		document.getElementById('uploadForm').style.display='block';
	}

	var optinW=400;
	var optinH=200;
	function showActions(id, w, h) {
		optinW=w;
		optinH=h;
		
		document.getElementById('tr'+id).style.backgroundColor='#d0e0f0';
		loadActions(id);
		document.getElementById('actionsForm').style.display='block';
	}

	function showProperties(id) {
		document.getElementById('tr'+id).style.backgroundColor='#d0e0f0';
		loadProperties(id);
		document.getElementById('propertiesForm').style.display='block';
	}

	function showEmbedCode(id, vid) {
		document.getElementById('tr'+id).style.backgroundColor='#d0e0f0';
		var ttt="&lt;script src='loader.js'&gt;&lt;/script&gt;\n&lt;script&gt;loadVideo(\""+vid+"\");&lt;/script&gt;";
		document.getElementById('embedCode').innerHTML=ttt;
		document.getElementById('embedForm').style.display='block';
	}

</script>

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
						<div class="pro-img-box">
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
								<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#optionModal"><i class="fa fa-gears"></i> Options</button>
		                        <div class="btn-group">
		                            <button data-toggle="dropdown" class="btn btn-success btn-sm dropdown-toggle" type="button"> More <span class="caret"></span></button>
		                            <ul role="menu" class="dropdown-menu">
	                                  <li><a href="#"><span class="text-primary"><i class="fa fa-share-square-o"></i> Action </a></span></li>
	                                  <li><a href="#"><span class="text-danger"><i class="fa fa-trash-o"></i> Delete </a></span></li>
	                                  <li class="divider"></li>
	                                  <li><a href="#"><span class="text-warning"><i class="fa fa-link"></i> Embed </a></span></li>
		                            </ul>
				                    <!-- Options Modal -->
		                              <div class="modal fade " id="optionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		                                  <div class="modal-dialog">
		                                      <div class="modal-content">
		                                          <div class="modal-header">
		                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                                              <h4 class="modal-title"><i class="fa fa-gears"></i>  Options</h4>
		                                          </div>
		                                          <div class="modal-body">
		                                          	<div class="row">
		                                          		<div class="col-md-12">
		                                          			<section class="panel">
			                                          			<ul class="nav nav-tabs options-tab">
																  <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-pencil-square-o"></i> Properties</a></li>
																  <li><a data-toggle="tab" href="#menu1"><i class="fa fa-code"></i> IFrame</a></li>
																  <li><a data-toggle="tab" href="#menu2"><i class="fa fa-video-camera"></i> External Video</a></li>
																</ul>
		                                          			</section>
				                                          	<form class="text-left">
																<div class="form-group options-form">
																	  <label for="title"><strong>Title: </strong></label>
																	  <input type="text" class="form-control m-bot15" id="propertyTitle" value="<?php echo $prj['Title']; ?>" placeholder="Enter Title">
																</div>
																<div class="form-group options-form">
																	<label for="active"><strong>Active: </strong></label>
										   							<select id='propertyActive' class="form-control m-bot15">
																		<option <?php if ($prj['Active'] == 0){ ?> selected <?php } ?> value=0>Plan Free</option>
																		<option <?php if ($prj['Active'] == 1){ ?> selected <?php } ?> value=1>Plan Paid</option>
						                                          	</select>											
																</div>
																<div class="form-group options-form">
																	<div class="row">
																		<div class="col-md-4">
																			<label for="position"><strong>Position: </strong></label>
																		   	<select id='propertyPosition' class="form-control m-bot15">
																				<option <?php if ($prj['Position'] == 0){ ?> selected <?php } ?> value=0>Centered</option>
																				<option <?php if ($prj['Position'] == 1){ ?> selected <?php } ?> value=1>Top left</option>
																				<option <?php if ($prj['Position'] == 2){ ?> selected <?php } ?> value=2>Top right</option>
																				<option <?php if ($prj['Position'] == 3){ ?> selected <?php } ?> value=3>Bottom left</option>
																				<option <?php if ($prj['Position'] == 4){ ?> selected <?php } ?> value=4>Bottom right</option>
								                                          	</select>								
								                                        </div>
																		<div class="col-md-4">									
																			<label for="offsetx"><strong>Offset X: </strong></label>
																			<input id='propertyOffsetX' type='number' value="<?php echo $prj['OffsetX']; ?>" class="form-control m-bot15" placeholder="0">
																		</div>
																		<div class="col-md-4">
																				<label for="offsety"><strong>Offset Y: </strong></label>
																				<input id='propertyOffsetY' type='number' value="<?php echo $prj['OffsetY']; ?>" class="form-control m-bot15" placeholder="0">
																		</div>
																	</div>
																</div>															
																<div class="form-group options-form">
																	<div class="row">
																		<div class="col-md-4">
									                                      	<label for="displayautomaticall">
									                                      	  <strong> Display Automatically: </strong>
									                                      	</label>
										                                    <label class="checkbox m-bot15">
										                                        <input id='propertyDisplayAutomatically' <?php if ($prj['DisplayAutomatically'] == 1){ ?> checked <?php } ?> type="checkbox"> Activate
										                                    </label>									
										                                </div>
										                                <div class="col-md-8">
				                                  							<div class="aftersec">
										                                      	<label for="afterseconds">
										                                      	  <strong> After (Seconds): </strong>
										                                      	</label>		                          		
																				  	<input type="number" class="form-control m-bot15" id="propertyDisplayAfter" value="<?php echo $prj['DisplayAfter']; ?>" placeholder="0" min="0">				
				                                  							</div>								
				                                  						</div>
																	</div> 											
		                          		                        </div>
																<div class="form-group options-form">
																	<div class="row">
																		<div class="col-md-12">
																			<label for="backgrounds">
										                                      	  <strong> Background: </strong>
										                                    </label>
									                                    </div>
																		<div class="col-md-6">
																			<label class="checkbox m-bot15">
										                                          <input id='propertyDimmedBG' <?php if ($prj['DimmedBG'] == 1){ ?> checked <?php } ?> type="checkbox"> Dimmed
										                                    </label>								
										                                </div>
										                                <div class="col-md-6">
										                                    <label class="checkbox m-bot15">
										                                        <input id='propertyGlass' <?php if ($prj['GlassBG'] == 1){ ?> checked <?php } ?> type="checkbox"> Glass
										                                    </label>			
										                                </div>
																	</div> 											
		                                  						</div>
																<div class="form-group options-form"> 
																	<div class="row">
																		<div class="col-md-8">
																			<label for="cookielife"><strong>Cookie Life: </strong></label>
																			<input id='propertyCookieLife' type='number' value="<?php echo $prj['CookieLife']; ?>" class="form-control m-bot15" placeholder="0" min="0">
																		</div>
																		<div class="col-md-4">
									                                      	<label for="exitonend">
									                                      	  <strong> Exit On End: </strong>
									                                      	</label>
									                                      	<label class="checkbox m-bot15">
									                                          <input id='propertyExitOnEnd' <?php if ($prj['ExitOnEnd'] == 1){ ?> checked <?php } ?> type="checkbox"> Activate
									                                     	</label>
																		</div>
																	</div>												
		                                  						</div>


															</form>
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
		                            <!-- modal -->
		                        </div><!-- /btn-group -->
							</div> <!-- /col-md-12 --> 
                        </div>
					</section>
				</div>
			<?php } ?>

		</div>
	</div>
</div>

<script type="text/javascript" src="loader.js"></script>