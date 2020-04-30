<?php
declare(strict_types=1);

class PermohonanRuanganController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function listprAction(int $lab)
    {
        if($this->session->has('nama_user'))
        {
            $prs = PermohonanRuangan::find(     // 
                [
                    'conditions' => 'id_lab = :lab:',
                    'bind'       => [
                        'lab' => $lab,
                    ],
                ]
            );
            $infolab = Laboratorium::findFirst(
                [
                    'conditions'    => 'id_lab = :lab:',
                    'bind'          => [
                        'lab' => $lab,
                    ],
                    'columns'       => 'nama_lab'
                ]
            );
            $this->view->prs = $prs;
            $this->view->namalab = $infolab->nama_lab;
        }
    }
}

