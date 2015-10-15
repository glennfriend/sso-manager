<?php
    $logoutUri  = url('public/logout');
    $userUri    = url('me');
    $user       = UserManager::getUser();
    $userName   = $user->getAccount();
?>
<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:;"><?php echo ucfirst(Config::get('app.name')); ?></a>
        </div>
        <div class="navbar-collapse collapse">

            <ul class="nav navbar-nav">
                <!--
                    <li class="active">Home</li>
                    <li><a href="">Home</a></li>
                -->
                <?php
                    foreach( MenuManager::getAllMenu() as $menu ) {
                        $key    = $menu['main']['key'];
                        $label  = $menu['main']['label'];
                        $link   = $menu['main']['link'];
                        $role   = $menu['main']['role'];

                        if ( !$user->hasPermission( array($role) ) ) {
                            continue;
                        }

                        if ( $key === MenuManager::getMainKey() ) {
                            echo '<li class="active"><a href="'. $link .'">'. $label .'</a></li>';
                        }
                        else {
                            echo '<li><a href="'. $link .'">'. $label .'</a></li>';
                        }
                    }
                ?>
            </ul>

            <ul class="nav navbar-nav pull-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <b class="caret"></b></a>
                    <ul class="dropdown-menu"><li class="dropdown-header">User</li>
                        <li><a href="<?php echo $userUri; ?>"><?php echo $userName;?></a></li>
                        <li class="dropdown-header">Status</li>
                        <li><a href="<?php echo $logoutUri;?>">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</div>
