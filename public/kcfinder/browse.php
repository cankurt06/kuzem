<?php

/** This file is part of KCFinder project
  *
  *      @desc Browser calling script
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *     /* @link http://kcfinder.sunhater.com
  */


setcookie("KCFINDER_orderDesc","on");
setcookie("KCFINDER_order","date");
setcookie("KCFINDER_showsize","on");
setcookie("KCFINDER_showtime","on");
require "core/autoload.php";
$browser = new browser();
$browser->action();
?>