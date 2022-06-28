<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="margin-top:15px;">
      <div class="pull-left image">
        <img src="<?php echo (!empty($admin['photo'])) ? '../images/users/'.$admin['photo'] : '../images/users/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info" >
        <p><i class="fa fa-circle text-success"></i> <?php echo $admin['firstname'].' '.$admin['lastname']; ?></p>
        
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree" style="margin-top:15px">
      <li class="header">REPORTS</li>
      <li><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      
      <?php if (Admin::Auth()->type != 1): ?>
        <li><a href="cart.php?user=<?php echo Admin::Auth()->id ?>"><i class="fa fa-money"></i> <span>My Cart</span></a></li>
        
      <?php endif ?>
      <?php if (Admin::Auth()->type == 1): ?>
      <li class="header">MANAGE</li>
      <li><a href="users.php"><i class="fa fa-users"></i> <span>Users</span></a></li>
      
        <li class="treeview">
        <a href="#">
          <i class="fa fa-barcode"></i>
          <span>Products</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="products.php"><i class="fa fa-circle-o"></i> Product List</a></li>
          <li><a href="category.php"><i class="fa fa-circle-o"></i> Category</a></li>
        </ul>
      </li>
      <?php else: ?>
      <li><a href="products.php"><i class="fa fa-shopping-cart"></i><span>Add My Product For Sale</span></a></li>
      
      <?php endif ?>
      
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>