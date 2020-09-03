<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<fieldset>
    <legend>
        <?php echo __('Please enter your Email and Password'); ?>
    </legend>
    <div class="form-group ">
    
        <?php echo $this->Form->input('email'); ?>   
        <?php echo $this->Form->input('password'); ?>  
        
    </div>
</fieldset>
<?php 
    echo $this->Form->button('Submit',['class'=>'btn btn-primary']);
    echo $this->Form->end(); ?> 

</div>