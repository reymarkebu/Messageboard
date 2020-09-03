<div class="users form">
    
    <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <legend><?php echo __('Add User'); ?></legend>


        <!-- diplay error message -->
        <?php
            $errors = '';
            foreach($this->validationErrors['User'] as $key => $val) {
                $errors .= $this->Html->tag('li', $val[0]); 
            }
            
            echo $this->Html->tag('ul', $errors);
        ?>
        <?php
            $this->Form->inputDefaults(array(
                'error' => false
              ));
        ?>

        <!-- input field -->
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

