<?php
declare(strict_types=1);

class PcController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function listAction(int $lab)
    {
        $pcs = Pc::find(     // Nyari user berdasar NRP yang diinput
            [
                'conditions' => 'pc_lab = :lab:',
                'bind'       => [
                    'lab' => $lab,
                ],
            ]
        );
        $this->view->pcs = $pcs;
    }

    public function tambahAction(int $lab)
    {
        $pc = new Pc();
        $dataSent = $this->request->getPost();

        $pc->nama_pc = $dataSent["nama"];
        $pc->ip = $dataSent["ip"];
        $pc->hdd = $dataSent["hdd"];
        $pc->ram = $dataSent["ram"];
        $pc->processor = $dataSent["processor"];
        $pc->gpu = $dataSent["gpu"];
        $pc->status_pc = $dataSent["status"];
        $pc->pc_lab = $lab;

        $success = $pc->save();
            

        if ($success) {
            echo "PC telah ditambahkan";
            header("refresh:2;url=/admin/listPC");
        } else {
            echo "Oops, penambahan PC gagal! Seems like the following issues were encountered: ";

            $messages = $user->getMessages();

            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }
    }
}

