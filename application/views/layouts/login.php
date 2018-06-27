<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to SMS</title>

        <style type="text/css">

            ::selection { background-color: #E13300; color: white; }
            ::-moz-selection { background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin:40px 0;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #body {
                margin: 0 ;
            }

            p.footer {
                text-align: right;
                font-size: 11px;
                border-top: 1px solid #D0D0D0;
                line-height: 32px;
                padding: 0 10px 0 10px;
                margin: 20px 0 0 0;
            }

            #container {
                width: 340px;
                margin: 0 auto;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }

            input{

                width: 300px;
                height: 30px;
                padding: 10px;
                border-bottom: 2px solid #2495E9;
                border-top: none;
                border-left: none;
                border-right: none;
                font-size: 18px;
            }
        </style>
    </head>
    <body>

        <div id="container">
            <h1>Login</h1>
            <div style="padding:10px;">
                <?php if (isset($error)) { ?>
                    <p style="color:red;"><?php echo $error; ?></p>
                <?php } ?>
                <form method="post" action="<?php echo base_url(); ?>login/do_login">
                    <input type="text" name="username" placeholder="Username" required="1" />
                    <input type="password" name="password"  placeholder="Password"  required="1" /><br/><br/>
                    <center><input type="submit" value="Login" class="btn primary" style="border-bottom: none; height: 35px;  background: #2495E9;  cursor: pointer; border-radius:4px; font-size: 14px; color: white" /></center>
                </form>
            </div>

        </div>

    </body>
</html>