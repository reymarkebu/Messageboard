
<div class="row">
    <div class="col-md-2">
        <nav class="large-3 medium-4 columns" id="actions-sidebar">
            <ul class="side-nav">
                <?php 
                    if ($user['User']['id'] === $this->Session->read('Auth.User.id')): ?>
                    <li>
                        <?php echo $this->Html->link('Edit User', array('action' => 'edit', $user['User']['id'] )) ?>
                    </li>
                    <?php endif; ?>
                <li>
                    <?php echo $this->Html->link('My Contacts', array('controller'=> 'contacts', 'action' => 'index')) ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Messages', array('controller'=> 'messages', 'action' => 'index')) ?>
                </li>
            </ul>
        </nav>    
    </div>
    <div class="col-md-10">
        <div class="users large-9 medium-8 columns content">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo $user['User']['name'] ?></h3>
                        </div>
                        <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> 
                            <?php 

                                if (empty($user['User']['image'])) {
                                    echo $this->Html->image("user-avatar2.png", [
                                        "alt" => "Profile",
                                        "class" => "col-lg-12",
                                    ]);          
                                } else {
                                    echo $this->Html->image('uploads/users/'.$user['User']['image'], [
                                        "alt" => "Profile",
                                        "class" => "col-lg-12",
                                    ]);
                                }
                            
                            ?>
                            </div>
                            
                            <div class=" col-md-9 col-lg-9 "> 
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td><?php echo h($user['User']['name']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo h($user['User']['email']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td><?php echo h($user['User']['gender']) ?></td>
                                        </tr>
                                        <tr> 
                                            <td>Birhdate</td>
                                            <td><?php echo h($user['User']['birthdate']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Created</td>
                                            <td><?php echo h($user['User']['created']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Last Login</td>
                                            <td><?php echo h($user['User']['last_login_time']) ?></td>
                                        </tr> 
                                        <tr>
                                            <td>Status</td>
                                            <td><?php echo h($user['User']['status']) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Hubby</td>
                                            <td><?php echo h($user['User']['hubby']) ?></td>
                                        </tr>                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>




