<?php echo $this->Html->css('custom.css'); ?>
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
                                        <?php echo $message[0]['name'] ?> 
                                        <span class="chat_date"> 
                                          <?php echo $message['message']['created'] ?>
                                        </span>
                                    </h5>
        
                                    <p class="message_list" 
                                      onclick="viewMessage('<?php echo $message['message']['message_token'] ?>')">
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
                                        <?php echo $message[0]['name'] ?>  
                                      
                                        <span class="chat_date"> 
                                          <?php echo $message['message']['created'] ?>
                                        </span>
                                    </h5>
                                    
                                    <p class="message_list" 
                                      onclick="viewMessage('<?php echo $message['message']['message_token'] ?>')">
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
function viewMessage(token) {

    if(!token) {
        return;
    }

    $('#reply_btn').on("click", function(){
        reply(token);
    });

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

function reply(token) {
    var message = document.getElementById('write_msg').value;

    if(!message) {
        return;
    }

    $("#write_msg").val('');
    $.ajax({
        dataType: "html",
        type: "POST",
        evalScripts: true,
        url: '<?php echo Router::url(array('controller'=>'Messages','action'=>'reply'));?>',
        data: ({token: token, message: message}),
        success: function (data, textStatus){
            $(".msg_history").html(data);
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
