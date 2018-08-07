<?php
/**
 * Project : Beech Command Line Interface (CLI)
 * Version : 1.0.0
 * Author  : bombkiml
 * Built   : Aug 01 2018 23:30:09
 *
 */

// Die if not the command line.
if (!php_sapi_name() == 'cli' OR !empty($_SERVER['REMOTE_ADDR'])) {
    header("HTTP/1.0 403 Forbidden");
    exit('Beat It.');
}

function died() {
    $helpFile = __DIR__.'.\help.txt';
    $handle = fopen($helpFile, 'r') or die("\n Cannot open help file: {$helpFile} \n");
    $text = fread($handle, fileSize($helpFile));
    fclose($handle);
    die($text);
}

#print_r($argv);exit;

$in_args = array();

if(!@$argv[1]) {
    died();
}

foreach($argv as $key => $arg) {
    if($key != 0) :
	
        #print_r($arg);exit;
        
        /**
        * Dash (-) case
        * 
        */        
        if (strcmp(substr($arg, 0, 1), '-') == 0) {

            if ($arg == '-v' OR $arg == '--version') {
                // version 
                die("\n Beech v1.0.0 (CLI) \n Author: bombkiml \n Built: Aug 01 2018 23:30:09 \n");
            } elseif ($arg == '-l' OR $arg == '--list') {
                // list structure
                if(!file_exists('.\databases')) {
                    die("\n fatal: `databases/entry` folder not found. \n try: $ beech init \n");
                }
                $filenames = glob('.\databases\entry\*');
                if(count($filenames) === 0) {
                    die("\n The entry class file is empty, make it. \n $ beech make:entry {Foobar} \n");
                }
                echo "\n";
                foreach ($filenames as $filename) {
                    echo " {$filename}". PHP_EOL;
                }
            } elseif ($arg == '-p' OR $arg == '--password') {
                // nothing
            } elseif ($arg == '-?' OR $arg == '-h' OR $arg == '--help') {
                died();
            } else {
                died();
            }
            
        /**
        * Nomaly case
        * 
        */
        } elseif(strcmp(basename(__FILE__), $arg) != 0) {
            $in_args[] = $arg;
            #print_r($arg);exit;
                
            if(!empty($in_args)) {
                /**
                * Initialize beech (CLI)
                *
                */
                if($in_args[0] == 'init') {
                    if(!file_exists('.\databases\entry')) {
                        if(mkdir('.\databases\entry', 0777, true)) {
                            die("\n Initiate... \n  .\\databases\ \n  .\\databases\\entry \n\n ~ source folder .\\databases\\entry \n\n It work ! initiated is successfully. \n");
                        }	
                    } else {
                        die("\n The Beech (CLI) is initiated already. \n  ~ source folder .\\databases\\entry \n");
                    }
                        
                /**
                * Make something
                *
                */
                } elseif(preg_match("/\bmake:/", $in_args[0])) {
                    $className = @$argv[2];
                if(!$className) {
                    die("\n Please specify make name. \n");
                }
                switch(explode(':', $in_args[0])[1]) {
                    case 'entry':
                        // check class is duplicate
                        foreach (scandir('.\databases\entry') as $fileName) {
                            if(explode('.', $fileName)[0] === $className) {
                                die("\n Class `{$className}` is duplicate, Can't make entry. \n");
                            }
                        }
                        // Read file content
                        $fileContent = file_get_contents(__DIR__.'./tmpEntry.php');
                        // do the replacements, modifications, etc. on $fileContent
                        // This is just an example
                        $fileContent = str_replace('{{className}}', $className, $fileContent);
                        // write the content to a new file
                        if(file_put_contents(".\databases\entry\{$className}.php", $fileContent)) {
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
                    
                /**
                * PHP development server
                *
                */
                } elseif($in_args[0] == "serve") {
                    // Set default port is 8000
                    $port = 8000;
                    if(@$argv[2]) {
                        if (strcmp(substr(@$argv[2], 0, 1), '-') == 0) {
                            if ($argv[2] == '-p' OR $argv[2] == '--port') {
                                if(!@$argv[3]) {
                                    die("\n Please specify port your server. \n");
                                } else {
                                    if(is_numeric($argv[3])) {
                                        $port = ($argv[3])?$argv[3]:$port;
                                    } else {
                                        die("\n Please specify port is numeric. \n");
                                    }
                                }
                            } else {
                                die("\n Unknown `{$argv[2]}` options, make sure specify option word. \n");
                            }
                        } else {
                            die("\n Unknown `{$argv[2]}` options, make sure specify option word. \n");
                        }
                    }
                    // Start php server
                    echo("Beech development server started: <http://localhost:{$port}> \n");
                    shell_exec("php -S localhost:{$port} public/index.php");
                }
            }
            
            // Require class files
            $entryPath = explode('/', $in_args[0]);
            $file = '.\databases\entry\\'. $entryPath[0].'.php';
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
