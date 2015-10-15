<?php

/**
 *
 */
class UserLogHelper
{

    static private $virtualUserId = 0;

    /**
     *  login success
     */
    public static function addLogin($content=null)
    {
        return self::save('[login-success]', $content);
    }

    /**
     *  login fail
     */
    public static function addLoginFail($userAccount)
    {
        $users = new Users();
        $virtualUser = $users->getUserByAccount($userAccount);
        if (!$virtualUser) {
            // 登入錯誤時, 如果帳號本身不存在, 則不記錄該 log
            return;
        }
        self::$virtualUserId = $virtualUser->getId();

        $content = $_SERVER['HTTP_USER_AGENT'];
        return self::save('[login-fail]', $content, false);
    }

    /**
     *  logout
     */
    public static function addLogout($content=null)
    {
        return self::save('[logout-success]', $content);
    }

    /**
     *  change password
     */
    public static function addChangePassword($content=null)
    {
        return self::save('[password-update]', $content);
    }

    // --------------------------------------------------------------------------------
    // private
    // --------------------------------------------------------------------------------

    private static function save($actions, $content=null)
    {
        if (self::$virtualUserId > 0) {
            $userId = self::$virtualUserId;
        }
        else {
            $user = UserManager::getUser();
            if (!$user) {
                return;
            }
            $userId = $user->getId();
        }

        $ip  = Ydin\Client::getIp();
        $ipn = Ydin\Ip::ipToLong($ip);

        $userLog = new UserLog();
        $userLog->setUserId  ( $userId  );
        $userLog->setActions ( $actions );
        $userLog->setContent ( $content );
        $userLog->setIp      ( $ip      );
        $userLog->setIpn     ( $ipn     );

        $userLogs = new UserLogs();
        return $userLogs->addUSerLog($userLog);
    }

}
