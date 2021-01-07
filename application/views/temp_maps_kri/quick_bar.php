<style>
.datez{
	color:#DCDCDC;
	font-size:9px;
}.datezr{
	color:#808080;
	font-size:9px;
 
}
</style>
<a href="#" style='display:none' id="chatKri" class="nav-link quick-sidebar-toggler">
 <i class="fa fa-comments"></i>
</a>


<script>
var open;
var posisi;
 function open_chat(){
	 posisi="kontak";
	 var link = document.getElementById("btnClose");
	 link.setAttribute('href', "#");
	  open=true;
		$.ajax({
		 url:"<?php echo site_url("chat/getRecent"); ?>", 
		 method:"POST", 
		 beforeSend: function() {
			 $("#messages").removeClass("tab-chat tab-pane fade show active show-chat"); 
			  $("#chat_namaKapal").html("Chatting");
		},
		 success: function(data)
				{ 	
					     document.getElementById("chatKri").click();
					 	 $("#chatRecent").html(data);
					 	 $("#isiChat").html("");
					 	
					 	 scroll();
						
						 //tab-chat tab-pane fade show active show-chat
				}		
		}); 
		
 }
  
   function type_teks(e)
    { 
		  
	var inField=$("#type_teks").val();
        var charCode;
        if (e && e.which) {
            charCode = e.which;
        } else if (window.event) {
            e = window.event;
            charCode = e.keyCode;
        }
		
		 
        if (charCode == 13 && inField) {
				 
            sendChat(inField);
        }

    }
	 
	</script>
	
	
<script>
var id_sender;
function chat(val,idsender=null,namakapal=null){
var link = document.getElementById("btnClose");
	 link.setAttribute('href', "javascript:open_chat()");
	if(idsender){
		id_sender = idsender;
	}else{
		id_sender = val.id_sender;
	}
	if(namakapal){
		var nama_sender = namakapal;
	}else{
		var nama_sender = val.nama_sender;
	}
		//if(open==false){
		document.getElementById("chatKri").click();
		//}
		
		//open=true;	 
		$("#chat_namaKapal").html(nama_sender);
		$("#newChat").html("");
		 
		$.ajax({
		 url:"<?php echo site_url("chat/getChatKri"); ?>",
		 data:{id_sender:id_sender},
		 method:"POST",
		 dataType:"JSON",
		 beforeSend: function() {
			 	$("#messages").addClass("tab-chat tab-pane fade show active show-chat"); 	
		},
		 success: function(data)
				{ 	
						 
						$("#isiChat").html(data.isi);
						 scroll();
				}		
		}); 
		 
}
 
 function scroll(){
	  var element = document.getElementById("scrolmsg");
	 element.scrollTop = element.scrollHeight;
 }
 function chatReplay(){ 
	 var id = id_sender;
	  $.ajax({
		 url:"<?php echo site_url("chat/chatReplayKri"); ?>",
		 data:{id_sender:id},
		 method:"POST",
		 dataType:"JSON",
		 beforeSend: function() {
			 
		},
		 success: function(data)
				{ 		
					if(data.isi){
						$("#isiChat").append(data.isi); 
						scroll(); 
					}
				}		
		}); 
 } 
  
 function callChat(){  
	  $.ajax({
		 url:"<?php echo site_url("chat/callChat"); ?>",  
		 dataType:"JSON",
		 beforeSend: function() {
			 
		},
		 success: function(data)
				{ 		
				
					if(data.isi){
					$("#messages").addClass("tab-chat tab-pane fade show active show-chat"); 						
						if(id_sender!=data.id_sender && open==true && posisi=="chat")
						{//s	alert(open);
							//document.getElementById("chatKri").click(); 
						$("#newChat").html('<br><button onclick="open_chat()"  class="btn  btn-primary btn-border btn-round"> <i class="fa fa-envelope"></i> Anda memili pesan baru </button>');
						
						}else{
							
								posisi="chat"
								open=true;
								document.getElementById("chatKri").click();
								chat(data);
								chatReplay(); 
							}
						}
				}		
		}); 
 }
 
  $( document ).ready(function() { 
    set_aktif();  
//$("#messages").removeClass("show-chat"); 
 setInterval(function(){ callChat(); }, 4000);
 setInterval(function(){ cekVc(); }, 4000);
 setInterval(function(){ set_aktif(); }, 12000); //120000
});
	
</script>


<script>
 
 function set_aktif(){ 
	 $.ajax({
		 url:"<?php echo site_url("chat/set_aktif"); ?>", 
		 method:"POST",
		 dataType:"JSON", 
		 success: function(data)
				{ 		
				 
				}		
		}); 
 }
 function sendChat(text){
	  posisi="chat";
	  open=true;
	 $.ajax({
		 url:"<?php echo site_url("chat/saveChatKri"); ?>",
		 data:{id_sender:id_sender,msg:text},
		 method:"POST",
		 dataType:"JSON",
		 beforeSend: function() {
			 
		},
		 success: function(data)
				{ 		
				$("#isiChat").append(data.isi);
				$("#type_teks").val(""); 
				 	  scroll();
						  
				}		
		}); 
 }
</script>
 
				
				 <div class="quick-sidebar">
			<a id="btnClose" href="javascript:open_chat()" class="close-quick-sidebar">
				<i class="flaticon-cross"></i>
			</a>
			<div class="quick-sidebar-wrapper">
				<ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
					<li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#messages" role="tab" aria-selected="true"><span id="chat_namaKapal">KRI 20</span></a> </li>
				</ul>
				<div class="tab-content mt-3">
					<div class="tab-chat tab-pane fade show active show-chat"  id="messages" role="tabpanel"> 
					
					<div id="chatRecent">
					</div>
					
						<div class="messages-wrapper"> 
							<div  id="scrolmsg" class="messages-body messages-scroll scrollbar-outer"  >
							
							
										<div class="message-content-wrapper">
												<div class="message message-in" style='visibility:hidden'>
													<div class="avatar avatar-sm">
														<img src="<?php echo base_url()?>theme/atlantis/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle border border-white">
													</div>
													<div class="message-body">
														<div class="message-content">
															<div class="name">Chad</div>
															<div class="content">Hello, Rian</div>
														</div> 
														<div class="date">12.31</div>
													</div>
												</div>
											</div>
											<div class="message-content-wrapper"  style='visibility:hidden'>
													<div class="message message-out">
														<div class="message-body">
															<div class="message-content">
																<div class="content">
																	Hello, Chad
																</div>
															</div>
															<div class="message-content">
																<div class="content">
																	What's up?
																</div>
															</div>
															<div class="date">12.35</div>
														</div>
													</div>
												</div>
								
					 <div id="isiChat">
						<span id="chat_group_sender"></span>
					 </div>
							 
								 
							</div>
						 
							<div class="messages-form">
								<div class="messages-form-control">
									<input onkeyup="type_teks()" id="type_teks" type="text" placeholder="Type here" class="form-control input-pill input-solid message-input">
								</div>
							<!--	<div class="messages-form-tool">
									<a href="#" class="attachment">
										<i class="flaticon-file"></i>
									</a>
								</div>--> 
								
							</div>
							<div id="newChat"></div>
						</div>
					</div>
					
				</div>
			</div>
		</div>


<script>
var waiting;
 var i; 
function cekVc(){
	 i=0; 
	 $.ajax({
		 url:"<?php echo site_url("chat/cekVcKri"); ?>", 
		 method:"POST",
		 dataType:"JSON", 
		 success: function(data)
				{ 		
				
					 if(data.sts==0 && data.nama_sender){
						$("#mdl_vicall").modal({backdrop: 'static', keyboard: false});
						 
							$("#receiver_vc").html(data.nama_sender+" menghubungi anda...");
							$(".modal-dialog").removeClass("modal-dialog-full");
							$(".modal-content").removeClass("modal-content-full");
							  // $("#type_modal_vicall").removeClass("modal-sm");
							 $("#type_modal_vicall").removeClass("modal-lg");
							 $("#type_modal_vicall").addClass("modal-sm");
							 $("#tmbEndVc").hide();
								 $("#mdl_vicall").modal({backdrop: 'static', keyboard: false});
								 $("#vicallReceiver").html(data.nama_sender); 
								 $("#areaVicall").html("<button onclick='terima_vc(`"+data.nama_sender+"`,`"+data.frame+"`,`"+data.link+"`)' class='btn-block btn btn-primary'><i class='fa fa-video'></i> Terima</button>"); 
						 
					 }
				 
				}		
		}); 
}
function terima_vc(nama_sender,frame,link){
	 $.ajax({
		 url:"<?php echo site_url("chat/terima_vc_kri"); ?>", 
		 method:"POST",
		 dataType:"JSON", 
		 data:{link:link},
		 success: function(data)
				{ 		
				 
					 	 
							$("#receiver_vc").html("Tersambung dengan "+nama_sender);
							$(".modal-dialog").addClass("modal-dialog-full");
							$(".modal-content").addClass("modal-content-full"); 
							 $("#type_modal_vicall").removeClass("modal-lm");
							 $("#type_modal_vicall").addClass("modal-lg");
							 $("#tmbEndVc").show();
								 
							  $("#areaVicall").html(frame); 
						 // $("#areaVicall").html(data.frame); 
					 
				 
				}		
		}); 
}

function endVicall(){ 
 $("#mdl_vicall").modal("hide");
	 $.ajax({
		 url:"<?php echo site_url("chat/endVicall"); ?>", 
		 method:"POST", 
		 success: function(data)
				{ 	
					   
				}		
		}); 
 }
</script>




<style>
.modal-dialog-full {
  min-width: 90%;
  min-height: 90%;
  margin-left:5%;
  margin-top:2%;
  padding: 0;
  background-color:white;
}

.modal-content-full {
  height: auto;
  min-height: 90%;
  border-radius: 0;
   background-color:white;
}
</style>

<!-- modal -->
<div class="modal fade" id="mdl_vicall" >
<div class="modal-dialog"   id="type_modal_vicall"> 
  <div class="modal-content" >
	<div class="modal-header">
	  <h4 class="modal-title" id="receiver_vc">  </h4>
	  <button id="tmbEndVc" class="btn btn-danger btn-sm" type="button" onclick="endVicall()"  >
	 	Akhiri
	  </button>
	</div>
	 <div class="modal-body" id="areaVicall">
     <center>  <div id="vicallReceiver" style="font-weight:bold"></div>
	<br>
	<i>sedang menyambungkan.....</i>
	
	</center>
	</div>
	  
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->