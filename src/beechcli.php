<?php
/**
 * Project : Beech Command Line Interface (CLI)
 * Version : 1.0.0
 * Author  : bombkiml
 * Built   : Aug 01 2018 23:30:09
 *
 */

// Die if not the command line.
if ( ! php_sapi_name() == 'cli' OR ! empty($_SERVER['REMOTE_ADDR'])) {
	header("HTTP/1.0 403 Forbidden");
	exit('Beat It.');
}

function died() {
	die("\n Beech Command Line Interface (CLI) 
		\n Usage: \n  command [options]
		\n Options: \n  -?|-h, --help \t\t\t\t Display this help message \n  -v, --version \t\t\t\t Display this application version \n  -l, --list \t\t\t\t\t Display all file in `entry` directory
		\n The following commands are available:
		\n Initialize \n  $ beech init \t\t\t\t\t Initialize for usage `Beech` 
		\n Call entry class \n  $ beech {class}/{method} \t\t\t To Call class and method. \n  $ beech {class}/{method}/{1}/{2}/{...} \t To Using parameter(s) in the method.
		\n Make \n  $ beech make:entry {Foobar} \t\t\t Create a new entry class \n  $ beech make:controller {FoobarController} \t Create a new controller class \n  $ beech make:model {Foobar} \t\t\t Create a new model class \n  $ beech make:view {foobar.view} \t\t Create a new view file 
		\n
		");
}

#print_r($argv);exit;

$in_args = array();

if(!@$argv[1]) {
	died();
}

foreach($argv as $key => $arg) {
	if($key != 0) :
	
        #print_r($arg);exit;
        
		if (strcmp(substr($arg, 0, 1), '-') == 0) {
            /**
             * Dash (-) case
             * 
             */
			if ($arg == '-v' OR $arg == '--version') {
				// version 
				die("\n Beech v1.0.0 (CLI) \n Author: bombkiml \n Built: Aug 01 2018 23:30:09 \n");
			} elseif ($arg == '-l' OR $arg == '--list') {
				// list structure
				echo "\n";
				foreach (glob('databases/entry/*') as $filename) {
					echo " ./{$filename}". PHP_EOL;
				}
			} elseif ($arg == '-p' OR $arg == '--password') {
				// nothing
			} elseif ($arg == '-?' OR $arg == '-h' OR $arg == '--help') {
				died();
			} else {
				died();
			}
		} elseif(strcmp(basename(__FILE__), $arg) != 0) {
            /**
             * Nomaly case
             * 
             */
			$in_args[] = $arg;
            #print_r($arg);exit;
            
			if(!empty($in_args)) {
                // Initialize beech (CLI)
				if($in_args[0] == 'init') {
					if(!file_exists('databases/entry')) {
						if(mkdir('databases/entry', 0777, true)) {
							die("\n Initiate... \n  .\\databases\ \n  .\\databases\\entry \n\n ~ source folder .\\databases\\entry \n\n It work ! initiated is successfully. \n");
						}	
					} else {
						die("\n The Beech (CLI) is initiated already. \n  ~ source folder .\\databases\\entry \n");
                    }
                    
                // Make something
				} elseif(preg_match("/\bmake:/", $in_args[0])) {
                    $className = @$argv[2];
                    if(!$className) {
                        die("\n Please specify make name. \n");
                    }
                    switch(explode(':', $in_args[0])[1]) {
                        case 'entry':
                            // check class is duplicate
                            foreach (scandir('databases/entry') as $fileName) {
                                if(explode('.', $fileName)[0] === $className) {
                                    die("\n Class `{$className}` is duplicate, Can't make entry. \n");
                                }
                            }
                            // Read file content
                            $fileContent = file_get_contents('./src/tmp/tmpEntry.php');
                            // do the replacements, modifications, etc. on $fileContent
                            // This is just an example
                            $fileContent = str_replace('{{className}}', $className, $fileContent);
                            // write the content to a new file
                            if(file_put_contents("./databases/entry/{$className}.php", $fileContent)) {
                                die("\n make entry `{$className}` is successfully. \n");
                            } else {
                                die("\n make entry failed. Please try again. \n");
                            }
                        break;
                        case 'controller':
                        
                            die("\n make controller is successfully. \n");
                        break;
                        case 'model':

                            die("\n make model is successfully. \n");
                        break;
                        case 'view':

                            die("\n make view is successfully. \n");
                        break;
                        default:
                            die("\n command `make` is incorrect. \n");
                        break;
                    }
                    die();
                }
            }
            

			// Require class files
			$entryPath = explode('/', $in_args[0]);
			$file = 'databases/entry/'. $entryPath[0].'.php';
			if(file_exists($file)) {
				require $file;
			} else {
				die("\n The Class `{$entryPath[0]}()` doesn't exists, Do you have file in ./databases/entry/{$entryPath[0]}.php ? \n");
			}

			// Using case by case
			switch(count($entryPath)) {
				// call class only
				case 1:
					die("\n It working. \n");
				break;
				// call class/method
				case 2:
					$obj = new $entryPath[0]();
					method_exists($obj, $entryPath[1]) ? $obj->{$entryPath[1]}() : die("\n The Medthod `{$entryPath[1]}()` doesn't exists, Do you have `{$entryPath[1]}()` in class {$entryPath[0]}() ? \n");
				break;
				// call class/method/param1
				case 3: 
					$obj = new $entryPath[0]();
					method_exists($obj, $entryPath[1]) ? $obj->{$entryPath[1]}($entryPath[2]) : die("\n The Medthod `{$entryPath[1]}(param1)` doesn't exists. \n");
				break;
				// call class/method/param1/param2
				case 4: 
					$obj = new $entryPath[0]();
					method_exists($obj, $entryPath[1]) ? $obj->{$entryPath[1]}($entryPath[2], $entryPath[3]) : die("\n The Medthod `{$entryPath[1]}(param1, param2)` doesn't exists. \n");
				break;
				// call class/method/param1/param1/param2/param3
				case 5: 
					$obj = new $entryPath[0]();
					method_exists($obj, $entryPath[1]) ? $obj->{$entryPath[1]}($entryPath[2], $entryPath[3], $entryPath[4]) : die("\n The Medthod `{$entryPath[1]}(param1, param2, param3)` doesn't exists. \n");
				break;
				// default not supported !
				default:
					die("\n Stopped !! \n The Beech (CLI) not supported. \n");
				break;
			}
		}
	endif;
}






