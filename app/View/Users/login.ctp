<?php echo $this->Html->css('custom.css'); ?>
<body id="LoginForm">
  <div class="container">
    <h1 class="form-heading">login Form</h1>
    <div class="login-form">
      <div class="main-div">
        <div class="panel">
          <h2>Login</h2>
          <p>Please enter your email and password</p>
        </div>

        <?php 
          echo $this->Session->flash('auth'); 
          echo $this->Form->create('User');
        ?>

        <div class="form-group" style='margin-bottom:none !important;padding:0 !important'>

          <?php echo $this->Form->input('email', array(
                  'class' => 'form-control',
                  'id' =>'inputEmail', 
                  'placeholder' => 'Email Address', 
                  'label' => false 
                  )
              ); 
          ?>   
        </div>

        <div class="form-group" style ='margin-bottom:none !important;padding:0 !important;'>

            <?php echo $this->Form->input('password', array(
                  'class' => 'form-control', 
                  
                  'id' => 'inputPassword', 
                  'placeholder' => 'Password',
                  'label' => false
                  )
              ); 
            ?>  

        </div>
              
        <?php 
            echo $this->Form->button('SUBMIT',['class'=>'btn btn-primary']);
            echo $this->Form->end(); 
        ?> 
      </idv>
    </div>
  </div>
</body>