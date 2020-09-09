<style>
.form-heading { color:#fff; font-size:23px;}
.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
.login-form .form-control {
  background: #f7f7f7 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  border-radius: 4px;
  font-size: 14px;
  height: 50px;
  line-height: 50px;
}
.main-div {
  background: #ffffff none repeat scroll 0 0;
  border-radius: 2px;
  margin: 10px auto 30px;
  max-width: 50%;
  padding: 50px 70px 70px 71px;
}

.login-form .form-group {
  margin-bottom:10px;
}
.login-form{ text-align:center;}
.forgot a {
  color: #777777;
  font-size: 14px;
  text-decoration: underline;
}
.login-form  .btn.btn-primary {
  /* background: #f0ad4e none repeat scroll 0 0; */
  border-color: #f0ad4e;
  color: #ffffff;
  font-size: 14px;
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding: 0;
}
.forgot {
  text-align: left; margin-bottom:30px;
}
.botto-text {
  color: #ffffff;
  font-size: 14px;
  margin: auto;
}
.login-form .btn.btn-primary.reset {
  background: #ff9900 none repeat scroll 0 0;
}
.back { text-align: left; margin-top:10px;}
.back a {color: #444444; font-size: 13px;text-decoration: none;}
</style>
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