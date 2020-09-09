
<div class="row">
    <div class="col-md-2">
        <nav class="large-3 medium-4 columns" id="actions-sidebar">
           
           
            <ul class="side-nav">
                <li>
                    <?php echo $this->Html->link('My Contacts', array('action' => 'index')); ?>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-md-10">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
            
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Contact</h3>
                </div>
                <div class="card-body">
                        
                    <div class="container">
                        <?php
                            echo $this->Form->create('Contact');

                            //diplay error message
                            $errors = '';
                            foreach($this->validationErrors['Contact'] as $key => $val) {
                                $errors .= $this->Html->tag('li', $val[0]); 
                            }
                            
                            echo $this->Html->tag('ul', $errors);

                            $this->Form->inputDefaults(array(
                                'error' => false
                            ));
                        ?>
                        <div class="row form-group">
                            <div class=" col-md-4 col-lg-4 form-control">
                                <?php 
                                    echo $this->Form->input('email', ['class' => 'form-control']);
                                    echo $this->Form->button('SUBMIT',['class'=>'btn btn-primary']);
                                    echo $this->Form->end(); 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


