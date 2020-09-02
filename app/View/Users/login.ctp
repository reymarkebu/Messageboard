<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<fieldset>
    <legend>
        <?php echo __('Please enter your Email and Password'); ?>
    </legend>
    <?php echo $this->Form->input('email');
    echo $this->Form->input('password');
    ?>
</fieldset>
<?php echo $this->Form->end(__('Login')); ?> 
<?php echo $this->Html->link(__('Register'), array('action' => 'add')); ?>
</div>