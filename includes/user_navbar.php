<nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute" style="margin-top: 20px;">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end mr-3" id="navigation">
            <form>
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control black-placeholder" placeholder="Search..."
                        style="color: black;">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="now-ui-icons ui-1_zoom-bold" style="color: black;"></i>
                        </div>
                    </div>
                </div>
            </form>
            <?php
                if ($current_page == 'User dashboard') {
                    echo '<ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="user_profile.php">
                                    <i class="now-ui-icons users_single-02" style="color: black;"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block" style="color: black;">Account</span>
                                    </p>
                                </a>
                            </li>
                        </ul>';
                }
            ?>
        </div>
    </div>
</nav>