<?php
defined('_SECURE_') or die('Forbidden');

function default_hook_themes_buildmenu($menu_config) {
	global $core_config;

	/*
	$menu_config = Array
	(
		[My Account] => Array	<--- $menu_title
		(
			[0] => Array	<--- $array_menu
			(
				[0] => index.php?app=menu&inc=send_sms&op=sendsmstopv	<--- $sub_menu_url
				[1] => Send SMS						<--- $sub_menu_title
			) */

	// Note: login and then view source, see LEFT NAVIGATION MENU block in the source

	/*
	<nav>
		<div class="menu-item">
			<h4><a href="#">Portfolio</a></h4>
			<ul>
				<li><a href="#">Web</a></li>
				<li><a href="#">Print</a></li>
				<li><a href="#">Other</a></li>
			</ul>
		</div>
	</nav> */

	$content = "\n\n<!-- BEGIN LEFT NAVIGATION MENU -->\n\n";
	$content .= "<nav>\n";
	foreach ($menu_config as $menu_title => $array_menu) {
		$content .= "<div class=\"menu-item\">\n";
		$content .= "<h4><a href=#>".$menu_title."</a></h4>\n";
		$content .= "<ul>\n";
		foreach ($array_menu as $sub_menu) {
			$sub_menu_url = $sub_menu[0];
			$sub_menu_title = $sub_menu[1];
			$content .= "<li><a href=\"".$sub_menu_url."\">".$sub_menu_title."</a></li>\n";
		}
		$content .= "</ul>\n";
		$content .= "</div>\n";
	}
	$content .= "</nav>\n";
	$content .= "\n\n<!-- END LEFT NAVIGATION MENU -->\n\n";

	return $content;
}

function default_hook_themes_navbar($num, $nav, $max_nav, $url, $page) {
	global $core_config;
	$nav_pages = "";
	if ($num) {
		$nav_start = ((($nav-1) * $max_nav)+1);
		$nav_end = (($nav) * $max_nav);
		$start = 1;
		$end = ceil($num/$max_nav);
		$nav_pages = "<div id='navbar'>";
		$nav_pages .= "<a href='".$url."&page=1&nav=1'> << </a>";
		$nav_pages .= ($start==$nav) ? " &nbsp; < &nbsp; " : "<a href='".$url."&page=".((($nav-2)*$max_nav)+1)."&nav=".($nav-1)."'> &nbsp; < &nbsp; </a>";
		$nav_pages .= ($start==$nav) ? "" : " ... ";
		for($i=$nav_start;$i<=$nav_end;$i++) {
			if($i>$num){ break; };
			if ($i == $page) {
				$nav_pages .= "<u>$i</u> ";
			} else {
				$nav_pages .= "<a href='".$url."&page=".$i."&nav=".$nav."'>".$i."</a> ";
			}
		}
		$nav_pages .= ($end==$nav) ? "" : " ... ";
		$nav_pages .= ($end==$nav) ? " &nbsp; > &nbsp; " : "<a href='".$url."&page=".(($nav*$max_nav)+1)."&nav=".($nav+1)."'> &nbsp; > &nbsp; </a>";
		$nav_pages .= "<a href='".$url."&page=".$num."&nav=".$end."'> >> </a>";
		$nav_pages .= "</div>";
	}
	return $nav_pages;
}

?>