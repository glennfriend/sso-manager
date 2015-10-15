<?php

class MeController extends ControllerBase
{

    public function initialize()
    {
        MenuManager::setMainKey('about-me');
        $this->user = UserManager::getUser();
    }

    public function indexAction()
    {
        MenuManager::setSubKey('about-myself');

        $password    = InputBrg::get('password');
        $password2   = InputBrg::get('password2');
        $oldPassword = InputBrg::get('oldPassword');
        $view        = 'password';

        // update password only
        if ( InputBrg::isPost() ) {

            if ( strlen($password) < 6 ) {
                FormMessageManager::addFieldMessage(array('password'=>'新的密碼必須在 6 個字元以上'));
                FormMessageManager::addErrorResultMessage('新的密碼錯誤');
                $this->render($view);
                return true;
            }
            if ($password !== $password2) {
                FormMessageManager::addFieldMessage(array('password' =>'請重新輸入'));
                FormMessageManager::addFieldMessage(array('password2'=>'請重新輸入'));
                FormMessageManager::addErrorResultMessage('您輸入的兩組新密碼並不相同, 請重新輸入');
                $this->render($view);
                return true;
            }

            $user = $this->user;
            if ( !$user->validatePassword($oldPassword) ) {
                FormMessageManager::addFieldMessage(array('oldPassword'=>'請重新輸入'));
                FormMessageManager::addErrorResultMessage('舊密碼輸入錯誤');
                $this->render($view);
                return true;
            }

            $user->setPassword( $password );
            $user->filter();

            if ( $fieldMessages = $user->validate() ) {
                FormMessageManager::setFieldMessages( $fieldMessages );
                FormMessageManager::addErrorResultMessage();
            }
            else {
                $users = new Users();
                $users->updateUser($user);
                FormMessageManager::addSuccessResultMessage('修改成功');
                $this->redirect('me');
            }

        } // if

        $this->view->setVars(Array(
            'user' => $this->user,
        ));
    }

    /**
     *  修改密碼
     */
    public function passwordAction()
    {
        MenuManager::setSubKey('modify-password');

        $password    = InputBrg::get('password');
        $password2   = InputBrg::get('password2');
        $oldPassword = InputBrg::get('oldPassword');
        $view        = 'password';

        $this->view->setVars(Array(
            'user' => $this->user,
        ));

        // update password only
        if ( InputBrg::isPost() ) {

            if ( strlen($password) < 6 ) {
                FormMessageManager::addFieldMessage(array('password'=>'新的密碼必須在 6 個字元以上'));
                FormMessageManager::addErrorResultMessage('新的密碼錯誤');
                return;
            }
            if ($password !== $password2) {
                FormMessageManager::addFieldMessage(array('password' =>'請重新輸入'));
                FormMessageManager::addFieldMessage(array('password2'=>'請重新輸入'));
                FormMessageManager::addErrorResultMessage('您輸入的兩組新密碼並不相同, 請重新輸入');
                return;
            }

            $user = $this->user;
            if ( !$user->validatePassword($oldPassword) ) {
                FormMessageManager::addFieldMessage(array('oldPassword'=>'請重新輸入'));
                FormMessageManager::addErrorResultMessage('舊密碼輸入錯誤');
                return;
            }

            $user->setPassword( $password );
            $user->filter();

            if ( $fieldMessages = $user->validate() ) {
                FormMessageManager::setFieldMessages( $fieldMessages );
                FormMessageManager::addErrorResultMessage();
            }
            else {
                $users = new Users();
                $users->updateUser($user);
                UserLogHelper::addChangePassword();
                FormMessageManager::addSuccessResultMessage('修改成功');
                $this->redirect('me');
                return;
            }

        }

    }

    /**
     *
     */
    public function logsAction()
    {
        MenuManager::setSubKey('show-logs');
        $page   = (int) InputBrg::get('page');
        $actions = InputBrg::get('actions');

        $allActions = [
            ['All',             null                            ],
            ['Log in + out',    'login-success,logout-success'  ],
            ['Log In Fail',     'login-fail'                    ],
            ['Password Change', 'password-update'               ],
        ];

        $options = array_filter(array(
            'userId'    => UserManager::getUser()->getId(),
          //'actions'   => ( isset($action) ? $action : null ),
            'actions'   => $actions,
            '_page'     => $page
        ));
        $userLogs   = new UserLogs();
        $myUserLogs = $userLogs->findUserLogs( $options );
        $rowCount   = $userLogs->numFindUserLogs( $options );

        $pageLimit = new PageLimit();
        $pageLimit->setBaseUrl('me');  // 請使用完整的 mca 命名
        $pageLimit->setRowCount( $rowCount );
        $pageLimit->setPage( $page );
        $pageLimit->setparams([
            'actions' => $actions,
        ]);

        $this->view->setVars(array(
            'userLogs'  => $myUserLogs,
            'pageLimit' => $pageLimit,
            'actionsKey' => $actions,
            'allActions' => $allActions,
        ));
    }

    /**
     *  change user current album
     */
    public function changeEnvironmentAction()
    {
        $isDeveloper = InputBrg::get('isDeveloper');
        if ($isDeveloper) {
            UserManager::setDebugMode(true);
        }
        else {
            UserManager::setDebugMode(false);
        }
        $this->redirect('me');
    }

}
