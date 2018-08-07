# #PHP Beech Command line interface (CLI)
###### [(by bömb)](https://www.facebook.com/bombkiml)

[![N|Solid](https://preview.ibb.co/kqDX1K/beechcli_Plus_Beech.png)](https://github.com/bombkiml/beech-cli)

## #Support By
[![N|Solid](https://image.ibb.co/gfbtQe/beech_LTSx1.png)](https://github.com/bombkiml/phpbeech)

# #Installing
The Beech Command line interface (CLI) use Composer to manage it's dependencies. So, before using Beech (CLI), make sure you have [Composer](https://getcomposer.org/) installed on your machine. Download the Beech installer using Composer.
    
    $ composer require bombkiml/beech-cli

# #Beech help
    
     Beech Command Line Interface (CLI)
    
     Usage:
      $ beech [command] [options] [arguments]
    
     Options:
      -?|-h, --help                                  Display this help message
      -v, --version                                  Display this application version
      -l, --list                                     Display all file in `entry` directory
     
     PHP development server
      $ beech serve                                  PHP local server default start port 8000 custom by -p, --port   
      
     The following commands are available for entry class:
     
     Initialize for usage `entry`
      $ beech init                                   Initialize for usage `Beech`
     Call entry class
      $ beech {class}/{method}                       To Call class and method.
      $ beech {class}/{method}/{1}/{2}/{...}         To Using parameter(s) in the method.
     Beech make (entry)
      $ beech make:entry {Foobar}                    Create a new entry class
     
     The following commands are available for PHP Beech framework (LTS):
     
     Beech make (MVC)
      $ beech make:controller {FoobarController}     Create a new controller class
      $ beech make:model {Foobar}                    Create a new model class
      $ beech make:view {foobar.view}                Create a new view file
    
# #Usage

First solution : very easy for usage beech-cli by

      $ cd .\vendor\bombkiml\beech-cli\beech-production [command] [options] [arguments]
        
or 

Second solution : beautiful usage beech-cli by go to `` .\vendor\bombkiml\beech-cli\lib\ `` then copy `` beech-production.bat `` to the root folder of your project and rename to `` beech.bat `` 

        $ beech [commnad] [options] [arguments]
    
Great!!

# #Development

Want to contribute or join for Great Job!, You can contact to me via E-mail nattapat.jquery@gmail.com or Facebook : [bombkiml](https://www.facebook.com/bombkiml)

----
# #License

PHP Beech Command line interface (CLI) by [bömb](https://www.facebook.com/bombkiml) it's licensed under the [MIT license.](https://opensource.org/licenses/MIT)
