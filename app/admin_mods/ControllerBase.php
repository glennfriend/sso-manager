<?php

class ControllerBase extends Phalcon\Mvc\Controller
{

    protected function initialize()
    {
        RegisterManager::set('title','Gear Admin');

        $this->assets
            ->addJs('assets/jquery/jquery.js')
            ->addJs('assets/bootstrap/js/bootstrap.js')
            ->addJs('dist/phpjs/phpjs.js')
            ->addJs('dist/aid/aid.effect.js')
            ->addJs('dist/aid/aid.event.js')
            ->addJs('dist/aid/aid.ui.js')
            ->addJs('dist/app.js');

        $this->assets
            ->addCss('assets/bootstrap/css/bootstrap.css')
//          ->addCss('assets/font-awesome/css/font-awesome.css')
            ->addCss('dist/custom_with_famfamfam_icons/fam-icons.css');

        logBrg::backend( $this->dispatcher->getControllerName(), $this->dispatcher->getActionName() );
    }

    /**
     *
     */
    protected function beforeExecuteRoute()
    {
        if ( !UserIdentity::isLogin() ) {
            $this->redirect('');
            return false;
        }
    }

    /**
     *
     */
    // public function afterExecuteRoute($dispatcher)
    // {
    //     
    // }

    /**
     *  forword
     *  不會改變網址
     */
    protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        return $this->dispatcher->forward(
            array(
                'controller' => $uriParts[0], 
                'action'     => $uriParts[1]
            )
        );
    }

    /**
     *  recirect to main page
     *  會改變網址
     */
    protected function redirectMainPage()
    {
        $this->view->disable();
        $this->redirect('');
    }

    /**
     *  recirect to main page
     *  會改變網址
     */
    protected function redirect( $route, $params=array() )
    {

        // 有參數的情況, route 要做一些調整
        // 由於 response 沒有吃參數, 所以要自己組好
        if ( $params ) {
            $baseUri = $this->url->getBaseUri();
            $this->url->setBaseUri('');
            $route = $this->url->get( $route, $params );
            $this->url->setBaseUri( $baseUri );
        }

        // 重定向不會禁用視圖組件。因此視圖將正常顯示。你可以使用 $this->view->disable() 禁用視圖輸出。
        $this->view->disable();
        $this->response->redirect( $route );
        return;
    }

}
