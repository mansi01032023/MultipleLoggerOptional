<?php
// signup controller
use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function IndexAction()
    {
        // this is the default action of signup controller
    }
    public function registerAction()
    {
        $user = new Users();
        $post = $this->request->getPost();
        $values = array(
            'name' => $this->escaperfunction->sanitizeAction($post['name']),
            'email' => $this->escaperfunction->sanitizeAction($post['email']),
            'password' => $this->escaperfunction->sanitizeAction($post['password']),
        );
        $user->assign(
            $values,
            [
                'name',
                'email',
                'password'
            ]
        );
        $success = $user->save();

        $this->view->success = $success;

        if ($success) {
            if ($post['check'] == 'on') {
                $this->cookies->set("email", $post['email'], time() + 30 * 86400, '/');
                $this->cookies->set("password", $post['password'], time() + 30 * 86400, '/');
            }
            $this->view->message = "Register succesfully";
        } else {
            $this->view->message = "Not Register \
            succesfully due to following reason: <br>" . implode("<br>", $user->getMessages());
        }
    }
}
