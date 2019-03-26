<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Brands;

class UsersController extends Controller {

	private $user;
	private $arrayInfo;

	public function __construct() {
		$this->user = new Users();

		if(!$this->user->isLogged()) {
			header("Location: ".BASE_URL."login");
			exit;
		}

		if(!$this->user->hasPermission('users_view')) {
			header("Location: ".BASE_URL);
			exit;
		}

		$this->arrayInfo = array(
			'user' => $this->user,
			'menuActive' => 'users'
		);		

	}

	public function index() {
		$users = new Users();

		$this->arrayInfo['list'] = $users->getAll();

		$this->loadTemplate('users', $this->arrayInfo);
    }

}