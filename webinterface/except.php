<?PHP
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
if(in_array('sha512', hash_algos())) {
	ini_set('session.hash_function', 'sha512');
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
	ini_set('session.cookie_secure', 1);
	if(!headers_sent()) {
		header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload;");
	}
}
session_start();

require_once('../other/config.php');

function getclientip() {
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	elseif(!empty($_SERVER['HTTP_X_FORWARDED']))
		return $_SERVER['HTTP_X_FORWARDED'];
	elseif(!empty($_SERVER['HTTP_FORWARDED_FOR']))
		return $_SERVER['HTTP_FORWARDED_FOR'];
	elseif(!empty($_SERVER['HTTP_FORWARDED']))
		return $_SERVER['HTTP_FORWARDED'];
	elseif(!empty($_SERVER['REMOTE_ADDR']))
		return $_SERVER['REMOTE_ADDR'];
	else
		return false;
}

if (isset($_POST['logout'])) {
    rem_session_ts3($rspathhex);
	header("Location: //".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\'));
	exit;
}

if (!isset($_SESSION[$rspathhex.'username']) || $_SESSION[$rspathhex.'username'] != $cfg['webinterface_user'] || $_SESSION[$rspathhex.'password'] != $cfg['webinterface_pass'] || $_SESSION[$rspathhex.'clientip'] != getclientip()) {
	header("Location: //".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\'));
	exit;
}

require_once('nav.php');
$csrf_token = bin2hex(openssl_random_pseudo_bytes(32));

if ($mysqlcon->exec("INSERT INTO `$dbname`.`csrf_token` (`token`,`timestamp`,`sessionid`) VALUES ('$csrf_token','".time()."','".session_id()."')") === false) {
	$err_msg = print_r($mysqlcon->errorInfo(), true);
	$err_lvl = 3;
}

if (($db_csrf = $mysqlcon->query("SELECT * FROM `$dbname`.`csrf_token` WHERE `sessionid`='".session_id()."'")->fetchALL(PDO::FETCH_UNIQUE|PDO::FETCH_ASSOC)) === false) {
	$err_msg = print_r($mysqlcon->errorInfo(), true);
	$err_lvl = 3;
}

if(($groupslist = $mysqlcon->query("SELECT * FROM `$dbname`.`groups` ORDER BY `sortid`,`sgidname` ASC")->fetchAll(PDO::FETCH_UNIQUE|PDO::FETCH_ASSOC)) === false) {
	$err_msg = print_r($mysqlcon->errorInfo(), true);
	$err_lvl = 3;
}

if(($user_arr = $mysqlcon->query("SELECT `uuid`,`cldbid`,`name` FROM `$dbname`.`user` ORDER BY `name` ASC")->fetchAll(PDO::FETCH_ASSOC)) === false) {
	$err_msg = "DB Error1: ".print_r($mysqlcon->errorInfo(), true); $err_lvl = 3;
}

if (isset($_POST['update']) && isset($db_csrf[$_POST['csrf_token']])) {
	$err_msg = $cfg['rankup_excepted_group_id_list'] = $cfg['rankup_excepted_unique_client_id_list'] = '';
	$errcnf = 0;
	$cfg['rankup_excepted_mode'] = $_POST['rankup_excepted_mode'];
	
	if (isset($_POST['rankup_excepted_unique_client_id_list']) && $_POST['rankup_excepted_unique_client_id_list'] != NULL) {
		$cfg['rankup_excepted_unique_client_id_list'] = implode(',',$_POST['rankup_excepted_unique_client_id_list']);
	}
	if (isset($_POST['rankup_excepted_group_id_list']) && $_POST['rankup_excepted_group_id_list'] != NULL) {
		$cfg['rankup_excepted_group_id_list'] = implode(',',$_POST['rankup_excepted_group_id_list']);
	}
    $cfg['rankup_excepted_channel_id_list'] = $_POST['rankup_excepted_channel_id_list'];

	if($errcnf == 0) {
		if ($mysqlcon->exec("INSERT INTO `$dbname`.`cfg_params` (`param`,`value`) VALUES ('rankup_excepted_mode','{$cfg['rankup_excepted_mode']}'),('rankup_excepted_unique_client_id_list','{$cfg['rankup_excepted_unique_client_id_list']}'),('rankup_excepted_group_id_list','{$cfg['rankup_excepted_group_id_list']}'),('rankup_excepted_channel_id_list','{$cfg['rankup_excepted_channel_id_list']}') ON DUPLICATE KEY UPDATE `value`=VALUES(`value`); DELETE FROM `$dbname`.`csrf_token` WHERE `token`='{$_POST['csrf_token']}'") === false) {
			$err_msg = print_r($mysqlcon->errorInfo(), true);
			$err_lvl = 3;
		} else {
			$err_msg = $lang['wisvsuc']." ".sprintf($lang['wisvres'], '&nbsp;&nbsp;<form class="btn-group" name="restart" action="bot.php" method="POST"><input type="hidden" name="csrf_token" value="'.$csrf_token.'"><button type="submit" class="btn btn-primary" name="restart"><i class="fas fa-sync"></i>&nbsp;'.$lang['wibot7'].'</button></form>');
			$err_lvl = NULL;
		}
	} else {
		$err_msg .= "<br>".$lang['errgrpid'];
	}

	if (isset($_POST['rankup_excepted_unique_client_id_list']) && $_POST['rankup_excepted_unique_client_id_list'] != NULL) {
		$cfg['rankup_excepted_unique_client_id_list'] = array_flip($_POST['rankup_excepted_unique_client_id_list']);
	}
	if (isset($_POST['rankup_excepted_group_id_list']) && $_POST['rankup_excepted_group_id_list'] != NULL) {
		$cfg['rankup_excepted_group_id_list'] = array_flip($_POST['rankup_excepted_group_id_list']);
	}
	$cfg['rankup_excepted_channel_id_list'] = array_flip(explode(',', $cfg['rankup_excepted_channel_id_list']));
} elseif(isset($_POST['update'])) {
	echo '<div class="alert alert-danger alert-dismissible">',$lang['errcsrf'],'</div>';
	rem_session_ts3($rspathhex);
	exit;
}
?>
		<div id="page-wrapper">
<?PHP if(isset($err_msg)) error_handling($err_msg, $err_lvl); ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header"><?php echo $lang['wiexcept'],' ',$lang['wihlset']; ?></h1>
					</div>
				</div>
				<form class="form-horizontal" data-toggle="validator" name="update" method="POST">
				<input type="hidden" name="csrf_token" value="<?PHP echo $csrf_token; ?>">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="form-group expertelement">
										<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wiexresdesc"><?php echo $lang['wiexres']; ?><i class="help-hover fas fa-question-circle"></i></label>
										<div class="col-sm-8">
											<select class="selectpicker show-tick form-control basic" name="rankup_excepted_mode">
											<?PHP
											echo '<option data-icon="fas fa-stopwatch" value="0"'; if($cfg['rankup_excepted_mode']=="0") echo " selected=selected"; echo '>&nbsp;&nbsp;',$lang['wiexres1'],'</option>';
											echo '<option data-icon="fas fa-pause" value="1"'; if($cfg['rankup_excepted_mode']=="1") echo " selected=selected"; echo '>&nbsp;&nbsp;',$lang['wiexres2'],'</option>';
											echo '<option data-icon="fas fa-sync" value="2"'; if($cfg['rankup_excepted_mode']=="2") echo " selected=selected"; echo '>&nbsp;&nbsp;',$lang['wiexres3'],'</option>';
											?>
											</select>
										</div>
									</div>
									<div class="row">&nbsp;</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wiexuiddesc"><?php echo $lang['wiexuid']; ?><i class="help-hover fas fa-question-circle"></i></label>
										<div class="col-sm-8">
											<select class="selectpicker show-tick form-control" data-actions-box="true" data-live-search="true" multiple name="rankup_excepted_unique_client_id_list[]">
											<?PHP
											foreach ($user_arr as $user) {
												if ($cfg['rankup_excepted_unique_client_id_list'] != NULL && array_key_exists($user['uuid'], $cfg['rankup_excepted_unique_client_id_list'])) $selected=" selected"; else $selected="";
												echo '<option value="',$user['uuid'],'" data-subtext="UUID: ',$user['uuid'],'; DBID: ',$user['cldbid'],'" ',$selected,'>',htmlspecialchars($user['name']),'</option>';
											}
											?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wiexgrpdesc"><?php echo $lang['wiexgrp']; ?><i class="help-hover fas fa-question-circle"></i></label>
										<div class="col-sm-8">
											<select class="selectpicker form-control" data-live-search="true" data-actions-box="true" multiple name="rankup_excepted_group_id_list[]">
											<?PHP
											foreach ($groupslist as $groupID => $groupParam) {
												if ($cfg['rankup_excepted_group_id_list'] != NULL &&  array_key_exists($groupID, $cfg['rankup_excepted_group_id_list'])) $selected=" selected"; else $selected="";
												if (isset($groupParam['iconid']) && $groupParam['iconid'] != 0) $iconid=$groupParam['iconid']; else $iconid="placeholder";
												if ($groupParam['type'] == 0) $disabled=" disabled"; else $disabled="";
												if ($groupParam['type'] == 0) $grouptype=" [TEMPLATE GROUP]"; else $grouptype="";
												if ($groupParam['type'] == 2) $grouptype=" [QUERY GROUP]";
												if ($groupID != 0) {
													echo '<option data-content="&nbsp;&nbsp;<img src=\'../tsicons/',$iconid,'.',$groupParam['ext'],'\' width=\'16\' height=\'16\'>&nbsp;&nbsp;',$groupParam['sgidname'],'&nbsp;<span class=\'text-muted small\'>SGID:&nbsp;',$groupID,$grouptype,'</span>" value="',$groupID,'"',$selected,$disabled,'></option>';
												}
											}
											?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">&nbsp;</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wiexciddesc"><?php echo $lang['wiexcid']; ?><i class="help-hover fas fa-question-circle"></i></label>
								<div class="col-sm-8">
									<textarea class="form-control" data-pattern="^([0-9]{1,9},)*[0-9]{1,9}$" data-error="Only use digits separated with a comma! Also must the first and last value be digit!" rows="1" name="rankup_excepted_channel_id_list" maxlength="21588"><?php if(!empty($cfg['rankup_excepted_channel_id_list'])) echo implode(',',array_flip($cfg['rankup_excepted_channel_id_list'])); ?></textarea>
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
						<div class="col-md-3"></div>
					</div>
					<div class="row">&nbsp;</div>
					<div class="row">
						<div class="text-center">
							<button type="submit" class="btn btn-primary" name="update"><i class="fas fa-save"></i>&nbsp;<?php echo $lang['wisvconf']; ?></button>
						</div>
					</div>
					<div class="row">&nbsp;</div>
				</form>
			</div>
		</div>
	</div>

<div class="modal fade" id="wiexresdesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wiexres']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $lang['wiexresdesc']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wiexuiddesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wiexuid']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $lang['wiexuiddesc']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wiexgrpdesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wiexgrp']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $lang['wiexgrpdesc']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wiexciddesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wiexcid']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $lang['wiexciddesc']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<script>
$('form[data-toggle="validator"]').validator({
	custom: {
		pattern: function ($el) {
			var pattern = new RegExp($el.data('pattern'));
			return pattern.test($el.val());
		}
	},
	delay: 100,
	errors: {
		pattern: "There should be an error in your value, please check all could be right!"
	}
});
</script>
</body>
</html>