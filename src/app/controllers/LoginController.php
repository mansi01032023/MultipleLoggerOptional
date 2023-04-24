<?php
// login controller
use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
        // this is the default action of login controller
    }
    public function loginAction()
    {
        $user = new Users();
        $post = $this->request->getPost();
        $check = Users::findFirst(array("email = ?0 and password
        = ?1", "bind" => array($post['email'], $post['password'])));
        if (
            $post['password'] == $check->password && $post['email'] == $check->email
            && $post['email'] != "" && $post['password'] != ""
        ) {
            $this->cookies->set("loggedin", "yes", time() + 30 * 86400, '/');
            $this->response->redirect("dashboard");
            $this->logger
                ->excludeAdapters(['failure'])
                ->info('Successful Login');
        } else {
            $this->logger
                ->excludeAdapters(['success'])
                ->info('Invalid email or password');
        }
        $this->response->setContent("Error 403 => Authentication Failed");
        $this->view->msg = $this->response->getContent();
    }

    public function logoutAction()
    {
        $this->cookies->set("loggedin", "yes", time() - 30 * 86400, '/');
        $this->cookies->set("email", $post['email'], time() - 30 * 86400, '/');
        $this->cookies->set("password", $post['password'], time() - 30 * 86400, '/');
        $this->response->redirect("login");
    }
}
