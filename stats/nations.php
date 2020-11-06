<?PHP
require_once('_preload.php');

if(is_dir(substr(__DIR__,0,-5).'languages/')) {
	foreach(scandir(substr(__DIR__,0,-5).'languages/') as $file) {
		if ('.' === $file || '..' === $file || is_dir($file)) continue;
		$sep_lang = preg_split("/[._]/", $file);
		if(isset($sep_lang[0]) && $sep_lang[0] == 'nations' && isset($sep_lang[1]) && strlen($sep_lang[1]) == 2 && isset($sep_lang[2]) && strtolower($sep_lang[2]) == 'php') {
			if(strtolower($cfg['default_language']) == strtolower($sep_lang[1])) {
				require_once('../languages/nations_'.$sep_lang[1].'.php');
				$required_nations = 1;
				break;
			}
		}
	}
	if(!isset($required_nations)) {
		require_once('../languages/nations_en.php');
	}
}

$sql_res = $mysqlcon->query("SELECT * FROM `$dbname`.`stats_nations` ORDER BY `count` DESC")->fetchAll(PDO::FETCH_UNIQUE|PDO::FETCH_ASSOC);
?>
		<div id="page-wrapper">
<?PHP if(isset($err_msg)) error_handling($err_msg, $err_lvl); ?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">
							<?PHP echo $lang['stna0001'],' - ',$lang['stna0002']; ?>
						</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<tbody>
								<tr>
									<th>#</th>
									<th><?PHP echo $lang['stna0003']; ?></th>
									<th><?PHP echo $lang['stna0001']; ?></th>
									<th><?PHP echo $lang['stix0060'],' ',$lang['stna0004']; ?></th>
									<th><?PHP echo $lang['stna0007']; ?></th>
								</tr>
<?PHP
$count = 0;
$sum_of_all = 0;
foreach ($sql_res as $country => $value) {
	$sum_of_all = $sum_of_all + $value['count'];
}
foreach ($sql_res as $country => $value) {
	$count++;
	echo '
	<tr>
		<td>',$count,'</td>
		<td><span class="flag-icon flag-icon-',strtolower($country),'"></span>&nbsp;&nbsp;',$country,'</td>
		<td><a href="list_rankup.php?sort=rank&order=desc&search=filter:country:',$country,':">',$nation[$country],'</td>
		<td>',$value['count'],'</td>
		<td>',number_format(round(($value['count'] * 100 / $sum_of_all), 1), 1),' %</td>
	</tr>';
}
?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>  
		</div>
	</div>
	<?PHP require_once('_footer.php'); ?>
</body>
</html>