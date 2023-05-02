<?php
use App\Business\Managers\CommunicationManager;

if (!function_exists( 'get_site_url' )) {
	function get_site_url( $app_id = null, $path = '', $scheme = null ) {
	    if ( empty( $app_id ) && isset($_SERVER['HTTPS']) && isset($_SERVER['HTTP_HOST']) ) {
	        // $url = 'http://leads.local:8080';
	        $url = ( (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] )  ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
	    } else {
	        $url = '/';
	    }
	 
	    if ( $path && is_string( $path ) ) {
	        $url .= '/' . ltrim( $path, '/' );
	    }
	 
	    return $url;
	}
}

if (!function_exists( 'instance' )) {
	function instance($serviceName = '')
	{
		if ( $serviceName == '' ) {
			return \App::instance();
		}
		$service = \App::instance()->service($serviceName);
		return $service;
	}
}

if (!defined("ROOT_URL") ){
	define('ROOT_URL', get_site_url(null, '/' . env('DASHBOARD_DIRECTORY', 'dashboard/')));
}

function prompt_silent($prompt = "Enter Password:") {
  if (preg_match('/^win/i', PHP_OS)) {
    $vbscript = sys_get_temp_dir() . 'prompt_password.vbs';
    file_put_contents(
      $vbscript, 'wscript.echo(InputBox("'
      . addslashes($prompt)
      . '", "", "password here"))');
    $command = "cscript //nologo " . escapeshellarg($vbscript);
    $password = rtrim(shell_exec($command));
    unlink($vbscript);
    return $password;
  } else {
    $command = "/usr/bin/env bash -c 'echo OK'";
    if (rtrim(shell_exec($command)) !== 'OK') {
      trigger_error("Can't invoke bash");
      return;
    }
    $command = "/usr/bin/env bash -c 'read -s -p \""
      . addslashes($prompt)
      . "\" mypassword && echo \$mypassword'";
    $password = rtrim(shell_exec($command));
    echo "\n";
    return $password;
  }
}

if (!function_exists('pluralize')) {
	function pluralize($text)
	{
		$irregularWords = [
			'todo'=>'todos', 'person'=>'people', 'man'=>'men', 'woman'=>'women', 'child'=>'children', 'mouse'=>'mice', 'foot'=>'feet', 'goose'=>'geese', 'die'=>'dice',
		];

		// Largely animals
		$identicals = [
			'news', 'fish', 'sheep', 'moose', 'swine', 'buffalo', 'shrimp', 'trout'
		];

		if ( in_array($text, $identicals) ) {
			$plural = $text;
		} elseif ( in_array($text, array_keys($irregularWords)) ) {
			$plural = $irregularWords[$text];
		} elseif (substr($text, -1) == 'y' && substr($text, -2) != 'ay' && substr($text, -2) != 'ey' && substr($text, -2) != 'iy' && substr($text, -2) != 'oy' && substr($text, -2) != 'uy') {
			$plural = substr($text, 0, -1) . 'ies';
		} elseif (substr($text, -1) == 's' || substr($text, -2) == 'sh' || substr($text, -2) == 'ch' || substr($text, -2) == 'ss' || substr($text, -1) == 'x' || substr($text, -1) == 'z' || substr($text, -1) == 'o') {
			$plural = $text . 'es';
		} elseif (substr($text, -1) == 'f') {
			$plural = substr($text, 0, -1) . 'ves';
		} elseif (substr($text, -2) == 'fe') {
			$plural = substr($text, 0, -2) . 'ves';
		} elseif (substr($text, -2) == 'us') {
			$plural = substr($text, 0, -2) . 'i';
		} elseif (substr($text, -2) == 'is') {
			$plural = substr($text, 0, -2) . 'es';
		} elseif ((substr($text, -2) == 'on' && substr($text, -4) != 'tion' && strlen($text) > 4) || (substr($text, -2) == 'um' && substr($text, -3) == 'rum')) {
			$plural = substr($text, 0, -2) . 'a';
		} elseif (substr($text, -2) == 'ex') {
			$plural = substr($text, 0, -2) . 'ices';
		} else {
			$plural = $text . 's';
		}

	    return $plural;
	}
}


if (!function_exists('slugify')) {
	function slugify($string)
	{
	    // Replace non-alphanumeric characters with hyphens
	    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	    
	    // Convert the string to lowercase
	    $slug = strtolower($slug);
	    
	    // Trim hyphens from the beginning and end of the string
	    $slug = trim($slug, '-');
	    
	    return $slug;
	}
}

if (!function_exists('tell')) {
    function tell(string $content, string $channel = null, int $userId = null, array $attachments = [], array $parameters = [])
    {
        return CommunicationManager::send($content, $channel, $userId, false, $attachments, $parameters);
    }
}

if (!function_exists('ask')) {
    function ask(string $content, string $channel = null, int $userId = null, array $attachments = [], array $parameters = [])
    {
        return CommunicationManager::send($content, $channel, $userId, true, $attachments, $parameters);
    }
}

if (!function_exists('whisper')) {
	function whisper(string $content, int $userId = null, array $attachments = [], array $parameters = [])
	{
	    return CommunicationManager::send($content, null, $userId, $attachments, $parameters, true);
	}
}

if (!function_exists('store')) {
    function store($name, $value = null)
    {
        if (php_sapi_name() === 'cli') {
            // CLI environment: use DiskStorage
            $storagePath = OPUS_ROOT.'storage/data';
            if (!is_dir($storagePath)) {
	            mkdir($storagePath, 0777, true);
	        }
            $diskStorage = new \BlueFission\Data\Storage\Disk([
                'location' => $storagePath, // Set your desired storage path
                'name' => 'cli_storage.json'     // Set your desired storage file name
            ]);
            $diskStorage->activate();
            $storedData = $diskStorage->read() ?? [];

            if ($value === null) {
                // Return the value if $value is null
                return isset($storedData[$name]) ? $storedData[$name] : null;
            }

            $storedData[$name] = $value;
            $diskStorage->assign($storedData);
            $diskStorage->contents(json_encode($storedData));
            $diskStorage->write();
            unset($diskStorage);
        } else {
            // HTTP environment: use sessions
            return BlueFission\Net\HTTP::session($name, $value);
        }
    }
}
