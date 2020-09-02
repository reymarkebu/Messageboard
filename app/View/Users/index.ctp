<!-- <div class="users form">
    <fieldset>
        <legend><?php echo __('Users'); ?></legend>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo h($user['User']['name']) ?></td>
                    <td><?php echo h($user['User']['email']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
<div> -->
<?php 
// if($this->Session->check('Auth.User')){
// echo $this->Html->link( "Return to Users",   array('action'=>'index') ); 
// echo "<br>";
// echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
// }else{
// echo $this->Html->link( "Return to Login Screen",   array('action'=>'login') ); 
// }
?>

<div class="users form">
<h1>Users</h1>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('email', 'E-Mail');?></th>
            <th><?php echo $this->Paginator->sort('created', 'Created');?></th>
            <th><?php echo $this->Paginator->sort('modified','Last Update');?></th>
            <th><?php echo $this->Paginator->sort('status','Status');?></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>                       
        <?php $count=0; ?>
        <?php foreach($users as $user): ?>                
            <?php $count ++;?>
            <?php if($count % 2): 
                echo '<tr>'; else: echo '<tr class="zebra">' 
            ?>
            <?php endif; ?>
            
            <td style="text-align: center;"><?php echo $user['User']['email']; ?></td>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['modified']); ?></td>
            <td style="text-align: center;"><?php echo $user['User']['status']; ?></td>
            <td >
                <?php echo $this->Html->link(    "Edit",   array('action'=>'edit', $user['User']['id']) ); ?> | 
                <?php
                    if( $user['User']['status'] != 0){ 
                        echo $this->Html->link(    "Delete", array('action'=>'delete', $user['User']['id']));
                    }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php unset($user); ?>
    </tbody>
</table>
    <?php echo $this->Paginator->prev('<< ' . __('previous | ', true), array(), null, array('class'=>'disabled'));?>
    <?php echo $this->Paginator->numbers(array(   'class' => 'numbers '     ));?>
    <?php echo $this->Paginator->next(__( ' next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>
<?php 
    echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
?>
