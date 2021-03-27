

<header class="admin-header">
    <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>
    <nav class=" ml-auto">
        <ul class="nav align-items-center m-r-30">
            <li class=nav-item>
                <div class="d-flex p-all-15  justify-content-between">
                    <a href="#!" class="nar-link"><i class="mdi mdi-24px mdi-chat"></i>
                        <!-- <span class="notification-counter"></span></a> -->
            </li>
            <li class="nav-item">
                <div class="dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
                        <span class="notification-counter"></span>
                    </a>
                    <div class="dropdown-menu notification-container dropdown-menu-right">
                        <div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
                            <a href="#!" class="mdi mdi-18px mdi-settings text-muted"></a>
                            <span class="h5 m-0">Notifications</span>
                            <a href="#!" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
                        </div>
                        <div class="notification-events bg-gray-300">
                            <div class="text-overline m-b-5">today</div>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body"> All systems operational.</div>
                                </div>
                            </a>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body"></i> File upload successful.</div>
                                </div>
                            </a>
                            <a href="#" class="d-block m-b-10">
                                <div class="card">
                                    <div class="card-body">
                                        </i> Your holiday has been denied
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            <?php if (!empty($_SESSION["current_user"]["username"])): ?>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-sm avatar-online">
                        <span class="avatar-title rounded-circle bg-dark">T</span>
                    </div>
                </a>
                <div class="dropdown-menu  dropdown-menu-right">
                    <a href="/user/profile.php" class="dropdown-item"> Profile</a>
                    <a href="/user/change-password.php" class="dropdown-item"> Reset Password</a>
                    <a class="dropdown-item" href=""> Help </a>
                    <div class="dropdown-divider"></div>
                    <a href="/user/logout.php" class="dropdown-item"> Logout</a>
                </div>
            </li>
            <div class="nav-item m-r-3">
                <a href="#">
                    <b><?=$_SESSION['current_user']['fullname']?></b> (<?=$_SESSION['current_user']['role']?>)
                </a>
            </div>
            <?php else: ?>
                <li class="nav-item m-r-3">
                    <a href="/account/login.php" class="btn btn-dark">Login</a>
                </li>
            <?php endif; ?>
        </ul>

    </nav>
</header>
