<?php
declare(strict_types=1);

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;

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
        $form = new Form();
        $form->add(new Text('nama'));
        $form->add(new Text('ip'));
        $form->add(new Text('hdd'));
        $form->add(new Text('ram'));
        $form->add(new Text('processor'));
        $form->add(new Text('gpu'));
        $form->add(new Text('status'));
        $this->view->form = $form;
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

    public function listReservasiPcAction()
    {
        return $this->dispatcher->forward(array( 
        'controller' => 'PermohonanPc',
        'action' => 'listppc',
        'params' => array($this->session->isAdmin)
        ));
    }

    public function detailreservasipcAction(int $id)
    {
        if ($this->session->isAdmin) {    
            $ppc = PermohonanPc::findFirst(     // Nyari PPC berdasar id_ppc yang di-passing
                [
                    'conditions' => 'id_ppc = :id:',
                    'bind'       => [
                        'id' => $id,
                    ],
                ]
            );
            $pemohon = Pengguna::findFirst(
                [
                    'conditions' => 'id_user = :uid:',
                    'bind'       => [
                        ':uid' => $ppc->id_user,
                    ],
                ]
            );
            $form = new Form();
            $form->add(new Select(
                'status',
                [
                    'Permohonan diterima' => 'Accept',
                    'Permohonan ditolak' => 'Deny',
                    'Permohonan selesai' => 'Already done',
                ],
                [
                    'useEmpty'   => true,
                    'emptyText'  => $ppc->status,
                ],
            ));
            
            if($ppc->lab == $this->session->isAdmin) {
                $this->view->setVars(
                    [
                        'tanggal'   => $ppc->tanggal,
                        'id'        => $ppc->id_ppc,
                        'nama'      => $pemohon->nama,
                        'nrp'       => $pemohon->nrp,
                        'no_telp'   => $pemohon->no_telp,
                        'alamat'    => $pemohon->alamat,
                        'jenis'     => $ppc->jenis,
                        'keperluan' => $ppc->keperluan,
                        'form'      => $form
                    ]
                );

            } else {
                echo "This is not your lab's permohonan PC, dude!";
                header("refresh:2;url=/admin/listReservasiPC");
            }
        }
        else {
            echo "Syapa kaw";
            header("refresh:2;url=/");
        }
    }

    public function detailreservasilabAction(int $id)
    {
        if ($this->session->isAdmin) {    
            $pr = PermohonanRuangan::findFirst(     // Nyari PPC berdasar id_ppc yang di-passing
                [
                    'conditions' => 'id_plab = :id:',
                    'bind'       => [
                        'id' => $id,
                    ],
                ]
            );
            $pemohon = Pengguna::findFirst(
                [
                    'conditions' => 'id_user = :uid:',
                    'bind'       => [
                        ':uid' => $pr->id_user,
                    ],
                ]
            );
            $form = new Form();
            $form->add(new Select(
                'status',
                [
                    'Permohonan diterima' => 'Accept',
                    'Permohonan ditolak' => 'Deny',
                    'Permohonan selesai' => 'Already done',
                ],
                [
                    'useEmpty'   => true,
                    'emptyText'  => $pr->status,
                ],
            ));
            
            if($pr->id_lab == $this->session->isAdmin) {
                $this->view->setVars(
                    [
                        'tanggal'   => $pr->tanggal,
                        'id'        => $pr->id_plab,
                        'nama'      => $pemohon->nama,
                        'nrp'       => $pemohon->nrp,
                        'no_telp'   => $pemohon->no_telp,
                        'alamat'    => $pemohon->alamat,
                        'keperluan' => $pr->keperluan,
                        'form'      => $form
                    ]
                );

            } else {
                echo "This is not your lab's permohonan reservasi lab, dude!";
                header("refresh:2;url=/admin/jadwalPemakaianRuangan/".$this->session->isAdmin);
            }
        }
        else {
            echo "Syapa kaw";
            header("refresh:2;url=/");
        }
    }
}

