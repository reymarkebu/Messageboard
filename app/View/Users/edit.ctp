<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 100%;
}
</style>
<div class="row">
    <div class="col-md-2">
        <nav class="large-3 medium-4 columns" id="actions-sidebar">
            <ul class="side-nav">
                <li>
                    <?php echo $this->Html->link('View User', array('action' => 'view', $this->data['User']['id'] )) ?>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-md-10">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >

            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Profile</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        

                        <?php echo $this->Form->create('User',array('enctype'=>'multipart/form-data')); ?>
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
                        <div class="row form-group">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        
                                        <?php echo $this->Form->input('image', array('type'=>'file', 'id' => 'imgInp', 'label'=>false)); ?>
                                            <!-- <span class="btn btn-primary btn-file">
                                                
                                            Browse… <input type="file" id="imgInp" name="">        
                                                

                                            </span> -->
                                        </span>
                                        <!-- <input type="text" class="form-control" readonly> -->
                                    </div>
                                    <img id='img-upload' />
                                
                                    <div class="col-md-12" id="has-img-upload">
                                        <?php
                                            if (isset($this->data['User']['image'])) {  
                                                echo $this->Html->image('uploads/users/'.$this->data['User']['image'], [
                                                    "alt" => "Profile",
                                                    "class" => "col-lg-12",
                                                ]);
                                            } else {
                                                echo $this->Html->image('user-avatar2.png', [
                                                    "alt" => "Profile",
                                                    "class" => "col-lg-12",
                                                ]);
                                            }
                                        ?>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class=" col-md-4 col-lg-4 form-control">

                                <?php 
                                echo $this->Form->input('name', ['class' => 'form-control']);
                                echo $this->Form->input('email', ['class' => 'form-control']);
                                echo $this->Form->input('new_password', array( 
                                    'label' => 'New Password',
                                     'type'=> 'password',
                                     'class' => 'form-control'
                                    )
                                );
                                echo $this->Form->input('new_password_confirm', array(
                                    'label' => 'Confirm New Password',
                                     'type'=> 'password',
                                     'class' => 'form-control'
                                    )
                                );

                                $gender = array('1' => 'Male', '2' => 'Female');
                                echo $this->Form->input('gender', array(
                                    'class' => 'form-control',
                                    'options' => $gender,
                                ));
                                
                                ?>
                            </div>

                            <div class="col-md-4">
                                <?php
                                     echo $this->Form->input('birthdate', array(
                                        'class' => 'form-control',
                                         'id' => 'datepicker', 
                                         'type' => 'text', 
                                         'value' => $this->data['User']['birthdate']
                                        )
                                    );
                                    
                                     echo $this->Form->input('hubby', ['class' => 'form-control']);
                                ?>
                            </div> 
                            
                            <?php 
                                echo $this->Form->button('UPDATE',['class'=>'btn btn-primary']);
                                echo $this->Form->end(); 
                            ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
</div>
<script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format:"yyyy-mm-dd"

        });

        $(document).ready( function() {
    	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
                    $('#has-img-upload').hide();
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		}); 	
	});
    </script>


