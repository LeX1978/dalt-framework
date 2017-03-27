<?php

namespace backend\controllers;

use backend\system\BackendController;
use framework\adapter\Eloquent;
use common\models\User;
use framework\libraries\Pagination;

class UserController extends BackendController 
{
    
    /**
     *
     * @var User
     */
    public $users;
    
    public function __construct() 
    {
        parent::__construct();
    }       

    public function indexAction() 
    {
        $this->view->set([
            'title' => 'Users',
        ]);  

        $this->users = User::orderBy('login', 'ASC')->get();
        
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;        
        $pagination = new Pagination();
        $this->pages = $pagination->setCurrentPage($page)
                ->setRecordsCount(200)
                ->setPerPageLimit(10)
                ->setMaxPageCount(8)
                ->getPages();        
        
        $this->view->render('index');
    }
    
}
