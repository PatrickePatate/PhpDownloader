<?php
$json = $argv[1];
If (isset($argv[1])){
	If (!empty($argv[1])){
		If(strstr($argv[1], '.json', true)){
			$json = realpath($json);
			$handle = fopen($json, "r");
			$contents = fread($handle, filesize($json));
			fclose($handle);

			$json_decoded = json_decode($contents, true);
			If (isset($json_decoded)){
				If(!empty($json_decoded)){
					If (isset($json_decoded['wget'])){
				        echo "\n\n\033[1;30;44m WGET SECTION \033[0m\n";
				        foreach ($json_decoded['wget'] as $key => $value) {
				                echo "\n\n\033[1;33;40m Fichier: ".$key." | URL : ".$value." \033[0m\n";
				                shell_exec('wget '.$value);
				        }
				    }else{
				    	echo "\n\n\033[1;33;40m No wget section detected \033[0m\n";
				    }
					If (isset($json_decoded['curl'])){
							echo "\n\n\033[1;30;44m CURL SECTION \033[0m\n";
						    foreach ($json_decoded['curl'] as $key => $value) {
						        echo "\n\n\033[1;33;40m Fichier: ".$key." | URL : ".$value." \033[0m\n";
						        shell_exec('curl -O '.$value);
							}
					}else{
						echo "\n\n\033[1;33;40m No curl section detected \033[0m\n";
					}
				}
			}
		}
	}
}else{
	echo "\n\n\033[1;33;41m Warning: no json file specified ! \033[0m\n";
}

?>

