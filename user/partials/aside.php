<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        <img class="admin-brand-logo">LOGO TEAM </img>
        <!-- end sidebar branding-->
        <div class="ml-auto">
            <!-- sidebar pin-->
            <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
            <!-- sidebar close for mobile device-->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <ul class="menu">
            <?php if (!$isLoggedIn) : ?>
                <li class="menu-item active ">
                    <a href="../account/login.php" class="menu-link">
                        <span class="menu-label">
                            <span class="menu-name">
                                Login
                            </span>
                        </span>
                        <span class="menu-icon">
                            <i class="icon-placeholder fe fe-activity "></i>
                        </span>
                    </a>
                </li>
            <?php else : ?>
                <?php if ($currentUser['role'] === "admin") : ?>
                    <li class="menu-item ">
                        <a href="#" class="open-dropdown menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Dashboard</span>
                            </span>
                            <span class="menu-icon"><i class="icon-placeholder fe fe-edit "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item active opened">
                        <a href="#" class="open-dropdown menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Manage System
                                    <span class="menu-arrow"></span> </span>
                            </span>
                            <span class="menu-icon">
                                <i class="mdi mdi-buffer mdi-24px "></i>
                            </span>
                        </a>
                        <!--submenu-->
                        <ul class="sub-menu" style="display: block;">
                            <li class="menu-item ">
                                <a href="../user/admin/manage_users.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Manage User</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-account-multiple mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../user/admin/manage_faculties.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Manage Faculty</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-briefcase mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../user/admin/manage_topics.php" class=" menu-link">
                                    <span class="menu-label">
                                        <span class="menu-name">Manage Topic</span>
                                    </span>
                                    <span class="menu-icon">
                                        <i class="mdi mdi-book-open-variant mdi-24px "></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php elseif ($currentUser['role'] === "student") : ?>
                    <li class="menu-item active ">
                        <a href="../user/student/index.php" class="menu-link">
                            <span class="menu-label">
                                <span class="menu-name">
                                    Home
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder fe fe-activity "></i>
                            </span>
                        </a>
                    </li>

                    <li class="menu-item ">
                        <a href="../user/student/view-all-topic.php" class="menu-link">
                            <span class="menu-label">
                                <span class="menu-name">My Topic
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder fe fe-folder"></i>
                            </span>
                        </a>
                    </li>
                <?php elseif ($currentUser['role'] === "manager-coordinator") : ?>
                    <li class="menu-item active ">
                        <a href="../user/index.php" class="menu-link">
                            <span class="menu-label">
                                <span class="menu-name">
                                    Home Page
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder fe fe-activity "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="../user/manage_coordinator/my_topic.php" class="menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Manager Topic
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder fe fe-folder"></i>
                            </span>
                        </a>
                    </li>
                <?php elseif ($currentUser['role'] === "manager-marketing") : ?>
                    <li class="menu-item active ">
                        <a href="../user/index.php" class="menu-link">
                            <span class="menu-label">
                                <span class="menu-name">
                                    Home Page
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder fe fe-activity "></i>
                            </span>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="../user/manager_marketing/manage_article.php" class="menu-link">
                            <span class="menu-label">
                                <span class="menu-name">Manage Article
                                </span>
                            </span>
                            <span class="menu-icon">
                                <i class="icon-placeholder fe fe-folder"></i>
                            </span>
                        </a>
                    </li>
                <?php endif ?>

            <?php endif; ?>
        </ul>
    </div>
</aside>