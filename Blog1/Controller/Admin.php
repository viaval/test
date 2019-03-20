<?php


namespace TestProject\Controller;

class Admin extends Blog
{
    public function login()
    {
        if ($this->isLogged()) {
            header('Location: ' . ROOT_URL . '?p=blog&a=all');
        }
        if (isset($_POST['email'], $_POST['password']))
        {
            $this->oUtil->getModel('Admin');
            $this->oModel = new \TestProject\Model\Admin;

            $sHashPassword =  $this->oModel->login($_POST['email']);
            if (password_verify($_POST['password'], $sHashPassword))
            {
                $_SESSION['is_logged'] = 1; // Admin is logged now
                header('Location: ' . ROOT_URL . '?p=blog&a=all');
                exit;
            }
            else
            {
                $this->oUtil->sErrMsg = 'Incorrect Login!';
            }
        }
        $this->oUtil->getView('login');
    }
    public function logout()
    {
        if (!$this->isLogged()) {
            exit;
        }
        if (!empty($_SESSION))
        {
            $_SESSION = array();
            session_unset();
            session_destroy();
        }
        
        header('Location: ' . ROOT_URL);
        exit;
    }
}
