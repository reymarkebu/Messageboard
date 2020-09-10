<?php echo $this->Html->css('custom.css'); ?>
<body id="registerForm">
  <div class="container">
    <h1 class="form-heading">Registration Form</h1>
    <div class="login-form">
      <div class="main-div col-md-8">
        <div class="panel">
          <h2>Register</h2>
        </div>
        <?php 
          echo $this->Session->flash('auth'); 
          echo $this->Form->create('User'); 

          $errors = '';
          foreach($this->validationErrors['User'] as $key => $val) {
              $errors .= $this->Html->tag('li', $val[0]); 
          }
          
          echo $this->Html->tag('ul', $errors);
          
          $this->Form->inputDefaults(array(
              'error' => false
          ));
        ?>
          
        <div style='margin-bottom:none !important;padding:0 !important'>
            <?php echo $this->Form->input('name', array(
                    'class' => 'form-control',
                    'placeholder' => 'Name', 
                    'label' => false 
                    )
                ); 
            ?>   
            <?php echo $this->Form->input('email', array(
                    'class' => 'form-control',
                    'placeholder' => 'Email Address', 
                    'label' => false 
                    )
                ); 
            ?>   
            <?php echo $this->Form->input('password', array(
                    'class' => 'form-control', 
                    'placeholder' => 'Password',
                    'label' => false
                    )
                ); ?>  
            <?php echo $this->Form->input('password_confirm', array(
                    'class' => 'form-control', 
                    'placeholder' => 'Confirm Password',
                    'type'=>'password',
                    'label' => false
                    )
                ); ?>  
        </div>
        
        <?php 
            echo $this->Form->button('SUBMIT',['class'=>'btn btn-primary']);
            echo $this->Form->end(); 
        ?> 
      </div>
    </div>
  </div>
</body>

