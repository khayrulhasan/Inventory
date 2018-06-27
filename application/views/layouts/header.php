<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inventory Management</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.4 -->
        <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!--Search Select-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>searchSelectAssets/css/select2-bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>searchSelectAssets/css/select2.css">
        <!--Search Select-->

        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!--        <link href="<?php echo base_url(); ?>assets/bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
        <!-- Theme style -->
        <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/dist/css/jquery-ui.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <!--<link href="admin_tempate/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />-->
        <!-- Morris chart -->
        <!--<link href="<?php echo base_url(); ?>assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />-->
        <!-- jvectormap -->
        <link href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css">

        <!--atiTreeList-master-->
        <link href="<?php echo base_url(); ?>atiTreeList-master/css/abixTreeList.css" rel="stylesheet" type="text/css" />
        <!--atiTreeList-master-->






        <!--=======================For Dynamic form builder css =============================================================--->
        <!--        <link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css">-->
        <!--        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>/form_assets/demo.css">
                 Only include on form edit page 
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>/form_assets/form-builder.css">
                 Only include on form render page 
                <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>/form_assets/form-render.css">-->

        <!--==================================================================================================================---->




        <!--  =====================================Multiple Image Upload Master CSS==============================================-->
        <!-- <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
         CSS to style the file input field as button and adjust the Bootstrap progress bars 
        <link rel="stylesheet" href="<?php echo base_url(); ?>multipleMaster/css/jquery.fileupload.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>multipleMaster/css/jquery.fileupload-ui.css">
         CSS adjustments for browsers with JavaScript disabled 
        <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>multipleMaster/css/jquery.fileupload-noscript.css"></noscript>
        <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>multipleMaster/css/jquery.fileupload-ui-noscript.css"></noscript>
          =====================================================================================================================-->





        <!--==============================================Jq Widgets===========================================================-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>jqwidgets/css/jqx.base.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>jqwidgets/css/jqx.arctic.css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>jqwidgets/css/jqx.apireference.css" media="screen" />
        <!--==============================================Jq Widgets===========================================================-->






        <!--======================================Smart select master========================================================-->
        <link href="<?php echo base_url(); ?>/smartselect-master-assete/smartselect.min.css" rel="stylesheet" />
        <!--======================================Smart select master========================================================-->




        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->



        <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>

        <style>
            .showcss{ display:block;}
            .hidecss{ display:none;}
            .ui-widget-content {
                border: 1px solid #aaaaaa;
                background: #ffffff url(images/ui-bg_flat_75_ffffff_40x100.png) 50% 50% repeat-x;
                color: #222222;
            }

            table.table-bordered tfoot td {
                border-top: 1px solid black
            }

            .imageComboBox {
                height: 35px; width: 35px;
                border-radius: 3px 3px 3px 3px;
                padding-right: 2px;
            }
            
            .modal-header {
                background: #286F98;
                color: #FFFFFF !important;
                font-weight: 900 !important;
                border-bottom: 2px solid #1EA9F9;
/*                text-shadow: 1px 1px black;*/
            }
            .close {
                color: #FFFFFF !important;
            }
            #printPdf {
                cursor: pointer
            }
        </style>



        <!-- ======================================================================================-->
        <!-- Combobox js       -->
        <script src="<?php echo base_url(); ?>comboboxAssets/bootstrap-combobox.js"></script>
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="<?php echo base_url(); ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>I</b>M</span> 
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg" style="font-size: 18px"><b>Inventory </b> Management</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->

                            <!-- Notifications: style can be found in dropdown.less -->

                            <!-- Tasks: style can be found in dropdown.less -->

                            <!-- User Account: style can be found in dropdown.less -->
                            <li><a href="<?php echo base_url(); ?>" target="bank"><?php echo $user; ?></a></li>
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="hidden-xs">Profile</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->


                                    <!-- Menu Footer-->
                                    <li class="user-footer">


                                        <small style="line-height: 35px"><?php echo $status; ?></small>

                                        <div class="pull-right">
                                            <a href="<?php echo base_url() ?>index.php/login/logout" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->


            <?php require_once 'main_menu.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $title; ?>
                    </h1>
                </section>
                <!--                Start Bredcum-->
                <section class="content">
                    <div class="container-fluid">    
                        <?php
                        if (isset($breadcrumb) && is_array($breadcrumb) && count($breadcrumb) > 0) {
                            ?>            
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="span10" style="margin-left:5px;">
                                        <div>
                                            <ul class="breadcrumb">
                                                <?php
                                                foreach ($breadcrumb as $key => $value) {
                                                    if ($value != '') {
                                                        ?>
                                                        <li><a href="<?php echo $value; ?>"><?php echo $key; ?></a> <span class="dropdown fa fa-arrow-right"></span></li>
                                                    <?php } else { ?>
                                                        <li class="active"><?php echo $key; ?></li>
                                                        <?php
                                                    }
                                                }
                                                ?>        
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>            
                    </div> 
                    <!--Modal here-->
                    <div id="modal_target"></div>

                    <!--alert Box-->
                    <div id="dialog" title="Alert message" style="display: none">
                        <div class="ui-dialog-content ui-widget-content">
                            <p>
                                <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0"></span>
                                <label id="lblMessage">
                                </label>
                            </p>
                        </div>
                    </div>