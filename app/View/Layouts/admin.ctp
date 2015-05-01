<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
	echo $this->Html->meta('icon');

	echo $this->Html->script('lib/jquery/jquery-1.11.2.min');
	echo $this->Html->script('lib/bootstrap-3.3.4-dist/js/bootstrap.min');
	echo $this->Html->script('lib/react-0.13.1/build/react');
	echo $this->Html->script('lib/react-0.13.1/build/JSXTransformer');
	echo $this->Html->script('lib/react-router/ReactRouter.min');

	?>
	<script type="text/jsx" src="/js/app/blogPosts.js"></script>
	<script type="text/jsx" src="/js/app/app.js"></script>

	<link rel="stylesheet" type="text/css" href="/js/lib/bootstrap-3.3.4-dist/css/bootstrap.min.css" >
	<?php
	echo $this->Html->css('app/app');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	?>
	<script type="text/javascript">
		var data = {
			'Posts': [
				{id: 1, title: "Pete Hunt", content: "This is one comment", date: "01/05/2015"},
				{id: 2, title: "Jordan Walke", content: "This is *another* comment", date: "02/02/02"}
			]
		};
	</script>
</head>
<body>
<div class="container-fluid" id="content-container">

</div>

<?php echo $this->Session->flash(); ?>

<?php echo $this->fetch('content'); ?>

<?php echo $this->element('sql_dump'); ?>
</body>
</html>
