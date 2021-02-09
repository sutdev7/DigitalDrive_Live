<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<main id="main">

   <!--  <?php 
  $msg = $this->session->flashdata('msg'); 
  if(!empty($msg)) {
  ?>
    <section style="padding-top: 7%;">
        <?php echo $msg; ?>
    </section>
    <?php
  }
  ?>
 -->
 <style type="text/css">

  .ongoing-task .table thead th{

    color: #808d92 !important;

  }
  p{
  	color: #808d92 !important;	
  }
  .task_name {
  	color: #808d92 !important;	
  	font-size: 14px;
  }
  a{color:white;}

</style>
    <!--==========================
      ConterDiv Section
    ============================-->
	 <div class="browser-taskDiv">
        <div class="container">
            <div class="row">
				<div class="col-lg-8">
                    <div class="browser-top">
                        <div class="browser-lft">
                            <h2> All Tasks </h2>
                        </div>
                        <div class="browser-rht">
                            <div class="border-readyDiv">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend"> <span class="input-group-text"> <img src="<?php  echo base_url('assets/img/address.png'); ?>" alt="Anywhere"> &nbsp;&nbsp; Anywhere </span> </div>
                                    <input type="text" class="form-control" id="fldSearchCriteria" value="<?php if(isset($_POST['searchCriteria'])) echo $_POST['searchCriteria']; ?>" name="fldSearchCriteria" placeholder="Seacrh by title, Skill or any key word ">
                                    <div class="input-group-append cursor_pointer"> <span class="input-group-text"> <img id="btnSearchCriteria" src="<?php  echo base_url('assets/img/search-gray.png'); ?>" alt="Search"> </span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
											
							  
																							
												 
																																					  
														 
																   
																						  
										  
									  
								  
																																																																																																		 
																																							 
																														
													  
								  
														 
													  
														  
								   
																									  
												   
																 
											  
												   
																   
											  
													
														 
									   
								  
							  
							   
										 
								   
							  
						   

                </div>

                <div class="col-lg-4">
                    <div class="task-blueDiv" style="padding: 10px;">
                        <div class="row">
                            <div class="col">
                                <img src="<?php  echo base_url('assets/img/user3.png'); ?>" alt="Post a Task">
                            </div>
                            <div class="col">
                                <h2> What to <br>
                                    work as a client? </h2>
                                <a href="<?php echo base_url(); ?>post-task-step-1" class="post-a-task"> Post a Task </a>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
    <div class="browser-taskDiv" style="padding: 0;margin: 0;">
        <div class="container">
            <div class="row">
                
               <!--- //modified on 19-10-2020 --->
                <div class="col-lg-12">
                <div id="searchResult">
                    <div class="row">
                        
							<!-- <div class="col-xl-4">
							  <div class="mt-5">
								<div class="card gigs-task">  -->
								  <!-- <img class="card-img-top" src="img/gig.png" /> -->
								 <!--  <div class="card-body position-relative">
									<div class="gig-task-prof"> <!-- <img src="{user_image}" class="user-img"> -->
										 <!--<img class="card-img-top img-circle" src="{user_image}"  style="width:100px;height:100px;border-radius: 73px;margin: 5px 129px 15px 92px;
" />

																																			   
									  <p class="my-2 ">{task_created_by} <span class="d-block small"><i class="fa fa-map-marker"></i> &nbsp;{user_country}</span> </p>
												
																												  
											  
												  
									  <div class="row">
										<div class=" col  my-2 small "><span class="text-primary"><b>{total_project_completed}</b></span> Projects Done </div>
													  
										<div class=" col my-2 small "><span class="text-primary"><b>{total_hired_freelancer}</b></span> Freelancer</div>
									  </div>
									</div>
									<h5 class="card-title text-center"><a href="<?=base_url()?>User/profile_vistorAll/<?=$value->user_id?>">{task_name}</a></h5>
											 
								  </div> -->
											  
										  
								<!--   <div class="card-footer text-muted d-flex justify-content-between flex-wrap">
											 
									<div> <span class="coin-tag">{total_coins}</span> </div>
											  
																						 
									<div class="pull-right" style="margin-top: 6px;"> <span class="text-gray mr-2 font-weight-bold">Spent</span> <span class="text-primary">$ {total_money_spent}</span> </div>
																				   
											  
									<div class="w-100 border-top mt-3">
									  <p class="text-center text-muted small mt-3 mb-0" style="font-size: 12px">Last Login:  {last_login}</p>
									</div>
								  </div> -->


								  	<div class="ongoing-task">
							          <table class="table">

							            <thead>

							              <tr>

							                <th>Project Title</th>

							                <th>By</th>

							                <th>Posted Date</th>
							                <th>Budget</th>

							                <th></th>

							              </tr>

							            </thead>

							            <tbody>

							              {jobs}

							              <tr>
							                <td style="padding-left: 0px">
							                  <img class="card-img-top img-circle" src="{user_image}"  style="width:50px;height:50px;border-radius: 73px;margin: 5px 45px 0px 12px;" /><span class="task_name">{task_name}</span>
							                </td>
							               <!--  <td >

							                  

							                </td> -->

							                <td><p> {task_created_by} </p></td>

							                <td><p> {doc}</p></td>

							                <td>{task_total_budget}</td>

							                <td><small class="btn btn-danger"> 

							                  
							                  <a href="<?=base_url()?>sign-in"> Apply </a>


							                  </small></td>

							              </tr>
							              {/jobs}
							            </tbody>

							          </table>

							         </div>

								<!-- </div>
							  </div>
							</div> -->
                        
                        
                        <!--</div>
                        <div class="pag">
                            {links}
                        </div>
                    </div>
                </div>    

                <div class="col-lg-12">
                    <div class="row">-->
					
											  
															
																														 
																			 
																   
																																			   
																																								
												
																												  
											  
												  
															 
																									  
													  
																																		  
												  
											  
																																						   
											 
																				   
											  
										  
																												 
											 
																				 
											  
																						 
																									  
																				   
											  
																		   
																																					   
											  
										  
									  
								  
							  
											  
											  
															
																														 
																			 
																   
																																			   
																																								
												
																												  
											  
												  
															 
																									  
													  
																																		  
												  
											  
																																						   
											 
																				   
											  
										  
																												 
											 
																				 
											  
																						 
																									  
																				   
											  
																		   
																																					   
											  
										  
									  
								  
							  
											  
											  
															
																														 
																			 
																   
																																			   
																																								
												
																												  
											  
												  
															 
																									  
													  
																																		  
												  
											  
																																						   
											 
																				   
											  
										  
																												 
											 
																				 
											  
																						 
																									  
																				   
											  
																		   
																																					   
											  
										  
									  
								  
							  
											  
											  
															
																														 
																			 
																   
																																			   
																																								
												
																												  
											  
												  
															 
																									  
													  
																																		  
												  
											  
																																						   
											 
																				   
											  
										  
																												 
											 
																				 
											  
																						 
																									  
																				   
											  
																		   
																																					   
											  
										  
									  
								  
							  

                        <div class="pag">
						{MicroClientJobsPagination}
																				  
																		 
														  
														  
														  
														  
														  
																		  
								 
                        </div>
                    </div>
                </div>


            </div>


            </div>
        </div>
    </div>
</main>


<!-- script for auto complete multiselect -->
<script src="<?php  echo base_url('assets/js/fastselect.standalone.js'); ?>"></script>
<script>
    $('.multipleSelect').fastselect();

</script>

<script>
   $(document).on('click',"#btnSearchCriteria",function(){
	   if($("#fldSearchCriteria").val()!=""){
		   $.ajax({
			method: "POST",
			url: "<?php echo base_url(); ?>browse-task",
			data: {
				searchCriteria: $("#fldSearchCriteria").val()
			}
		})
		.done(function(msg) {
			$("#main").html(msg);
				   
		   
		});
	   }else{
		   alert("Please enter any key word");
	   }
	   
   })
</script>
