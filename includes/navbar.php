<header class="main-header" style="position: fixed;width: 100%;">
  <nav class="navbar navbar-static-top" style="background-color: <?php echo NAVBAR_COLOR; ?>">
    <div class="container">
      <div class="navbar-header">
        <a href="./" class="navbar-brand"><?php echo NAVBAR_BRAND ?></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php">HOME</a></li>
          <li><a href="">ABOUT US</a></li>
          <li><a href="">CONTACT US</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CATEGORY <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php
                 
                $stmt = Category::fetch_category();
              
                  foreach($stmt as $row){
                    echo "
                      <li><a href='category.php?category=".$row->cat_slug."'>".$row->name."</a></li>
                    ";                  
                  }
                  if (count($stmt) < 1) {
                    echo "No Category is Available at the moment";
                  }
               
                

              ?>
            </ul>
          </li>
        </ul>
        <form method="POST" class="navbar-form navbar-left" action="search.php">
          <div class="input-group">
              <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" required>
              <span class="input-group-btn" id="searchBtn" style="display:none;">
                  <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i> </button>
              </span>
          </div>
        </form>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-shopping-cart"></i>
              <span class="label label-success cart_count"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="cart_count"></span> item(s) in cart</li>
              <li>
                <ul class="menu" id="cart_menu">
                </ul>
              </li>
              <li class="footer"><a href="cart_view.php">Go to Cart</a></li>
            </ul>
          </li>
          <?php
            if(isset($_SESSION['user']) or isset($_SESSION['admin']) ){
              $image = (!empty($user['photo'])) ? 'images/users/'.$user['photo'] : 'images/users/profile.jpg';
              echo '
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="'.$image.'" class="user-image" alt="User Image">
                    <span class="hidden-xs">'.@$user['firstname'].' '.@$user['lastname'].'</span><span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="'.$image.'" class="img-circle" alt="User Image">

                      <p>
                        '.@$user['firstname'].' '.@$user['lastname'].'
                        <small>Member since '.date('M. Y', strtotime(@$user['created_on'])).'</small>
                      </p>
                    </li>';
                  echo '<li class="user-footer">';
                  if (Admin::Auth()->id == 1) {
                    echo '<div class="pull-left">
                        <a href="admin/" class="btn btn-default btn-flat">Dashboard</a>
                      </div>';
                  }else{
                    echo '
                      <div class="pull-left">
                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                      </div>';
                      }

                      echo '
                      
                      <div class="pull-right">
                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              ';
            }
            else{
              echo "
                <li><a href='login.php'>LOGIN</a></li>
                <li><a href='signup.php'>SIGNUP</a></li>
              ";
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>