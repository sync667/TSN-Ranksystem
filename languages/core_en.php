<?PHP
$lang = array();
$lang['adduser']          = "User %s (unique Client-ID: %s; Client-database-ID %s) is unknown -> added to the Ranksystem now.";
$lang['alrup']            = "You already updated your database. Please delete this file from your webspace!";
$lang['changedbid']       = "User %s (unique Client-ID: %s) got a new TeamSpeak Client-database-ID (%s). Update the old Client-database-ID (%s) and reset collected times!";
$lang['crawl']            = "Scan for connected user and count the activity...";
$lang['clean']            = "Scan for clients, which have to delete...";
$lang['cleanc']           = "clean clients";
$lang['cleancdesc']       = "With this function the old clients in the Ranksystem get deleted.<br><br>To this end, the Ranksystem sychronized with the TeamSpeak database. Clients, which do not exist in TeamSpeak, will be deleted from the Ranksystem.<br><br>This function is only enabled when the 'Slowmode' is deactivated!<br><br><br>For automatic adjustment of the TeamSpeak database the ClientCleaner can be used:<br>http://ts-n.net/clientcleaner.php";
$lang['cleandel']         = "There were %s clients deleted out of the Ranksystem database, cause they were no longer existing in the TeamSpeak database.";
$lang['cleanno']          = "There were nothing to delete...";
$lang['cleanp']           = "clean period";
$lang['cleanpdesc']       = "Set a time that has to elapse before the 'clean clients' runs next.<br><br>Set a time in seconds.<br><br>Recommended is once a day, cause the client cleaning needs much time for bigger databases.";
$lang['cleanrs']          = "Clients in the Ranksystem database: %s";
$lang['cleants']          = "Clients found in the TeamSpeak database: %s (of %s)";
$lang['days']             = "days";
$lang['dbconerr']         = "Failed to connect to MySQL-Database: ";
$lang['delcldgrpif']      = "Error while removing the knowledge for servergroups: %s";
$lang['delcldgrpsc']      = "Knowledge about servergroups for %s User successfully removed.";
$lang['delclientsif']     = "%s Clients deleted out of the Ranksystem database!";
$lang['delclientssc']     = "%s Clients successfully deleted out of the Ranksystem database!";
$lang['errlogin']         = "Username and/or password are incorrect! Try again...";
$lang['error']            = "Error ";
$lang['errremgrp']        = "Error while removing user with unique Client-ID %s out of the servergroup with servergroup-database-ID %s!";
$lang['errremdb']         = "Error while removing user with unique Client-ID % out of the Ranksystem database!";
$lang['errsel']           = "Error while choosing the selections with<br>selected client: %s<br>option 'delete clients': %s<br>option 'sum. online time': %s";
$lang['errukwn']          = "An unknown error has occurred!";
$lang['errupcount']       = "Error while renewing the summary online time of %s by user with the unique Client-ID %s";
$lang['firstuse']         = "Seems to be the first run. Start logging the Userhistory...";
$lang['highest']          = "highest rank reached";
$lang['instdb']           = "Install database:";
$lang['instdberr']        = "Error while creating the database: ";
$lang['instdbsubm']       = "Create database";
$lang['instdbsuc']        = "Database %s successfully created.";
$lang['insttb']           = "Install Tables:";
$lang['insttberr']        = "Error while creating table: ";
$lang['insttbsuc']        = "Table %s successfully created.";
$lang['isntwicfg']        = "Can't save the database configuration! Please edit the 'other/dbconfig.php' with a chmod 0777 and try again after.";
$lang['isntwichm']        = "Please edit the 'other/dbconfig.php', and the folders 'avatars/', 'icons/' and 'logs/' with the needed permissions. Therefore edit the  chmod to 0777. After it try again (reload the page).";
$lang['isntwidb']         = "Enter your database settings:";
$lang['isntwidberr']      = "Please check if you filled out all fields correctly!";
$lang['isntwidbhost']     = "DB Hostaddress:";
$lang['isntwidbhostdesc'] = "Database server address<br>(IP or DNS)";
$lang['isntwidbmsg']      = "Database error: ";
$lang['isntwidbname']     = "DB Name:";
$lang['isntwidbnamedesc'] = "Name of database";
$lang['isntwidbpass']     = "DB Password:";
$lang['isntwidbpassdesc'] = "Password to access the database";
$lang['isntwidbtype']     = "DB Type:";
$lang['isntwidbtypedesc'] = "Database type<br><br>You have to install the needed PDO Driver.<br>For more informations have look at the requirements on http://ts-n.net/ranksystem.php";
$lang['isntwidbusr']      = "DB User:";
$lang['isntwidbusrdesc']  = "User to access the database";
$lang['isntwidel']        = "Please delete the file 'install.php' and all 'update_x-xx.php' files from your webserver and open the %s to configure the Ranksystem!";
$lang['isntwiusr']        = "User for the webinterface successfully created.";
$lang['isntwiusrcr']      = "create access";
$lang['isntwiusrdesc']    = "Enter a username and password for access the webinterface. With the webinterface you can configurate the ranksytem.";
$lang['isntwiusrh']       = "Access - Webinterface";
$lang['listacsg']         = "actual servergroup";
$lang['listcldbid']       = "Client-database-ID";
$lang['listexgrp']        = "Will not conside for the Ranksystem (servergroup exception).";
$lang['listexuid']        = "Will not conside for the Ranksystem (client exception).";
$lang['listip']           = "IP address";
$lang['listnick']         = "Clientname";
$lang['listnxsg']         = "next servergroup";
$lang['listnxup']         = "next rank up";
$lang['listrank']         = "rank";
$lang['listseen']         = "last seen";
$lang['listsuma']         = "sum. active time";
$lang['listsumi']         = "sum. idle time";
$lang['listsumo']         = "sum. online time";
$lang['listtime']         = "%s day(s), %s hour(s), %s min., %s sec.";
$lang['listuid']          = "unique Client-ID";
$lang['new']              = "new";
$lang['nocount']          = "User %s (unique Client-ID: %s; Client-database-ID %s) is a query-user or is several times online (only first connection counts) -> this will not count!";
$lang['noentry']          = "No entries found..";
$lang['pass']             = "Password: ";
$lang['queryname']        = "First Botname already in use. Trying with second Botname...";
$lang['sccrmcld']         = "User with unique Client-ID %s successfull removed from the Ranksystem database.";
$lang['sccupcount']       = "User with the unique Client-ID %s successfull overwritten with a summary online time of %s.";
$lang['setontime']        = "sum. online time";
$lang['setontimedesc']    = "Enter a new summary online time, which should be set to the previous selected clients. With this the old summary online gets overwritten.<br><br>The entered summary online time will be considered for the rank up.";
$lang['sgrpadd']          = "Grant servergroup %s to user %s (unique Client-ID: %s; Client-database-ID %s).";
$lang['sgrprerr']         = "It happened a problem with the servergroup of the user %s (unique Client-ID: %s; Client-database-ID %s)!";
$lang['sgrprm']           = "Removed servergroup %s from user %s (unique Client-ID: %s; Client-database-ID %s).";
$lang['sitegen']          = "Site generated in %s seconds with %s clients.";
$lang['sitegenl']         = "Site generated in %s seconds with %s clients (thereof %s displayed; %s affected by exception rules; %s in highest rank).";
$lang['stix0001']         = "Server statistics";
$lang['stix0002']         = "Total users";
$lang['stix0003']         = "View details";
$lang['stix0004']         = "Online time of all user / Total";
$lang['stix0005']         = "View top of all time";
$lang['stix0006']         = "View top of the month";
$lang['stix0007']         = "View top of the week";
$lang['stix0008']         = "Server usage";
$lang['stix0009']         = "In the last 7 days";
$lang['stix0010']         = "In the last 30 days";
$lang['stix0011']         = "In the last 24 hours";
$lang['stix0012']         = "select period";
$lang['stix0013']         = "Last day";
$lang['stix0014']         = "Last week";
$lang['stix0015']         = "Last month";
$lang['stix0016']         = "Active / inactive time (of all clients)";
$lang['stix0017']         = "Versions  (of all clients)";
$lang['stix0018']         = "Nationalities  (of all clients)";
$lang['stix0019']         = "Platforms  (of all clients)";
$lang['stix0020']         = "Current statistics";
$lang['stix0021']         = "Requested information";
$lang['stix0022']         = "Result";
$lang['stix0023']         = "Server status";
$lang['stix0024']         = "Online";
$lang['stix0025']         = "Offline";
$lang['stix0026']         = "Clients (Online / Max)";
$lang['stix0027']         = "Amount of channels";
$lang['stix0028']         = "Average server ping";
$lang['stix0029']         = "Total bytes received";
$lang['stix0030']         = "Total bytes sent";
$lang['stix0031']         = "Server uptime";
$lang['stix0032']         = "before offline:";
$lang['stix0033']         = "<span id=\"days\">00</span> Days, <span id=\"hours\">00</span> Hours, <span id=\"minutes\">00</span> Mins, <span id=\"seconds\">00</span> Secs";
$lang['stix0034']         = "Average packet loss";
$lang['stix0035']         = "Overall statistics";
$lang['stix0036']         = "Server name";
$lang['stix0037']         = "Server address (Host Address : Port)";
$lang['stix0038']         = "Server password";
$lang['stix0039']         = "No (Server is public)";
$lang['stix0040']         = "Yes (Server Is private)";
$lang['stix0041']         = "Server ID";
$lang['stix0042']         = "Server platform";
$lang['stix0043']         = "Server version";
$lang['stix0044']         = "Server creation date (dd/mm/yyyy)";
$lang['stix0045']         = "Report to server list";
$lang['stix0046']         = "Activated";
$lang['stix0047']         = "Not activated";
$lang['stix0048']         = "not enough data yet...";
$lang['stix0049']         = "Online time of all user / month";
$lang['stix0050']         = "Online time of all user / week";
$lang['stix0051']         = "TeamSpeak has failed, so no creation date...";
$lang['stmy0001']         = "My statistics";
$lang['stmy0002']         = "Rank";
$lang['stmy0003']         = "Database ID:";
$lang['stmy0004']         = "Unique ID:";
$lang['stmy0005']         = "Total connections to the server:";
$lang['stmy0006']         = "Start date for statistics:";
$lang['stmy0007']         = "Total online time:";
$lang['stmy0008']         = "Online time last 7 days:";
$lang['stmy0009']         = "Online time last 30 days:";
$lang['stmy0010']         = "Achievements completed:";
$lang['stmy0011']         = "Time achievement progress";
$lang['stmy0012']         = "Time: Legendary";
$lang['stmy0013']         = "Because you have an online time of %s  hours.";
$lang['stmy0014']         = "Progress completed";
$lang['stmy0015']         = "Time: Gold";
$lang['stmy0016']         = "% Completed for Legendary";
$lang['stmy0017']         = "Time: Silver";
$lang['stmy0018']         = "% Completed for Gold";
$lang['stmy0019']         = "Time: Bronze";
$lang['stmy0020']         = "% Completed for Silver";
$lang['stmy0021']         = "Time: Unranked";
$lang['stmy0022']         = "% Completed for Bronze";
$lang['stmy0023']         = "Connection achievement progress";
$lang['stmy0024']         = "Connects: Legendary";
$lang['stmy0025']         = "Because You connected %s times to the server.";
$lang['stmy0026']         = "Connects: Gold";
$lang['stmy0027']         = "Connects: Silver";
$lang['stmy0028']         = "Connects: Bronze";
$lang['stmy0029']         = "Connects: Unranked";
$lang['stnv0001']         = "Server news";
$lang['stnv0002']         = "Close";
$lang['stnv0003']         = "Refresh client information";
$lang['stnv0004']         = "Only use this refresh, when your TS3 information got changed, such as your TS3 username";
$lang['stnv0005']         = "It only works, when you are connected to the TS3 server at the same time";
$lang['stnv0006']         = "Refresh";
$lang['stnv0007']         = "Battle area - Page content";
$lang['stnv0008']         = "You can challenge other users in a battle between two users or two teams.";
$lang['stnv0009']         = "While the battle is active the online time of the teams/users will be counted.";
$lang['stnv0010']         = "When the battle ends the team/user with the highest online time wins.";
$lang['stnv0011']         = "(The regular battling time is 48 hours)";
$lang['stnv0012']         = "The winning team/user will recieve a price, which the user can use whenever the user wants.";
$lang['stnv0013']         = "It will be displayed on the <a href=\"my_stats.php\">My statistics</a> tab.";
$lang['stnv0014']         = "(Could be online time boost(2x) for 8 hours, instant online time (4 hours), etc.";
$lang['stnv0015']         = "These boosts can be used for example to climb in the top users of the week)";
$lang['stnv0016']         = "Not available";
$lang['stnv0017']         = "You are not connected to the TS3 Server, so it can't display any data for you.";
$lang['stnv0018']         = "Please connect to the TS3 Server and then Refresh your Session by pressing the blue Refresh Button at the top-right corner.";
$lang['stnv0019']         = "My statistics - Page content";
$lang['stnv0020']         = "This page contains a overall summary of your personal statistics and activity on the server.";
$lang['stnv0021']         = "The informations are collected since the beginning of the Ranksystem, they are not since the beginning of the TeamSpeak server.";
$lang['stnv0022']         = "This page receives its values out of a database. So the values might be delayed a bit.";
$lang['stnv0023']         = "The sum inside of the donut charts may differ to the amount of 'Total user'. The reason is that this data weren't collected with older versions of the Ranksystem.";
$lang['stnv0024']         = "Ranksystem - Statistics";
$lang['stnv0025']         = "Limit entries";
$lang['stnv0026']         = "all";
$lang['stnv0027']         = "The informations on this site could be outdated! It seems the Ranksystem is no more connected to the TeamSpeak.";
$lang['stnv0028']         = "(Not connected to TS3!)";
$lang['stnv0029']         = "List Rankup";
$lang['stnv0030']         = "Ranksystem info";
$lang['stnv0031']         = "DE - Deutsch";
$lang['stnv0032']         = "EN - English";
$lang['stnv0033']         = "RU - русский";
$lang['stri0001']         = "Ranksystem information";
$lang['stri0002']         = "What is the Ranksystem?";
$lang['stri0003']         = "A TS3 Bot, which automatically grant ranks (servergroups) to user on a TeamSpeak 3 Server for online time or online activity. It also gathers informations and statistics about the user and displays the result on this site.";
$lang['stri0004']         = "Who created the Ranksystem?";
$lang['stri0005']         = "When the Ranksystem was Created?";
$lang['stri0006']         = "First alpha release: 05/10/2014.";
$lang['stri0007']         = "First beta release: 01/02/2015.";
$lang['stri0008']         = "You can see the newest version on the <a href=\"http://ts-n.net/ranksystem.php\" target=\"_blank\">Ranksystem Website</a>.";
$lang['stri0009']         = "How was the Ranksystem created?";
$lang['stri0010']         = "The Ranksystem is coded in";
$lang['stri0011']         = "It uses also the following libraries:";
$lang['stri0012']         = "Special Thanks To:";
$lang['stri0013']         = "<a href=\"http://nya-pw.ru/\" target=\"_blank\">sergey</a> - for russian translation";
$lang['stri0014']         = "Bejamin Frost - for initialisation the bootstrap design";
$lang['sttw0001']         = "Top users";
$lang['sttw0002']         = "Of the week";
$lang['sttw0003']         = "With %s hours online time";
$lang['sttw0004']         = "Top 10 compared";
$lang['sttw0005']         = "Hours (Defines 100 %)";
$lang['sttw0006']         = "%s hours (%s&#37;)";
$lang['sttw0007']         = "Top 10 Statistics";
$lang['sttw0008']         = "Top 10 vs others in online time";
$lang['sttw0009']         = "Top 10 vs others in active time";
$lang['sttw0010']         = "Top 10 vs others in inactive time";
$lang['sttw0011']         = "Top 10 (in hours)";
$lang['sttw0012']         = "Other %s users (in hours)";
$lang['sttm0001']         = "Of the month";
$lang['stta0001']         = "Of all time";
$lang['updb']             = "You only have to run this if you want to update the Ranksystem from an older version to %s!<br><br>Run this once time and delete the update_%s.php file after from your webserver.<br><br><br>Update Database:<br>";
$lang['updel']            = "Please remove the following files from the root directory of the ranksystem, if they are still existing:<br>%s";
$lang['upinf']            = "A new Version of the Ranksystem is available; Inform clients on server...";
$lang['upmov']            = "Please move the \'%s\' into the subfolder \'%s\' and overwrite the existing one!";
$lang['upmsg']            = "\nHey, a new version of the [B]Ranksystem[/B] is available!\n\ncurrent version: %s\n[B]new version: %s[/B]\n\nPlease check out our site for more informations [URL]http://ts-n.net/ranksystem.php[/URL].";
$lang['upsucc']           = "Database update successfully executed.";
$lang['upuser']           = "User %s (unique Client-ID: %s; Client-database-ID %s) gets a new count (sum. online time) of %s (thereof active %s).";
$lang['upuserboost']      = "User %s (unique Client-ID: %s; Client-database-ID %s) gets a new count (sum. online time) of %s (thereof active %s) <b>[BOOST %sx]</b>.";
$lang['upusrerr']         = "The unique Client-ID %s couldn't reached on the TeamSpeak!";
$lang['upusrinf']         = "User %s was successfully informed.";
$lang['user']             = "Username: ";
$lang['usermsgactive']    = "\nHey, you got a rank up, cause you reached an activity of %s days, %s hours, %s minutes and %s seconds.";
$lang['usermsgonline']    = "\nHey, you got a rank up, cause you reached an online time of %s days, %s hours, %s minutes and %s seconds.";
$lang['wiaction']         = "action";
$lang['wibgco']           = "Background color:";
$lang['wibgcodesc']       = "Define a background color.<br>(valid HTML Code; have to beginn with # )";
$lang['wiboost']		  = "boost";
$lang['wiboostdesc']	  = "Give an user on your TeamSpeak server a servergroup (have to be created manually), which you can declare here as boost group. Define also a factor which should be used (for example 2x) and a time, how long the boost should be rated.<br>The higher the factor, the faster an user reaches the next higher rank.<br>Is the time expired, the boost servergroup get automatically removed from the concerned user. The time starts running as soon as the user gets the servergroup.<br><br>servergroup ID => factor => time (in seconds)<br><br>Each entry have to separate from next with a comma.<br><br>Example:<br>12=>2=>6000,13=>3=>2500,14=>5=>600<br><br>On this an user in servergroup 12 get the factor 2 for the next 6000 seconds, an user in servergroup 13 get the factor 3 for 2500 seconds, and so on...";
$lang['wichdbid']         = "Client-database-ID reset";
$lang['wichdbiddesc']     = "Reset the online time of an user, if his TeamSpeak Client-database-ID changed.<br><br>Example:<br>If a clients gets removed from the TeamSpeak server, it gets a new Client-database-ID with the next connect to the server.";
$lang['wiconferr']        = "There is an error in the configuration of the Ranksystem. Please go to the webinterface and correct the Core Settings. Especially check the config 'rank up'!";
$lang['widaform']         = "Date format";
$lang['widaformdesc']     = "Choose the showing date format.<br><br>Example:<br>%a days, %h hours, %i mins, %s secs";
$lang['widbcfgsuc']       = "Database configurations saved successfully.";
$lang['widbcfgerr']       = "Error by saving the database configurations! Connection failed or writeout error for 'other/dbconfig.php'";
$lang['widelcld']         = "delete clients";
$lang['widelcldgrp']      = "renew groups";
$lang['widelcldgrpdesc']  = "The Ranksystem remember the given servergroups, so it don't need to give/check this with every run of the worker.php again.<br><br>With this function you can remove once time the knowledge of given servergroups. In effect the ranksystem try to give all clients (which are on the TS3 server online) the servergroup of the actual rank.<br>For each client, which gets the group or stay in group, the Ranksystem remember this like described at beginning.<br><br>This function can be helpful, when user are not in the servergroup, they should be for the defined online time.<br><br>Attention: Run this in a moment, where the next few minutes no rankups become due!!! The Ranksystem can't remove the old group, cause he can't remember ;-)";
$lang['widelclddesc']     = "Delete the before selected clients out of the Ranksystem database.<br><br>With this deletion are the clients on the TeamSpeak Server untouched.";
$lang['widelsg']          = "remove out of servergroups";
$lang['widelsgdesc']      = "Choose if the clients should also be removed out of the last known servergroup, when you delete clients out of the Ranksystem database.<br><br>It will only considered servergroups, which concerned the Ranksystem";
$lang['wideltime']        = "Deletiontime";
$lang['wideltimedesc']    = "Clean old clients out of the Ranksystem database.<br>Entry a time in seconds which a client was not seen to delete it.<br><br>0 - deletes all clients out of the Ranksystem<br><br>The Userdatas on the TeamSpeak server are with this untouched!";
$lang['wiexgrp']          = "servergroup exception";
$lang['wiexgrpdesc']      = "A comma seperated list of servergroup-IDs, which should not conside for the Ranksystem.<br>User in at least one of this servergroups IDs will be ignored for the rank up.";
$lang['wiexuid']          = "client exception";
$lang['wiexuiddesc']      = "A comma seperated list of unique Client-IDs, which should not conside for the Ranksystem.<br>User in this list will be ignored for the rank up.";
$lang['wigrptime']        = "rank up";
$lang['wigrptimedesc']    = "Define here after which time a user should get automatically a predefined servergroup.<br><br>time (seconds)=>servergroup ID<br><br>Important for this is the online time of an user or if 'Idletime' is active, the active time.<br><br>Each entry have to separate from next with a comma.<br><br>The time must be entered cumulative<br><br>Example:<br>60=>9,120=>10,180=>11<br><br>On this a user get after 60 seconds the servergroup 9, in turn after 60 seconds the servergroup 10, and so on...";
$lang['wihdco']           = "Headline color:";
$lang['wihdcodesc']       = "Define a headline color.<br>(valid HTML Code; have to beginn with # )";
$lang['wihl']             = "Webinterface - Ranksystem";
$lang['wihladm']          = "admin list";
$lang['wihlcfg']          = "Core settings";
$lang['wihlclg']          = "Edit clients (global)";
$lang['wihlcls']          = "Edit clients (selective)";
$lang['wihldb']           = "Database settings";
$lang['wihlsty']          = "Style settings";
$lang['wihlts']           = "TeamSpeak settings";
$lang['wihvco']           = "Hover color:";
$lang['wihvcodesc']       = "Define a hover color.<br>(valid HTML Code; have to beginn with # )";
$lang['wiifco']           = "Infotext color:";
$lang['wiifcodesc']       = "Define a info-text color.<br>(valid HTML Code; have to beginn with # )";
$lang['wilog']            = "Logpath";
$lang['wilogdesc']        = "Path of the log file of the Ranksystem.<br><br>Example:<br>/var/logs/ranksystem/<br><br>Be sure, the webuser has the write-permissions to the logpath.";
$lang['wilogout']         = "LogOut";
$lang['wimsgusr']         = "Notification";
$lang['wimsgusrdesc']     = "Inform an user with a private text message about his rank up.<br>Define the message in 'lang.php'<br>(usermsgonline or usermsgactive)";
$lang['wiscco']           = "Successtext color:";
$lang['wisccodesc']       = "Define a success-text color.<br>(valid HTML Code; have to beginn with # )";
$lang['wiselcld']         = "select clients";
$lang['wiselclddesc']     = "Select the clients by the last known username. For this you only have to start typing.<br>Multiple selections are comma separated, which does the system automatically.<br><br>With the selection you can choose with the next step an action.";
$lang['wishcolas']        = "actual servergroup";
$lang['wishcolasdesc']    = "Show column 'actual servergroup' in list_rankup.php";
$lang['wishcolat']        = "active time";
$lang['wishcolatdesc']    = "Show column 'sum. active time' in list_rankup.php";
$lang['wishcolcld']       = "Client-name";
$lang['wishcolclddesc']   = "Show column 'Client-name' in list_rankup.php";
$lang['wishcoldbid']      = "database-ID";
$lang['wishcoldbiddesc']  = "Show column 'Client-database-ID' in list_rankup.php";
$lang['wishcolit']        = "idle time";
$lang['wishcolitdesc']    = "Show column 'sum idle time' in list_rankup.php";
$lang['wishcolls']        = "last seen";
$lang['wishcollsdesc']    = "Show column 'last seen' in list_rankup.php";
$lang['wishcolnx']        = "next rank up";
$lang['wishcolnxdesc']    = "Show column 'next rank up' in list_rankup.php";
$lang['wishcolot']        = "online time";
$lang['wishcolotdesc']    = "Show column 'sum. online time' in list_rankup.php";
$lang['wishcolrg']        = "rank";
$lang['wishcolrgdesc']    = "Show column 'rank' in list_rankup.php";
$lang['wishcolsg']        = "next servergroup";
$lang['wishcolsgdesc']    = "Show column 'next servergroup' in list_rankup.php";
$lang['wishcoluuid']      = "Client-ID";
$lang['wishcoluuiddesc']  = "Show column 'unique Client-ID' in list_rankup.php";
$lang['wishexcld']        = "excepted client";
$lang['wishexclddesc']    = "Show clients in list_rankup.php,<br>which are excepted by his uniqueID.";
$lang['wishexgrp']        = "excepted groups";
$lang['wishexgrpdesc']    = "Show clients in list_rankup.php, which are in the list 'client exception' and shouldn't be conside for the Ranksystem.";
$lang['wishgen']          = "Sitegen";
$lang['wishgendesc']      = "Show the needed time for the generation of the site at the end of the site.";
$lang['wishhicld']        = "Clients in highest Level";
$lang['wishhiclddesc']    = "Show clients in list_rankup.php, which reached the highest level in the Ranksystem.";
$lang['wisupidle']        = "Idletime";
$lang['wisupidledesc']    = "If this function is active, the 'sum. idle time' will be substrate from the 'sum. online time'. Instead of the 'sum. online time', the previoused substration will consided for the rank up.";
$lang['wisvconf']         = "save";
$lang['wisvsuc']          = "Changes successfully saved!";
$lang['witime']           = "Timezone";
$lang['witimedesc']       = "Select the timezone the server is hosted.";
$lang['wits3dch']         = "Default Channel";
$lang['wits3dchdesc']     = "The channel-ID, the bot should connect with.<br><br>The Bot will join this channel after connecting to the TeamSpeak server.";
$lang['wits3host']        = "TS3 Hostaddress";
$lang['wits3hostdesc']    = "TeamSpeak 3 Server address<br>(IP oder DNS)";
$lang['wits3sm']  		  = "Slowmode";
$lang['wits3smdesc']  	  = "With the Slowmode you can reduce \"spam\" of query commands to the TeamSpeak server. This prevent bans in case of flood.<br>TeamSpeak Query commands get delayed with this function.<br><br>!!! ALSO IT REDUCE THE CPU USAGE !!!<br><br>The activation is not recommended, if not required. The delay increases the duration of the Bot, which makes it imprecisely.";
$lang['wits3qnm']         = "Botname";
$lang['wits3qnm2']        = "2nd Botname";
$lang['wits3qnm2desc']    = "A fallback Botname, if the first one is already in use.";
$lang['wits3qnmdesc']     = "The name, with this the query-connection will be established.<br>You can name it free.";
$lang['wits3querpw']      = "TS3 Query-Password";
$lang['wits3querpwdesc']  = "TeamSpeak 3 query password<br>Password for the query user.";
$lang['wits3querusr']     = "TS3 Query-User";
$lang['wits3querusrdesc'] = "TeamSpeak 3 query username<br>Default is serveradmin<br>Of course, you can also create an additional serverquery account only for the Ranksystem.<br>The needed permissions you find on:<br>http://ts-n.net/ranksystem.php";
$lang['wits3query']       = "TS3 Query-Port";
$lang['wits3querydesc']   = "TeamSpeak 3 query port<br>Default is 10011 (TCP)<br>If its not default, you should find it in your 'ts3server.ini'.";
$lang['wits3voice']       = "TS3 Voice-Port";
$lang['wits3voicedesc']   = "TeamSpeak 3 voice port<br>Default is 9987 (UDP)<br>This is the port, you uses also to connect with the TS3 Client.";
$lang['witxco']           = "Text color:";
$lang['witxcodesc']       = "Define a text color.<br>(valid HTML Code; have to beginn with # )";
$lang['wiupcheck']        = "Update-Check";
$lang['wiupcheckdesc']    = "If the Update-Check is enable, the listed user gets a notification with a private text message, once an update is available.";
$lang['wiuptime']         = "Checkinterval";
$lang['wiuptimedesc']     = "Enter here how much seconds have to gone till the Ranksystem should check for available updates.<br>Attention, for each check the listed user gets a notification. If no one of the listed users is online, the Ranksystem will try to notificate with the next interval.";
$lang['wiupuid']          = "Recipient";
$lang['wiupuiddesc']      = "A comma separate list of unique Client-IDs, which shoud be informed on the TeamSpeak via private message for available updates.";
$lang['wiversion']        = "(current version %s)";
$lang['wivlang']          = "Language";
$lang['wivlangdesc']      = "Language for the Ranksystem<br><br>de - Deutsch<br>en - English<br>ru - русский";
$lang['wiwnco']           = "Warntext color:";
$lang['wiwncodesc']       = "Define a warntext color.<br>(valid HTML Code; have to beginn with # )";
?>
