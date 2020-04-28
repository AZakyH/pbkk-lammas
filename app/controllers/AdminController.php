<?php
declare(strict_types=1);

class AdminController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function dashboardAction()
    {

    }

    public function listPcAction()
    {
        return $this->dispatcher->forward(array( 
        'controller' => 'pc',
        'action' => 'list',
        'params' => array($this->session->isAdmin)
        ));
    }

    public function tambahPcPageAction()
    {
        
    }

    public function tambahPcAction()
    {
        if($this->request->isPost()) {
            return $this->dispatcher->forward(array( 
            'controller' => 'pc',
            'action' => 'tambah',
            'params' => array($this->session->isAdmin)
            ));
        }
    }
}

