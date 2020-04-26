<?php

class SignupController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }
    
    public function registerAction()
    {
        $user = new Pengguna();

        // Store and check for errors
        // $success = $user->save(
        //     $this->request->getPost(),
        //     [
        //         "nama",
        //         "nrp",
        //     ]
        // );
        if($this->request->isPost())
        {
            $dataSent = $this->request->getPost();

            $user = new Pengguna();
            $user->nama = $dataSent["nama"];
            $user->nrp = $dataSent["nrp"];
            $user->alamat = $dataSent["alamat"];
            $user->no_telp = $dataSent["no_telp"];
            $user->isAdmin = $dataSent["isAdmin"];

            $success = $user->save();
        }

        if ($success) {
            echo "Thanks you for signing up!";
        } else {
            echo "Oops, seems like the following issues were encountered: ";

            $messages = $user->getMessages();

            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

        $this->view->disable();
    }
}