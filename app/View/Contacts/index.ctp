
<div class="row">
    <div class="col-md-2">
        <nav class="large-3 medium-4 columns" id="actions-sidebar">
            <ul class="side-nav">
                <li>
                    <?php echo $this->Html->link('Create New Contact', array('action' => 'add')); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Messages', array('controller'=> 'messages', 'action' => 'index')) ?>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-md-10">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact List</h3>
                </div>
                <div class="card-body">
                    <div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php 
                                    if (count($contacts) > 0):
                                    foreach($contacts as $contact): 
                                        
                                ?>
                                <tr>
                                    <td><?php echo $contact['User']['name'] ?></td>
                                    <td><?php echo $contact['Contact']['email'] ?></td>
                                    <td>
                                        <?php echo $this->html->Link("View Profile", array(
                                                'controller' => 'Contacts', 
                                                'action' => 'viewProfile', 
                                                $contact['Contact']['id']
                                                )
                                            ) 
                                        ?>
                                        |

                                        <?php echo $this->Form->postLink(
                                                'Delete',
                                                array('action' => 'delete', $contact['Contact']['id']),
                                                array('confirm' => 'Are you sure you want to delete this record?')
                                            );
                                        ?> 
                                    </td>
                                </tr>
                                <?php unset($contact); ?>
                                <?php 
                                    endforeach; 
                                    else :
                                        echo "<tr><td colspan='3'>No Data Found.</td></tr>";

                                    endif;
                                    
                                
                                
                                ?>
                            </tbody>
                        </table>

                        <?php
                            if ($this->Paginator->hasNext() || $this->Paginator->hasPrev()) {
                                echo $this->Paginator->prev('<< ' . __('previous | ', true), array(), null, array('class'=>'disabled'));
                                echo $this->Paginator->numbers(array(   'class' => 'numbers '     ));
                                echo $this->Paginator->next(__( ' next', true) . ' >>', array(), null, array('class' => 'disabled'));
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>