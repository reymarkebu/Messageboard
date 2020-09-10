<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
		
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
	?>

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
	

	<?php
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
</head>
<body>
	<div id="container">
		<div id="header" style="background:#003d4c !important;">
			<?php
		
				if ($this->Session->read('Auth.User')) { ?>
					
					<div align="right">
					<?php echo $this->Html->link( "Logout ",   array('controller' => 'users', 'action'=>'logout') ); ?>	
					<label for=""> <h5 style="color: white"> | <?php echo $this->Session->read('Auth.User.name'); ?></h5>  </label>
					<?php
						echo $this->Html->image("https://ptetutorials.com/images/user-profile.png", [
							"alt" => "Profile",
							"width" => '40px',
							'url' => ['controller' => 'Users', 'action' => 'view',  $this->Session->read('Auth.User.id')]
						]);
					?>
	
					</div>
				<?php } else { ?>

					<div align="right">
						<?php echo $this->Html->link(__('login'), array('controller' => 'users', 'action' => 'login')); ?>
						|
						<?php echo $this->Html->link(__('Register'), array('controller' => 'users', 'action' => 'add')); ?>
					</div>
				<?php }
			?>
			
		</div>
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer" >
			
			<p>
				<?php //echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
