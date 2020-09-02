<div class="users form">
    <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <legend><?php echo __('Add User'); ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('password_confirm', array(
                'label' => 'Confirm Password', 
                'maxLength' => 255, 
                'title' => 'Confirm password', 
                'type'=>'password')
            );
        ?>
        </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php 
    if ($this->Session->check('Auth.User')) {
        echo $this->Html->link( "Return to Users",   array('action'=>'index') ); 
        echo "<br>";
        echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
    } else {
        echo $this->Html->link( "Return to Login Screen",   array('action'=>'login') ); 
    }
?>
