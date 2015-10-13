<?php

class PublicController extends Phalcon\Mvc\Controller
{

    public function initialize()
    {
        // disabled layout, use action view
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);

        RegisterManager::set('title','Public Login');

        $this->assets
            ->addJs('assets/jquery/jquery.js')
            ->addJs('assets/bootstrap/js/bootstrap.js');

        $this->assets
            ->addCss('assets/bootstrap/css/bootstrap.css');

    }

    /**
     *  recirect to main page
     *  會改變網址
     */
    protected function redirect( $route )
    {
        $this->response->redirect( $route );
        // 重定向不會禁用視圖組件。因此視圖將正常顯示。你可以使用 $this->view->disable() 禁用視圖輸出。
        $this->view->disable();
        return;
    }

    /* --------------------------------------------------------------------------------
        
    -------------------------------------------------------------------------------- */

    public function indexAction()
    {
        $this->loginAction();
    }

    public function loginAction()
    {
        $userIdentity = new UserIdentity();
        if( $userIdentity->isLogin() ) {
            $this->redirect('dashboard');
            return;
        }

        $account  = trim(strip_tags( InputBrg::get('account') ));
        $password = InputBrg::get('password');

        if( InputBrg::isPost() ) {

            if( $userIdentity->authenticate( $account, $password ) ) {
                // 登入成功
                LogBrg::backendLogin("{$account} - login success");
                $this->redirect('dashboard');
                return;
            }
            else {
                // 帳號或密碼錯誤
                FormMessageManager::addErrorResultMessage('The password you entered is invalid. Check the field highlighted below and try again.');
                LogBrg::backendLogin("{$account} - login fail");
            }
        }

        $this->view->setVars(Array(
            'account' => $account,
        ));
    }

    /**
     *
     */
    public function logoutAction()
    {
        $user = UserManager::getUser();
        $account = $user->getAccount();
        UserIdentity::logout();
        LogBrg::backendLogin("{$account} - logout");
        $this->redirect('');
        return;
    }


}

?>