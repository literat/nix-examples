<?php

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Permissions\Permission,
	Nix\Permissions\User,
	Nix\Permissions\IUserHandler,
	Nix\Permissions\Identity;

Debugger::init(true);
Debugger::setLogPath(__DIR__.'/temp/');

class UserHandler implements IUserHandler
{
	public function authenticate($username, $password)
	{
		return new Identity(6, 'admin', array(
			'name' => 'jan',
		));
	}

	public function updateIdentity($id)
	{
		return new Identity(6, 'member', array(
			'name' => 'new jan\'s name',
		));
	}
}

$acl = new Permission();
$acl->addResource('administration');
$acl->addRole('member');
$acl->addRole('admin');
$acl->allow('admin', 'administration');

$user = new User();
$user->setUserHandler('UserHandler');
$user->setAcl($acl);

if(isset($_GET['login'])) {
	$user->authenticate('test', 'test');
	header('location: index.php');
} elseif(isset($_GET['logout'])) {
	$user->signOut();
	header('location: index.php');
} elseif(isset($_GET['update'])) {
	$user->updateIndentity();
	header('location: index.php');
}

if($user->isAuthenticated()) {
	echo "logged as: " .$user->name;
	if($user->isAllowed('administration')) {
		echo "<br /> user has access to admin.";
		$user->test = 'I am admin.';
	} else {
		echo "<br /> user is just a member.";
	}

	if(isset($user->test)) {
		echo ' ' . $user->test;
	}
} else {
	echo "not logged";
}

echo "<br /><hr>
<a href='?login'>login</a>
<a href='?logout'>logout</a>
<a href='?update'>update</a>";