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

    public function reservelAction()
    {
        if($this->session->has('nama_user'))
        {
            $dataSent = $this->request->getPost();

            $pr = new PermohonanRuangan();
            $pr->id_user = $this->session->user_id;
            $pr->id_lab = $dataSent["lab"];
            $pr->tanggal = $dataSent["tanggal"];
            $pr->keperluan = $dataSent["keperluan"];
            $pr->tanggal = $dataSent["waktu"];
            $pr->status = "Menunggu persetujuan admin";

            $success = $pr->save();

            if ($success) {
                $this->response->redirect('/mahasiswa/jadwalpemakaianruangan');
            } else {
                echo "Oops, tambah permohonan peminjaman ruangan gagal! Seems like the following issues were encountered: ";

                $messages = $pr->getMessages();

                foreach ($messages as $message) {
                    echo $message->getMessage(), "<br/>";
                }
            }
        }
    }
}

