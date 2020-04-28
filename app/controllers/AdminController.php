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

    public function editPcAction(int $id)
    {
        if ($this->session->isAdmin) {    
            $pc = Pc::findFirst(     // Nyari PC berdasar id_pc yang di-passing
                [
                    'conditions' => 'id_pc = :id:',
                    'bind'       => [
                        'id' => $id,
                    ],
                ]
            );
            if($pc->pc_lab == $this->session->isAdmin) {
                $this->view->setVars(
                    [
                        'id'        => $pc->id_pc,
                        'nama'      => $pc->nama_pc,
                        'ip'        => $pc->ip,
                        'hdd'       => $pc->hdd,
                        'ram'       => $pc->ram,
                        'processor' => $pc->processor,
                        'gpu'       => $pc->gpu,
                        'status'    => $pc->status_pc,
                    ]
                );
            } else {
                echo "This is not your PC, dude!";
                header("refresh:2;url=/admin/listPC");
            }
        }
        else {
            echo "Syapa kaw";
            header("refresh:2;url=/");
        }
    }
}

