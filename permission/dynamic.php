<?php

# loader Nix libraries
require_once '../../src/Nix/loader.php';

use Nix\Debugging\Debugger,
	Nix\Permissions\Permission,
	Nix\Permissions\PermissionAssertion,
	Nix\Permissions\User,
	Nix\Permissions\IUserHandler,
	Nix\Permissions\Identity,
	Nix\Permissions\Resource;

Debugger::init(true);
Debugger::setLogPath(__DIR__.'/temp/');

class PostsResource extends Resource
{
	public $user_id;
	protected $name = 'posts';
}

class UserPostsAssertion extends PermissionAssertion
{
	public function assert(Permission $acl, $resource, $action)
	{
		echo '<pre>';
		var_dump($acl);
		var_dump($resource);
		var_dump($action);
		echo '</pre>';
	}
}

$acl = new Permission;
$acl->addRole('author', 'guest');
$acl->addResource('posts');

$acl->allow('guest', 'posts');
$acl->deny('guest', 'posts', 'edit');
$acl->allow('author', 'posts', 'edit', new UserPostsAssertion);

$posts = new PostsResource;
$posts->user_id = 1234;

echo "<br>allowed: " . ($acl->isAllowed('guest', 'posts', 'view') ? "allowed" : "denied");
echo "<br>allowed: " . ($acl->isAllowed('author', $posts, 'edit') ? "allowed" : "denied");
echo "<br>allowed: " . ($acl->isAllowed('author', $posts, 'view') ? "allowed" : "denied");