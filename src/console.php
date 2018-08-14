<?php
/**
 * Project : Beech command line interface (CLI)
 * Version : 2.0
 * Author  : bombkiml
 * Built   : Aug 14 2018 09:19:09
 *
 */

// Die if not the command line.
if (!php_sapi_name() == 'cli' OR !empty($_SERVER['REMOTE_ADDR'])) {
    header("HTTP/1.0 403 Forbidden");
    exit('Beat It.');
}

class Console extends Exception {

    /**
     * Properties
     * 
     * @param Array $argv
     * @param Text $beech
     * @param Text $command
     * @param Text $option
     * @param Text $argument
     * @param Text $specail
     * 
     */
    private static $argv = null;
    private static $beech = null;
    private static $command = null;
    private static $option = null;
    private static $argument = null;
    private static $special = null;

    public function __construct($argv) {
        try {            
            self::properties($argv);
            if(!self::$command) {
                self::help();
            } else {
                self::init();
            }
        } catch(Exception $e) {
            throw $e;
        }        
    }

    private function init() {
        foreach(self::$argv as $key => $arg) {
            if($key != 0) :
                /**
                * Arguments case
                * 
                */        
                if (strcmp(substr($arg, 0, 1), '-') == 0) {
                    self::arguments($arg);
                    
                /**
                * Nomaly case
                * 
                */
                } elseif(strcmp(basename(__FILE__), $arg) != 0) {                        
                    if(!empty($arg)) {
                        /**
                        * Initialize beech (CLI)
                        *
                        */
                        if($arg == 'init') {
                            self::entryInit();
                                
                        /**
                        * Make something
                        *
                        */
                        } elseif(preg_match("/\bmake:/", $arg)) {
                            self::make($arg, self::$option);
                            #die();
                            
                        /**
                        * PHP development server
                        * 
                        * @php beech framework supported
                        *
                        */
                        } elseif($arg == "serve") {
                            self::devServer();
                        } else {
                            self::callEntry($arg);
                        }
                    } else {

                    }
                }
            endif;
        }
        
    }

    private function arguments($arg) {
        // Beech-cli version 
        if ($arg == '-v' || $arg == '--version') {
            die("\n Beech v2.0 (cli) \n Author: bombkiml \n Built: Aug 10 2018 21:19:09 \n");
        
        // List structure
        } elseif ($arg == '-l' || $arg == '--list') {
            if(!file_exists('.\databases\entry')) {
                die("\n fatal: The `.\databases\\entry` folder not found, please initiate entry by `init` command. \n");
            }
            $filenames = glob('.\databases\entry\*');
            if(count($filenames) === 0) {
                die("\n The entry class file is empty, make it. \n $ php beech make:entry {Foobar} \n");
            }
            echo "\n";
            foreach ($filenames as $filename) {
                echo " {$filename}". PHP_EOL;
            }

        // beech-cli help
        } elseif ($arg == '-?' || $arg == '-h' || $arg == '--help') {
            self::help();

        // not everthing
        } else {
            self::help();
        }
    }

    private function entryInit() {
        if(!file_exists(".\\databases\\entry")) {
            if(mkdir(".\\databases\\entry", 0777, true)) {
                die("\n Initiate... \n  .\\databases\ \n  .\\databases\\entry \n\n ~ source folder .\\databases\\entry \n\n It work ! initiated is successfully. \n");
            }	
        } else {
            die("\n The Beech (cli) is initiated already. \n  ~ source folder .\\databases\\entry \n");
        }
    }

    private function make($arg, $className = null) {
        switch($make = explode(':', $arg)[1]) {
            /**
             * @make:entry
             * 
             */
            case 'entry':
                // check entry store exists.
                if(!file_exists(".\\databases\\entry")) {
                    die("\n fatal: The `.\\databases\\entry` folder not found, please initiate entry by `init` command. \n");
                }
                // check specify entry name
                if(!$className) {
                    die("\n Please specify entry name. \n");
                }
                // check class is duplicate
                foreach (scandir(".\\databases\\entry") as $fileName) {
                    if(explode('.', $fileName)[0] === $className) {
                        die("\n The class `{$className}` is duplicate. \n");
                    }
                }
                // Read file content
                $fileContent = file_get_contents(__DIR__.'./tmpEntry.php');
                // do the replacements, modifications, etc. on $fileContent
                // This is just an example
                $fileContent = str_replace('{{className}}', $className, $fileContent);
                // write the content to a new file
                if(file_put_contents(".\\databases\\entry\\{$className}.php", $fileContent)) {
                    die("\n make the entry `{$className}` is successfully. \n");
                } else {
                    die("\n make the entry failed. Please try again. \n");
                }
            break;
            /**
             * @make:controller
             * 
             */
            case 'controller':
                // check controller store exists.
                if(!file_exists(".\\modules\\controllers")) {
                    die("\n fatal: The `.\\modules\\controllers` folder not found. \n");
                }
                // check specify controller name
                if(!$className) {
                    die("\n Please specify controller name. \n");
                }
                // check include subfolder
                $masterName = explode('/', $className);
                if(count($masterName) > 1) {
                    $endClassName = end($masterName);
                    array_pop($masterName);
                    $subfolder = implode('\\', $masterName);
                    if(!file_exists(".\\modules\\controllers\\{$subfolder}")) {
                        if(!mkdir(".\\modules\\controllers\\{$subfolder}", 0777, true)) {
                            die("\n fatal: something error please try again. \n");
                        }
                    }
                    // next new className
                    $className = $subfolder ."\\". $endClassName;
                }
                // check class is duplicate
                foreach (scandir(".\\modules\\controllers\\". @$subfolder) as $fileName) {
                    $file = explode('.php', $fileName);
                    $file = trim(@$subfolder ."\\". current($file), "\\");
                    if($file === $className) {
                        die("\n The class `{$className}` is duplicate. \n");
                    }
                }
                // Read file content
                $fileContent = file_get_contents(__DIR__.'./tmpController.php');
                // do the replacements, modifications, etc. on $fileContent
                // This is just an example
                $classNameReplace = explode("\\", $className);
                $fileContent = str_replace('{{className}}', end($classNameReplace), $fileContent);
                // write the content to a new file
                if(file_put_contents(".\\modules\\controllers\\{$className}.php", $fileContent)) {
                    die("\n make the controller `{$className}` is successfully. \n");
                } else {
                    die("\n make the controller failed. Please try again. \n");
                }
            break;
            /**
             * @make:model
             * 
             */
            case 'model':
                // check model store exists.
                if(!file_exists(".\\modules\\models")) {
                    die("\n fatal: The `.\\modules\\models` folder not found. \n");
                }
                // check specify model name
                if(!$className) {
                    die("\n Please specify model name. \n");
                }
                // check include subfolder
                $masterName = explode('/', $className);
                if(count($masterName) > 1) {
                    $endClassName = end($masterName);
                    array_pop($masterName);
                    $subfolder = implode('\\', $masterName);
                    if(!file_exists(".\\modules\\models\\{$subfolder}")) {
                        if(!mkdir(".\\modules\\models\\{$subfolder}", 0777, true)) {
                            die("\n fatal: something error please try again. \n");
                        }
                    }
                    // next new className
                    $className = $subfolder ."\\". $endClassName;
                }
                // check class is duplicate
                foreach (scandir(".\\modules\\models\\". @$subfolder) as $fileName) {
                    $file = explode('.php', $fileName);
                    $file = trim(@$subfolder ."\\". current($file), "\\");
                    if($file === $className) {
                        die("\n The class `{$className}` is duplicate. \n");
                    }
                }
                // Read file content
                $fileContent = file_get_contents(__DIR__.'./tmpModel.php');
                // do the replacements, modifications, etc. on $fileContent
                // This is just an example
                $classNameReplace = explode("\\", $className);
                $fileContent = str_replace('{{className}}', end($classNameReplace), $fileContent);
                // write the content to a new file
                if(file_put_contents(".\\modules\\models\\{$className}.php", $fileContent)) {
                    die("\n make the model `{$className}` is successfully. \n");
                } else {
                    die("\n make the model failed. Please try again. \n");
                }
            break;
            /**
             * @make:view
             * 
             */
            case 'view':
                // check view store exists.
                if(!file_exists(".\\views")) {
                    die("\n fatal: The `.\\views` folder not found. \n");
                }
                // check specify view name
                if(!$className) {
                    die("\n Please specify view name. \n");
                }
                // check include subfolder
                $masterName = explode('/', $className);
                if(count($masterName) > 1) {
                    $endClassName = end($masterName);
                    array_pop($masterName);
                    $subfolder = implode('\\', $masterName);
                    if(!file_exists(".\\views\\{$subfolder}")) {
                        if(!mkdir(".\\views\\{$subfolder}", 0777, true)) {
                            die("\n fatal: something error please try again. \n");
                        }
                    }
                    // next new className
                    $className = $subfolder ."\\". $endClassName;
                }
                // include .view
                $className = $className.'.view';
                // check view is duplicate
                foreach (scandir(".\\views\\". @$subfolder) as $fileName) {
                    $file = explode('.php', $fileName);
                    $file = trim(@$subfolder ."\\". current($file), "\\");
                    if($file === $className) {
                        die("\n The view `{$className}` is duplicate. \n");
                    }
                }
                // argument passer
                if(self::$argument == '--blog') {
                    // Read file content (bootstrap)
                    $fileContent = file_get_contents(__DIR__.'./tmpViewBootstrap.php');
                } elseif(self::$argument == '--html') {
                    // Read file content
                    $fileContent = file_get_contents(__DIR__.'./tmpViewHtml.php');
                } else {
                    // Read file content
                    $fileContent = file_get_contents(__DIR__.'./tmpViewBlank.php');
                }
                // do the replacements, modifications, etc. on $fileContent
                // This is just an example
                $fileContent = str_replace('{{className}}', $className, $fileContent);
                // write the content to a new file
                if(file_put_contents(".\\views\\{$className}.php", $fileContent)) {
                    die("\n make the view `{$className}` is successfully. \n");
                } else {
                    die("\n make the view failed. Please try again. \n");
                }
            break;
            default:
                die("\n command `make:{$make}` is incorrect. \n\n The most similar command is: \n  make:entry \n  make:controller \n  make:model \n  make:view \n");
            break;
        }
    }

    private function devServer() {
        // Set default port is 8000
        $port = 8000;
        if(@self::$option) {
            if (strcmp(substr(@self::$option, 0, 1), '-') == 0) {
                if (self::$option == '-p' OR self::$option == '--port') {
                    if(!@self::$argument) {
                        die("\n Please specify port your server. \n");
                    } else {
                        if(is_numeric(self::$argument)) {
                            $port = (self::$argument)?self::$argument:$port;
                        } else {
                            die("\n Please specify port is numeric. \n");
                        }
                    }
                } else {
                    die("\n Unknown `{self::$option}` options, make sure specify option word. \n");
                }
            } else {
                die("\n Unknown `{self::$option}` options, make sure specify option word. \n");
            }
        }
        // Start php server
        echo("Beech development server started: <http://localhost:{$port}> \n");
        shell_exec("php -S localhost:{$port} public/index.php");
    }

    private function callEntry($arg) {
        // Require class files
        $entryPath = explode('/', $arg);
        $file = ".\\databases\\entry\\{$entryPath[0]}.php";
        if(file_exists($file)) {
            require $file;
        } else {
            die("\n The Class `{$entryPath[0]}()` doesn't exists, Do you have file in .\\databases\\entry\\{$entryPath[0]}.php ? \n");
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
    
    private function help() {
        $helpFile = __DIR__.'.\help.txt';
        $handle = fopen($helpFile, 'r') or die("\n Cannot open help file: {$helpFile} \n");
        $text = fread($handle, fileSize($helpFile));
        fclose($handle);
        die($text);
    }

    private function properties($argv) {
        self::$argv = @$argv;
        self::$beech = @$argv[0];
        self::$command = @$argv[1];
        self::$option = @$argv[2];
        self::$argument = @$argv[3];
        self::$special = @$argv[4];
    }
}

// Engine start
new Console($argv);
