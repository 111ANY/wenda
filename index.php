<?php
/*
+--------------------------------------------------------------------------
|   WeCenter [#RELEASE_VERSION#]
|   ========================================
|   by WeCenter Software
|   Â© 2011 - 2014 WeCenter. All Rights Reserved
|   http://www.wecenter.com
|   ========================================
|   Support: WeCenter@qq.com
|
+---------------------------------------------------------------------------
*/

if (! file_exists(dirname(__FILE__) . '/system/config/database.php') AND ! file_exists(dirname(__FILE__) . '/system/config/install.lock.php') AND !defined('SAE_TMP_PATH'))
{
	header('Location: ./install/');
	exit;
}

include('system/system.php');

AWS_APP::run();
?>
<html>
  <head>
    <script src="https://qiyukf.com/script/cdc884a0e5ee13485747090eb640ddf2.js"></script><!-- FAQRobot Button END   -->
    <!-- FAQRobot Button BEGIN -->    <script src='http://v3.faqrobot.org/servlet/JScript?m=23245&receiveId=&sysnum=151937564346424607' language='JavaScript'>    </script><!-- FAQRobot Button END   -->
  </head>
</html>