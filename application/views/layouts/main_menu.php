
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <?php
            if (($this->user_session['user_status']) == '1') {
                ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-wrench"></i>
                        <span>Setting</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/lookUp/createUser"><i class="fa fa-user"></i> User Setup</a></li>
                        <li><a href="#"><i class="fa fa-users"></i> User Authorisation</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/lookUp/createVariant"><i class="fa fa-leaf"></i> Show Categories</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/lookUp/showLookup"><i class="fa fa-leaf"></i> Show Groups</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-wrench"></i>
                        <span>Items Setup</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/setup/itemSetup"><i class="fa fa-list"></i>Item List</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-tree"></i>
                        <span>Goods receive</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/setup/goodsReceive"><i class="fa fa-list"></i>Goods Receive List</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-tree"></i>
                        <span>Issue Item</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url() ?>index.php/setup/distribution"><i class="fa fa-list"></i>Issue List</a></li>
                        <li><a href="<?php echo base_url() ?>index.php/setup/editIssueItemList"><i class="fa fa-list"></i>Edit Issue List</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-tree"></i>
                        <span>Distributed Item</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php foreach ($users as $value) { ?>
                            <li><a href="<?php echo base_url() ?>index.php/setup/distributedItem/<?php echo $value->id ?>"><i class="fa fa-list"></i><?php echo $value->fullName; ?></a></li>
                        <?php } ?>
                    </ul>
                </li>

                <?php
            }
            ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tree"></i>
                    <span>Received Item</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() ?>index.php/setup/receive"><i class="fa fa-list"></i>Received Item List</a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tree"></i>
                    <span>Consuming List</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url() ?>index.php/setup/consuming"><i class="fa fa-list"></i>Consuming List</a></li>
                </ul>
            </li>
            <!-- End here material management system-->

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>