<?php
session_start();

if (isset($_SESSION['f_user'])) { 
	//load MySQL Access
	include '../../include/config/mysql_login.php';
	mysql_connect("localhost", $mysqluser, $mysqlpass);
	mysql_select_db("mowdata");

	$query = "SELECT * FROM mowdata.usr_settings WHERE usrname='" .	mysql_real_escape_string($_SESSION['f_user']) . "'";
	$result = mysql_query($query) or die("Was unabled to find user data.");
	if(!($usr_settings = mysql_fetch_array($result))){
		echo '<ul><li><div style="padding:4px; 

		margin:0;border:0;">Disabled. <small>Incorrect login 
		credentials.</small></div></li></ul>';
		exit;
	}

	if($_SESSION['pass_status'] == $usr_settings['md5phash']) {
		//User Authenticated

		include "../../include/lang/" . $usr_settings['lang'] . ".php";


	$SQL_FROM = 'member';
	$SQL_WHERE = 'f_name';

	
	$hits = 0;
	$searchq = strip_tags($_GET['q']);

	if(strlen($searchq)>1){
	$getRecord_sql	=	'SELECT * FROM member WHERE first_name LIKE "'.$searchq.'%"';


	$getRecord		=	mysql_query($getRecord_sql);
echo '<img src="p1/mq_pt.gif" height="6" width="12" alt="" border="0" /><ul>';

	while ($row = mysql_fetch_array($getRecord)) {
if($row['mClient'] == 1) {
$hits++;
?>
		<li><a href="client.php?do=show&mid=<?php echo $row['mid'];?>">
<?php echo $row['first_name'];
?> <small><?php
echo $row['last_name'];
?></small></a></li>

<?php }
}
	//accents
	if(strlen($searchq)>strlen(str_replace("e","",strtolower($searchq)))){
        $getRecord_sql  =       'SELECT * FROM member WHERE first_name LIKE "'.preg_replace('/e/', 'é', strtolower($searchq), 1).'%"';
	        $getRecord              =       mysql_query($getRecord_sql);
	        while ($row = mysql_fetch_array($getRecord)) {
			if($row['mClient'] == 1) {
			$hits++;
			?>
	                <li><a href="client.php?do=show&mid=<?php echo $row['mid'];?>">
			<?php echo $row['first_name'];
			?> <small><?php
			echo $row['last_name'];
			?></small></a></li>
			<?php }
		}
        $getRecord_sql  =       'SELECT * FROM member WHERE first_name LIKE "'.preg_replace('/e/', 'è', strtolower($searchq), 1).'%"';
                $getRecord              =       mysql_query($getRecord_sql);
                while ($row = mysql_fetch_array($getRecord)) {
                        if($row['mClient'] == 1) {
                        $hits++;
                        ?>
                        <li><a href="client.php?do=show&mid=<?php echo $row['mid'];?>">
                        <?php echo $row['first_name'];
                        ?> <small><?php
                        echo $row['last_name'];
                        ?></small></a></li>
                        <?php }
                }
        $getRecord_sql  =       'SELECT * FROM member WHERE first_name LIKE "'.preg_replace('/e/', 'É', strtolower($searchq), 1).'%"';
                $getRecord              =       mysql_query($getRecord_sql);
                while ($row = mysql_fetch_array($getRecord)) {
                        if($row['mClient'] == 1) {
                        $hits++;
                        ?>
                        <li><a href="client.php?do=show&mid=<?php echo $row['mid'];?>">
                        <?php echo $row['first_name'];
                        ?> <small><?php
                        echo $row['last_name'];
                        ?></small></a></li>
                        <?php } 
                }


        }

	//end accents

	$getRecord_sql	=	'SELECT * FROM member WHERE last_name LIKE "'.$searchq.'%"';

	$getRecord		=	mysql_query($getRecord_sql);

	while ($row = mysql_fetch_array($getRecord)) {
if($row['mClient'] == 1) {
$hits++;
?>
		<li><a href="client.php?do=show&mid=<?php echo $row['mid'];?>">
<?php echo $row['last_name'];
?>, <small><?php
echo $row['first_name'];
?></small></a></li>

<?php }
}
       //accents
        if(strlen($searchq)>strlen(str_replace("e","",strtolower($searchq)))){
        $getRecord_sql  =       'SELECT * FROM member WHERE last_name LIKE "'.preg_replace('/e/', 'é', strtolower($searchq), 1).'%"';
                $getRecord              =       mysql_query($getRecord_sql);
                while ($row = mysql_fetch_array($getRecord)) {
                        if($row['mClient'] == 1) {
                        $hits++;
                        ?>
                        <li><a href="client.php?do=show&mid=<?php echo $row['mid'];?>">
                        <?php echo $row['first_name'];
                        ?> <small><?php
                        echo $row['last_name'];
                        ?></small></a></li>
                        <?php }
                }
      $getRecord_sql  =       'SELECT * FROM member WHERE last_name LIKE "'.preg_replace('/e/', 'è', strtolower($searchq), 1).'%"';
                $getRecord              =       mysql_query($getRecord_sql);
                while ($row = mysql_fetch_array($getRecord)) {
                        if($row['mClient'] == 1) {
                        $hits++;
                        ?>
                        <li><a href="client.php?do=show&mid=<?php echo $row['mid'];?>">
                        <?php echo $row['first_name'];
                        ?> <small><?php
                        echo $row['last_name'];
                        ?></small></a></li>
                        <?php }
	}
	$getRecord_sql  =       'SELECT * FROM member WHERE last_name LIKE "'.preg_replace('/e/', 'É', strtolower($searchq), 1).'%"';
                $getRecord              =       mysql_query($getRecord_sql);
                while ($row = mysql_fetch_array($getRecord)) {
                        if($row['mClient'] == 1) {
                        $hits++;
                        ?>
                        <li><a href="client.php?do=show&mid=<?php echo $row['mid'];?>">
                        <?php echo $row['first_name'];
                        ?> <small><?php
                        echo $row['last_name'];
                        ?></small></a></li>
                        <?php }
                }


        }

        //end accents

	if ($hits == 0)
	echo '<li><div style="padding:4px; margin:0; border:0;"><small><i>' . $aj_nores . '..</i></small></div></li>'; 

	echo '</ul>';

	} 

//end authenticated user.
} else {
echo '<ul><li><div style="padding:4px; 
margin:0;border:0;">Disabled. <small>Incorrect login 
credentials.</small></div></li></ul>';
}
} else {
echo '<ul><li><div style="padding:4px; margin:0; 
border:0;">Disabled. <small>Incorrect login 
credentials.</small></div></li></ul>';
} ?>
