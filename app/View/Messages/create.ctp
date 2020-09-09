<header>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</header>

<div class="row">
    
    <div class="col-md-2">
        <nav class="large-3 medium-4 columns" id="actions-sidebar">
    
    
            <ul class="side-nav">
                <li>
                    <?php echo $this->Html->link('Messages', array('action' => 'index')); ?>
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
                    <h3 class="card-title">Create Message</h3>
                </div>
                <div class="card-body">
    
                    <?php echo $this->Form->create('Message') ?>
                        <?php 
                            echo $this->Form->input('message_token', array('type' => 'hidden'));
                        ?>
    
    
                      <div class="row form-group">
                        <div class="col-md-6 col-lg-6 form-control">
                          <?php
                            
                            echo $this->Form->input('contact_id', array(
                                'class' => 'form-control js-example-basic-single',
                                'options' => $contacts,
                                'label' => 'Send To'
                            ));
                          ?>

                          <div class="form-group">
                            <?php echo $this->Form->input('message', array(
                                'type'      => 'textarea',
                                'class'     => 'form-control counted',
                                'placeholder' => 'Type in your message',
                                'rows'      => '5',
                                'style'     => 'margin-bottom:10px;'
                                )
                              ); 
                            ?>
                            <?php  echo $this->Form->button('Post New Message',['class'=>'btn btn-info', 'type' => 'submit']); ?>
                            <?php echo $this->Form->end(); ?>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
