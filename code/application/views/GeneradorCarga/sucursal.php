<script type="text/javascript">;
    //setInterval("my_function();",10000); 
    function my_function(){
      $('#refresh').load(location.href + '#dataTable1');
    }
    

	

		function showValue(newValue, idserv)
		{
			document.getElementById("range"+idserv).innerHTML=" len => " +newValue;
		}
		
		function changeFilter(newValue){
			
			//   "http://localhost:7070/Repo_RihProject/RihProject/index.php/";
			window.location= window.location.pathname + "?User/myservices/topic/"+newValue;
		}
		function filterTable(newValue){
						
			window.location= window.location.pathname + "?User/myservices/all/search/"+newValue;
		}

		function checkPwd(idvinc, mode){
			 $.ajax({                                      
		      url: window.location.pathname+'?Ajax/userCheckPwd/'+idvinc+'/'+mode,                  //the script to call to get data          
		      data: "",                        //you can insert url argumnets here to pass to api.php
		                                       //for example "id=5&parent=6"
		      dataType: 'json',                //data format      
		      success: function(data)          //on recieve of reply
		      {
		        
		        //--------------------------------------------------------------------
		        // 3) Update html content
		        //--------------------------------------------------------------------
		               
		        //for(var i=0;i<data.length;i++){
		          var id = data.id;              //get id
		          var pwd = data.password;           //get name
		           //alert(data.password);
		            //$.each( data, function( id, val ) {
		              //items.push( "<li id='" + id + "'>" + data[id]['Muser']  +"</li>" );
		            //});
		          
		          if(mode == 'hide'){
		          	$('#btn'+id).html('<i class="fa fa-eye"></i> Show');
		          	$('#btn'+id).removeClass("btn-success").addClass('btn-danger');
		          	$('#btn'+id).attr("onClick","checkPwd("+id+",'show')");
		          	$('#badge'+id).html('Hidden');
		          	$('#badge'+id).removeClass("badge-danger").addClass('badge-success');
		          	
		          }		          	
		          else if(mode == 'show'){
		          	$('#btn'+id).html('<i class="fa fa-eye-slash"></i> Hide');		          	
		          	$('#btn'+id).removeClass("btn-danger").addClass('btn-success');
		          	$('#btn'+id).attr("onClick","checkPwd("+id+",'hide')");
		          	$('#badge'+id).html('Visible');
		          	$('#badge'+id).removeClass("badge-success").addClass('badge-danger');
		          }

		          $('#pwd'+id).html(pwd); //Set output element html  	

		          //$('#output').html(items.join("")); //Set output element html  
		        //}
		        
		        //recommend reading up on jquery selectors they are awesome 
		        // http://api.jquery.com/category/selectors/
		      } 
		    });
		}
	
	

  </script>
  
 
<div id="refresh" class="main-container">


	<div class="padding-md">
		<ul class="breadcrumb" style="font-size:2em; font-family: 'Century Gothic Bold'; letter-spacing: -0.4px; color: #1C2B36; text-transform: uppercase; margin-top: -8px;">
			<li><span class="primary-font"><i class="fa fa-home"></i></span><a href="<?php echo site_url('?admin/dashboard'); ?>"> DASHBOARD</a></li>
			<li>ENTRY</li>	 
			<li>MY SERVICES</li>
			<li style="float:right;"><a href="<?php echo site_url('?User/myservices_to_xml');?>"><i class="fa fa-eye"></i></a></li>
			<li style="float:right;"><a href="<?php echo site_url('?User/myservices_to_excel');?>"><i class="fa fa-table"></i></a></li>
			<li style="float:right;color:green"><a href="<?php echo site_url('?User/vinculate_service_form');?>"><i class="fa fa-plus"></i></a></li>
			<li style="float:right;color:red"><a href="<?php echo site_url('?User/request_service_form');?>"><i class="fa fa-plus-square"></i></a></li>			
		</ul>
		
		<?php if(isset($csrf_hash)){ echo 'HASH CSRF: '.$csrf_hash; } ?>
		<div class="row">
			<!--<div class="pull-center col-xs-6">			
			<div class="bg-danger padding-md">
				<h2 class="m-top-lg m-bottom-none">
					Simplify Admin
				</h2>
				<div class="bg-danger padding-md">
					<h2 class="m-top-lg m-bottom-none">
						Simplify Admin
					</h2>
					<div class="owl-carousel custom-carousel3 no-controls m-bottom-lg owl-theme owl-loaded">
					    
					    
						
					<div class="owl-stage-outer" style="padding-left: 0px; padding-right: 0px;"><div class="owl-stage" style="width: 3640px; transform: translate3d(-1456px, 0px, 0px); transition: 0s;"><div class="owl-item cloned" style="width: 728px; margin-right: 0px;"><div class="item">
					    	<h4>Easy to Customize</h4>
						</div></div><div class="owl-item" style="width: 728px; margin-right: 0px;"><div class="item">
					    	<h4>Responsive Admin Theme</h4>
					    </div></div><div class="owl-item active" style="width: 728px; margin-right: 0px;"><div class="item">
					    	<h4>More awesome elements</h4>
						</div></div><div class="owl-item" style="width: 728px; margin-right: 0px;"><div class="item">
					    	<h4>Easy to Customize</h4>
						</div></div><div class="owl-item cloned" style="width: 728px; margin-right: 0px;"><div class="item">
					    	<h4>Responsive Admin Theme</h4>
					    </div></div></div></div><div class="owl-controls"><div class="owl-nav"><div class="owl-prev" style="display: none;">prev</div><div class="owl-next" style="display: none;">next</div></div><div class="owl-dots" style=""><div class="owl-dot"><span></span></div><div class="owl-dot active"><span></span></div><div class="owl-dot"><span></span></div></div></div></div>
				</div>
				
			</div>
			</div> -->
			
			<div class="col-xs-12">		
				<label>Filters:				
				<?php 
				$uri_search = "?User/myservices/".$filter."/".$topic."/";
				if($filter == "topic")
					$uri_search = "?User/myservices/".$filter."/".$topicId."/";
				//65 a 90 ASCII alphabet
				for ($k=65;$k<=90;$k++){	
					$uri_se = $uri_search.chr($k);
					echo anchor(site_url($uri_se),chr($k),'class="btn fa fa-search"');
				}
				?>
				</label>
			</div>
			<div class="col-xs-6">				
								
				<div class="input-group">
				<label>
					Others:					
					<?php 
					$uri_default = "?User/myservices/".$filter."/".$topic."/".$valsearch;
					$filtername1 = "Vulnerables";
					$filtername2 = "Asynchronous";					
					$filtername3 = "Hidden";
					$filtername4 = "Topic";
					$uriuser1 = "?User/myservices/vulnerable/search/all";
					$uriuser2 = "?User/myservices/async/search/all";
					$uriuser3 = "?User/myservices/hidden/search/all";					
					$uriuser5 = "?User/myservices/all/search/all";

					if($filter =="vulnerable"){
						$filtername1 = "Protected";
						$uriuser1 = "?User/myservices/protected/search/all";
					}
					else if($filter =="protected"){
						$filtername1 = "Vulnerables";
						$uriuser1 = "?User/myservices/vulnerable/search/all";
					}
					else if($filter =="async"){
						$filtername2 = "Synchronous";
						$uriuser2 = "?User/myservices/sync/search/all";
					}
					else if($filter =="sync"){
						$filtername2 = "Asynchronous";
						$uriuser2 = "?User/myservices/async/search/all";
					}
					else if($filter =="hidden"){
						$filtername3 = "Visible";
						$uriuser3 = "?User/myservices/visible/search/all";
					}
					else if($filter =="visible"){
						$filtername3 = "Hidden";
						$uriuser3 = "?User/myservices/hidden/search/all";
					}
					
					
					echo '<a  href="'.site_url($uriuser1).'" class="btn btn-danger inline-block" value="Filtrar1">'.$filtername1.'</a>';
					echo '<a  href="'.site_url($uriuser2).'" class="btn btn-warning" value="Filtrar2">'.$filtername2.'</a>';
					echo '<a  href="'.site_url($uriuser3).'" class="btn btn-warning" value="Filtrar2">'.$filtername3.'</a>';					
					echo '<a  href="'.site_url($uriuser5).'" class="btn btn-primary" value="Filtrar3">All</a>';					



					//lpCreatePass(length, upper, lower, digits, special, mindigits, ambig, reqevery)
					?>
					<select name="topic" data-parsley-required="true" onchange ="changeFilter(this.value)">
                            <?php                                         
                            if(isset($servtopics)){
	                             foreach($servtopics as $s => $v):	                            
	                            ?>
	                                <option value="<?php echo $s;?>" <?php if($topic != "search" && $topic == $v) echo 'selected';?> >
	                                    <?php echo $v;?></option>
	                            <?php
	                            endforeach;
	                        }   ?>
                            
                	</select>

					
					</label>
					

				</div>
				
			</div>
			<div class="col-xs-6">
				<div id="dataTable_filter" class="dataTables_filter">
					<label>Search:
						<input type="search" class="form-control input-sm" aria-controls="dataTable" onchange="filterTable(this.value);" value="<?php if(isset($valsearch) && $valsearch!='all') echo $valsearch; ?>">
					</label>
				</div>
			</div>
		</div>
		
		
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>

		<table class="table table-striped" id="dataTable1">
		<!-- <div id="output">this element will be accessed by jquery and this text replaced</div> -->
			<thead>
				<tr>
					<th>No. ID</th>									
					<th>Service</th>					
					<th>Username</th>
					<?php $uri2all = "?User/check_password"; ?>
					<th style="width:180px;">
					<div class="col-md-1">
					<?php
						echo '<a href="'.site_url($uri2all."/hide").'"  class="btn-xs btn-success inline-block"><i class="fa fa-eye-slash"></i></a>';						
					?>
					</div>
					<div class="col-md-8">
					Cur. Password
					</div>
					<div class="col-md-1">
					<?php
						echo '<a href="'.site_url($uri2all."/show").'"  class="btn-xs btn-danger inline-block"><i class="fa fa-eye"></i></a>';
					?>
					</div>
					</th>										
					<th>Pwd Status</th>					
					<th>Visited</th>					
					<th style="width:10%;">Options</th>
				</tr>
			</thead>
			<tbody style='font-size:20px;'>
				 <?php 		
				 	if(isset($services)){
				 		$csrf = array(
  				  		        'name' => $this->security->get_csrf_token_name(),
        						'hash' => $this->security->get_csrf_hash()
							);
						foreach($services as $row){							
							//$uri1 = "?admin/visitservice/".$row['id']; //FOR USER

							$id = $row['id'];							
							$uri1 = "?User/renewpasswordservice/".$id;
							//$olduri2 = "?User/check_password/".$id;	
							$uri2 = "checkPwd(".$id.",";
							//$uri3 = base_url()."?User/viewpassword/".$id;
							$uri3 = "?User/goservice/".$id;
							$uri4 = "?User/viewservice/".$id;
							$uri5 = "?User/syncservice/".$id;
							//<a href=".." >Go</a>
							echo '<tr id="row'.$id.'">';
							echo '<div class="container">';
							echo  '<td>'.$row['id'].'</td>';							
							echo  '<td>'.$row['servname'].'</td>';																					
							echo  '<td>'.$row['username'].'</td>';
							echo  '<td >';
							echo '<div id="pwd'.$row['id'].'" style="display:inline-block">';
							echo $row['password'];
							echo '</div>';							
							echo form_open($uri1);
							echo '<div class="col-md-7">';
							echo '<input name="passwordlen" data-parsley-required="true" class="input-sm" type="range" min="8" max="30" value="'.strlen($row['password']).'" step="1" onmousemove="showValue(this.value,'.$id.')"/>';
							echo '</div>';
							echo '<div class="col-md-5">';
							echo "<button type='submit'  class='btn-xs btn-success inline-block'><i class='fa fa-refresh'></i><span id='range".$id."'> len => ".strlen($row['password'])."</span></button>";
							echo '</div>';
							//echo "<a href=".site_url($uri4)."  class='btn-xs btn-success block'><i class='fa fa-refresh'></i> Renew <span id='range".$id."'>length => 12</span></a>";
							echo form_close();
							echo '</td>';														
							echo  '<td> <small class="badge badge-'.$stylestatus[$row['stats'][1]].' badge-round bounceIn animation-delay3 m-left-xs">'.$row['stats'][1].'</small> | ';
							echo  '<small id="badge'.$id.'" class="badge badge-'.$stylestatus[$row['stats'][0]].' badge-round bounceIn animation-delay4 m-left-xs">'.$row['stats'][0].'</small> => ';
							if($row['stats'][0]=="Visible"){
								//echo '<a id="btn'.$row['id'].'" href="'.site_url($uri2."/hide").'"  class="btn-xs btn-success inline-block"><i class="fa fa-eye-slash"></i> Hide</a>';
								echo '<a id="btn'.$id.'" href="" onClick="'.$uri2.'\'hide\');" class="btn-xs btn-success inline-block"><i class="fa fa-eye-slash"></i> Hide</a>';
							}elseif($row['stats'][0]=="Hidden"){							
								//echo '<a id="btn'.$row['id'].'" href="'.site_url($uri2."/show").'"  class="btn-xs btn-danger inline-block"><i class="fa fa-eye"></i> Show</a>';
								echo '<a id="btn'.$id.'" href="" onClick="'.$uri2.'\'show\');" class="btn-xs btn-danger inline-block"><i class="fa fa-eye"></i> Show</a>';
							}
							echo ' <br> | ';
							echo  '<small class="badge badge-'.$stylestatus[$row['stats'][2]].' badge-round bounceIn animation-delay5 m-left-xs">'.$row['stats'][2].'</small>';
							if($row['stats'][2] == "Asynchronous"){
								echo " => <a href=".site_url($uri5)."  class='btn-xs btn-success' tooltip='que es esto?'><i class='fa fa-refresh'></i> Sync</a>";
							}
							echo'</td>';							
							echo  '<td>'.$row['times'].' times</td>';								
							echo "<td>";
							echo '<div class="btn-toolbar" role="toolbar" aria-label="...">';
							echo '<div class="btn-group" role="group" aria-label="...">';							
							echo "<a href=".site_url($uri4)."  class='btn btn-success'><i class='fa fa-eye'></i>View</a>";							
							echo '</div>';
							echo '<div class="btn-group" role="group" aria-label="...">';							
							
							echo '</div>';
							echo '<div class="btn-group" role="group" aria-label="...">';							
							echo anchor($uri3, 'Go','target="_blank" class="btn fa fa-external-link-square"');
							echo '</div>';
							echo '</div>'; //toolbar div
							echo "</td>";
							//echo '<div class="output">this element will be accessed by jquery and this text replaced</div>';
							echo '</div>';
							echo '</tr>';
							
						}
					}
				?>
			</tbody>
		</table>		
		<ul class="pagination">
			<?php echo $links; ?>
		</ul>
	</div><!-- ./padding-md -->
	


</div><!-- /main-container -->
