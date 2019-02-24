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

if (isset($_POST['update']) && isset($db_csrf[$_POST['csrf_token']])) {
	$cfg['teamspeak_host_address'] = $_POST['teamspeak_host_address'];
	$cfg['teamspeak_query_port'] = $_POST['teamspeak_query_port'];
	if (isset($_POST['teamspeak_query_encrypt_switch'])) $cfg['teamspeak_query_encrypt_switch'] = 1; else $cfg['teamspeak_query_encrypt_switch'] = 0;
	$cfg['teamspeak_voice_port'] = $_POST['teamspeak_voice_port'];
	$cfg['teamspeak_query_user'] = $_POST['teamspeak_query_user'];
	$cfg['teamspeak_query_pass'] = $_POST['teamspeak_query_pass'];
	$cfg['teamspeak_query_nickname'] = $_POST['teamspeak_query_nickname'];
	$cfg['teamspeak_default_channel_id'] = $_POST['teamspeak_default_channel_id'];
	$cfg['teamspeak_query_command_delay'] = $_POST['teamspeak_query_command_delay'];
	$cfg['teamspeak_avatar_download_delay']= $_POST['teamspeak_avatar_download_delay'];
if ($mysqlcon->exec("INSERT INTO `$dbname`.`cfg_params` (`param`,`value`) VALUES ('teamspeak_host_address','{$cfg['teamspeak_host_address']}'),('teamspeak_query_encrypt_switch','{$cfg['teamspeak_query_encrypt_switch']}'),('teamspeak_query_port','{$cfg['teamspeak_query_port']}'),('teamspeak_voice_port','{$cfg['teamspeak_voice_port']}'),('teamspeak_query_user','{$cfg['teamspeak_query_user']}'),('teamspeak_query_pass','{$cfg['teamspeak_query_pass']}'),('teamspeak_query_nickname','{$cfg['teamspeak_query_nickname']}'),('teamspeak_default_channel_id','{$cfg['teamspeak_default_channel_id']}'),('teamspeak_query_command_delay','{$cfg['teamspeak_query_command_delay']}'),('teamspeak_avatar_download_delay','{$cfg['teamspeak_avatar_download_delay']}') ON DUPLICATE KEY UPDATE `value`=VALUES(`value`); DELETE FROM `$dbname`.`csrf_token` WHERE `token`='{$_POST['csrf_token']}'") === false) {
		$err_msg = print_r($mysqlcon->errorInfo(), true);
		$err_lvl = 3;
	} else {
		$err_msg = $lang['wisvsuc']." ".sprintf($lang['wisvres'], '&nbsp;&nbsp;<form class="btn-group" name="restart" action="bot.php" method="POST"><input type="hidden" name="csrf_token" value="'.$csrf_token.'"><button
		type="submit" class="btn btn-primary" name="restart"><i class="fa fa-fw fa-refresh"></i>&nbsp;'.$lang['wibot7'].'</button></form>');
		$err_lvl = NULL;
	}
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
						<h1 class="page-header">
							<?php echo $lang['winav1'],' ',$lang['wihlset']; ?>
						</h1>
					</div>
				</div>
				<form class="form-horizontal" data-toggle="validator" name="update" method="POST">
					<input type="hidden" name="csrf_token" value="<?PHP echo $csrf_token; ?>">
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="form-group required-field-block">
										<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wits3hostdesc"><?php echo $lang['wits3host']; ?><i class="help-hover glyphicon glyphicon-question-sign"></i></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" data-pattern="^[^.]+[^:]*$" data-error="Do not enter the port inside this field. You should enter the port (e.g. 9987) inside the TS3-Voice-Port!" name="teamspeak_host_address" value="<?php echo $cfg['teamspeak_host_address']; ?>" maxlength="64" required>
											<div class="required-icon"><div class="text">*</div></div>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wits3encryptdesc"><?php echo $lang['wits3encrypt']; ?><i class="help-hover glyphicon glyphicon-question-sign"></i></label>
										<div class="col-sm-8">
											<?PHP if ($cfg['teamspeak_query_encrypt_switch'] == 1) {
												echo '<input class="switch-animate" type="checkbox" checked data-size="mini" name="teamspeak_query_encrypt_switch" value="',$cfg['teamspeak_query_encrypt_switch'],'">';
											} else {
												echo '<input class="switch-animate" type="checkbox" data-size="mini" name="teamspeak_query_encrypt_switch" value="',$cfg['teamspeak_query_encrypt_switch'],'">';
											} ?>
										</div>
									</div>									
									<div class="form-group">
										<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wits3querydesc"><?php echo $lang['wits3query']; ?><i class="help-hover glyphicon glyphicon-question-sign"></i></label>
										<div class="col-sm-8 required-field-block-spin">
											<input type="text" class="form-control" name="teamspeak_query_port" value="<?php echo $cfg['teamspeak_query_port']; ?>" required>
											<script>
											$("input[name='teamspeak_query_port']").TouchSpin({
												min: 0,
												max: 65535,
												verticalbuttons: true,
												prefix: 'TCP:'
											});
											</script>
											<div class="required-icon"><div class="text">*</div></div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wits3voicedesc"><?php echo $lang['wits3voice']; ?><i class="help-hover glyphicon glyphicon-question-sign"></i></label>
										<div class="col-sm-8 required-field-block-spin">
											<input type="text" class="form-control" name="teamspeak_voice_port" value="<?php echo $cfg['teamspeak_voice_port']; ?>" required>
											<script>
											$("input[name='teamspeak_voice_port']").TouchSpin({
												min: 0,
												max: 65535,
												verticalbuttons: true,
												prefix: 'UDP:'
											});
											</script>
											<div class="required-icon"><div class="text">*</div></div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">&nbsp;</div>
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="form-group">
										<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wits3querusrdesc"><?php echo $lang['wits3querusr']; ?><i class="help-hover glyphicon glyphicon-question-sign"></i></label>
										<div class="col-sm-8 required-field-block">
											<input type="text" class="form-control" name="teamspeak_query_user" value="<?php echo $cfg['teamspeak_query_user']; ?>" required>
											<div class="required-icon"><div class="text">*</div></div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wits3querpwdesc"><?php echo $lang['wits3querpw']; ?><i class="help-hover glyphicon glyphicon-question-sign"></i></label>
										<div class="col-sm-8 required-field-block">
											<input type="password" class="form-control" name="teamspeak_query_pass" value="<?php echo $cfg['teamspeak_query_pass']; ?>" data-toggle="password" data-placement="before" required>
											<div class="required-icon"><div class="text">*</div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 ">
							<div class="panel-body">
								<div class="form-group">
									<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wits3qnmdesc"><?php echo $lang['wits3qnm']; ?><i class="help-hover glyphicon glyphicon-question-sign"></i></label>
									<div class="col-sm-8 required-field-block">
										<input type="text" class="form-control" name="teamspeak_query_nickname" value="<?php echo $cfg['teamspeak_query_nickname']; ?>" maxlength="30" required>
										<div class="required-icon"><div class="text">*</div></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wits3dchdesc"><?php echo $lang['wits3dch']; ?><i class="help-hover glyphicon glyphicon-question-sign"></i></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="teamspeak_default_channel_id" value="<?php echo $cfg['teamspeak_default_channel_id']; ?>">
									<script>
									$("input[name='teamspeak_default_channel_id']").TouchSpin({
										min: 0,
										max: 2147483647,
										verticalbuttons: true,
										prefix: 'ID:'
									});
									</script>
								</div>
							</div>
							<div class="row">&nbsp;</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wits3smdesc"><?php echo $lang['wits3sm']; ?><i class="help-hover glyphicon glyphicon-question-sign"></i></label>
								<div class="col-sm-8">
									<select class="selectpicker show-tick form-control" id="basic" name="teamspeak_query_command_delay">
									<?PHP
									echo '<option data-subtext="[recommended]" value="0"'; if($cfg['teamspeak_query_command_delay']=="0") echo ' selected="selected"'; echo '>disabled (Realtime)</option>';
									echo '<option data-divider="true">&nbsp;</option>';
									echo '<option data-subtext="(0,2 seconds)" value="200000"'; if($cfg['teamspeak_query_command_delay']=="200000") echo ' selected="selected"'; echo '>Low delay</option>';
									echo '<option data-subtext="(0,5 seconds)" value="500000"'; if($cfg['teamspeak_query_command_delay']=="500000") echo ' selected="selected"'; echo '>Middle delay</option>';
									echo '<option data-subtext="(1,0 seconds)" value="1000000"'; if($cfg['teamspeak_query_command_delay']=="1000000") echo ' selected="selected"'; echo '>High delay</option>';
									echo '<option data-subtext="(2,0 seconds)" value="2000000"'; if($cfg['teamspeak_query_command_delay']=="2000000") echo ' selected="selected"'; echo '>Huge delay</option>';
									echo '<option data-subtext="(5,0 seconds)" value="5000000"'; if($cfg['teamspeak_query_command_delay']=="5000000") echo ' selected="selected"'; echo '>Ultra delay</option>';
									?>
									</select>
								</div>
							</div>
							<div class="row">&nbsp;</div>
							<div class="form-group">
								<label class="col-sm-4 control-label" data-toggle="modal" data-target="#wits3avatdesc"><?php echo $lang['wits3avat']; ?><i class="help-hover glyphicon glyphicon-question-sign"></i></label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="teamspeak_avatar_download_delay" value="<?php echo $cfg['teamspeak_avatar_download_delay']; ?>">
									<script>
									$("input[name='teamspeak_avatar_download_delay']").TouchSpin({
										min: 0,
										max: 65535,
										verticalbuttons: true,
										prefix: 'Sec.:'
									});
									</script>
								</div>
							</div>
						</div>
					</div>
					<div class="row">&nbsp;</div>
					<div class="row">
						<div class="text-center">
							<button type="submit" class="btn btn-primary" name="update"><?php echo $lang['wisvconf']; ?></button>
						</div>
					</div>
					<div class="row">&nbsp;</div>
				</form>
			</div>
		</div>
	</div>
<div class="modal fade" id="wits3hostdesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wits3host']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $lang['wits3hostdesc']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wits3encryptdesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wits3encrypt']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo sprintf($lang['wits3encryptdesc'], '<pre>sudo apt-get install php-ssh2</pre>', '<pre>query_ssh_ip=0.0.0.0,::<br>query_ssh_port=10022<br>query_protocols=ssh,raw<br>query_ssh_rsa_host_key=ssh_host_rsa_key</pre>'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wits3querydesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wits3query']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $lang['wits3querydesc']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wits3voicedesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wits3voice']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $lang['wits3voicedesc']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wits3querusrdesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wits3querusr']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo sprintf($lang['wits3querusrdesc'], '<a href="https://ts-n.net/ranksystem.php#requirements" target="_blank">https://ts-n.net/ranksystem.php#requirements</a>'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wits3querpwdesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wits3querpw']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $lang['wits3querpwdesc']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wits3qnmdesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wits3qnm']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $lang['wits3qnmdesc']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wits3dchdesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wits3dch']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $lang['wits3dchdesc']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wits3smdesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wits3sm']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo sprintf($lang['wits3smdesc'], '<pre>disabled	(0,0)		0,10<br>low delay	(0,2)		2,60<br>middle delay	(0,5)		6,50<br>high delay	(1,0)		13,00<br>huge delay	(2,0)		26,00<br>ultra delay	(5,0)		65,00</pre>'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?PHP echo $lang['stnv0002']; ?></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="wits3avatdesc" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo $lang['wits3avat']; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $lang['wits3avatdesc']; ?>
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