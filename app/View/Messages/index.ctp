<style>
.container{max-width:1170px; margin:auto;}
img{ max-width:100%;}
.inbox_people {
  background: #f8f8f8 none repeat scroll 0 0;
  float: left;
  overflow: hidden;
  width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}
.top_spac{ margin: 20px 0 0;}
.message_list{ cursor: pointer;}


.recent_heading {float: left; width:40%;}
.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%; padding:
}
.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

.recent_heading h4 {
  color: #05728f;
  font-size: 21px;
  margin: auto;
}
.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}
.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
.chat_ib h5 span{ font-size:13px; float:right;}
.chat_ib p{ font-size:14px; color:#989898; margin:auto}
.chat_img {
  float: left;
  width: 11%;
}
.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people{ overflow:hidden; clear:both;}
.chat_list {
  border-bottom: 1px solid #c4c4c4;
  margin: 0;
  padding: 18px 16px 10px;
}
.inbox_chat { height: 550px; overflow-y: scroll;}

.active_chat{ background:#ebebeb;}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 60%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ 
  overflow:hidden; 
  margin:26px 0 26px;
  cursor: pointer;
}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 4px;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
.chat_delete {
  cursor: pointer;
  float: right;
  margin-top: -28px;
}
</style>
<div class="row">
  <div class="col-md-2">
      <nav class="large-3 medium-4 columns" id="actions-sidebar">


          <ul class="side-nav">
              <li>
                  <?php echo $this->Html->link('Create New Message', array('action' => 'create')); ?>
              </li>
              <li>
                  <?php echo $this->Html->link('My Contacts', array('controller'=> 'contacts', 'action' => 'index')) ?>
              </li>
          </ul>
      
      
      </nav>
  </div>
  <div class="col-md-10">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >


      <div class="card">
        <div class="card-header">

            <h3 class="card-title">Messages</h3>
        
        </div>
        
        
        <div class="card-body">
          <div class="container">
            <div class="messaging">
              <div class="inbox_msg">
                <div class="inbox_people">
                  <div class="headind_srch">
        
        
                    <div class="recent_heading">
                      <h4>Recent</h4>
                    </div>
        
                    <div class="srch_bar">
                      <div class="stylish-input-group">
                        <input type="text" class="search-bar"  placeholder="Search" disabled>
                        <span class="input-group-addon">
                        <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                        </span> </div>
                    </div>
        
        
                  </div>
                  <div class="inbox_chat">
                    <?php 
                        $count = 0;
                        foreach($messages as $message):
                            $count++; 
                    ?>
                    <?php if($count % 2): ?>
        
        
                        <div class="chat_list chat-<?php echo $message['message']['message_token']?>">
        
        
                            <div class="chat_people" id="delete_chat_people">
                                <div class="chat_img" 
                                      id="<?php echo $message['message']['message_token']?>"> 
                                  <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> 
                                </div>
        
        
                                <div class="chat_ib">
                                    <h5>
                                        <?php echo $message['user']['name'] ?> 
                                        <span class="chat_date"> 
                                          <?php echo $message['message']['created'] ?>
                                        </span>
                                    </h5>
        
                                    <p class="message_list" 
                                      onclick="viewMessage('<?php echo $message['message']['message_token'] ?>', 
                                                            '<?php echo $message['contact']['id'] ?>')">
                                                    <?php echo $message['message']['message'] ?>
                                    </p>
        
                                    <span class="chat_delete" 
                                          onclick="deleteChat('<?php echo $message['message']['message_token'] ?>')">
                                          <i class="fa fa-trash"></i>
                                    </span>
                                    
                                </div>
        
        
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="chat_list chat-<?php echo $message['message']['message_token']?>">

                            <div class="chat_people" id="delete_chat_people">
                                
                                
                                <div class="chat_img" 
                                      id="<?php echo $message['message']['message_token']?>"> 
                                      <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> 
                                
                                </div>
                                
                                <div class="chat_ib">
                                    <h5>
                                        <?php echo $message['user']['name'] ?>  
                                      
                                        <span class="chat_date"> 
                                          <?php echo $message['message']['created'] ?>
                                        </span>
                                    </h5>
                                    
                                    <p class="message_list" 
                                      onclick="viewMessage('<?php echo $message['message']['message_token'] ?>', '<?php echo $message['contact']['id']?>')">
                                      <?php echo $message['message']['message'] ?>
                                    
                                    
                                    </p>
                                    <span class="chat_delete" 
                                          onclick="deleteChat('<?php echo $message['message']['message_token'] ?>')">
                                      <i class="fa fa-trash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>

                    <?php endforeach ?>
                    <div class="col-md-12" style="margin-left:100px;">
                    <?php 
                      if ($this->Paginator->hasNext() || $this->Paginator->hasPrev()) {
                        echo $this->Paginator->prev( __('Show Less | ', true), array(), null, array('class'=>'disabled'));
                        echo $this->Paginator->next(__( 'Show More', true), array(), null, array('class' => 'disabled'));
                      }
                    ?>
                    </div>
                  </div>
                </div>
                <div class="mesgs">
                  <div class="msg_history">
                    
                  </div>

                  
                  <div class="type_msg">
                    <div class="input_msg_write">
                      <input type="text" 
                              class="write_msg" 
                              id="write_msg" 
                              placeholder="Type a message" 
                              disabled/>
                      <button class="msg_send_btn" 
                              id="reply_btn" 
                              type="button" disabled>
                              <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>      
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function viewMessage(token, contact_id) {

  if(!token) {
    return;
  }
    // add onclick function in reply btn
    document.getElementById('reply_btn').onclick = function() {
      reply(token, contact_id);
    };

    $('#write_msg').removeAttr('disabled');
    $('#reply_btn').removeAttr('disabled');

    // set active div
    $(".chat-"+token).addClass("active_chat").siblings().removeClass("active_chat");
    var base_url = window.location.origin;
    
    $.ajax({
    url: base_url+'/messageboard/messages/fetch/'+token,
    cache: false,
    type: 'GET',
    dataType: 'HTML',
    success: function (messages) {
        $('.msg_history').html(messages);
        $(".msg_history").animate({ 
        scrollTop: $( 
          'html, body').get(0).scrollHeight 
        }, 2000); 
    }
  });
} 

function reply(token, contact_id) {
  var message = document.getElementById('write_msg').value;

  if(!message) {
    return;
  }

  $.ajax({
      dataType: "html",
      type: "POST",
      evalScripts: true,
      url: '<?php echo Router::url(array('controller'=>'Messages','action'=>'reply'));?>',
      data: ({token: token, contact_id: contact_id, message: message}),
      success: function (data, textStatus){
          $(".msg_history").html(data);
          $("#write_msg").val('');

          $(".msg_history").animate({ 
            scrollTop: $( 
              'html, body').get(0).scrollHeight 
          }, 2000); 

      }
  });
}

function deleteChat(token) {
  var result = confirm('Are you sure you want to delete this Conversation?');
  
  if(result) {

    $('#write_msg').attr("disabled", "disabled");
    $('#reply_btn').attr("disabled", "disabled");
    
    var base_url = window.location.origin;
    
    $.ajax({
    url: base_url+'/messageboard/messages/delete/'+token,
    cache: false,
    type: 'DELETE',
    dataType: 'HTML',
    success: function (messages) {
      console.log("messages", messages);
      $('.msg_history').html('');
      $('.chat-'+token).fadeOut();
      }
    });
  }
}

function deleteMessage(id) {
  var result = confirm('Are you sure you want to delete this message?');

  if(result) {
    var base_url = window.location.origin;
    
    $.ajax({
    url: base_url+'/messageboard/messages/deleteMessage/'+id,
    cache: false,
    type: 'DELETE',
    dataType: 'HTML',
    success: function (message) {
      console.log("message", message);
      $('#delete_msg-'+id).fadeOut();
      }
    });
  }
}

</script>
