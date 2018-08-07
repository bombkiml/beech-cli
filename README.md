# #PHP Beech Command line interface (CLI)
###### [(by bömb)](https://www.facebook.com/bombkiml)

## #Support By
[![N|Solid](https://image.ibb.co/kv8eM8/php_Beech_LTS2.png)](https://github.com/bombkiml/phpbeech)

# #Installing
The Beech Command line interface (CLI) use Composer to manage it's dependencies. So, before using Beech (CLI), make sure you have [Composer](https://getcomposer.org/) installed on your machine. Download the Beech installer using Composer.
    
    $ composer require bombkiml/beech-cli

# #Beech help
    
     Beech Command Line Interface (CLI)
    
     Usage:
      command [options] [arguments]
    
     Options:
      -?|-h, --help                                  Display this help message
      -v, --version                                  Display this application version
      -l, --list                                     Display all file in `entry` directory
    
     The following commands are available:
    
     Initialize
      $ beech init                                   Initialize for usage `Beech`
    
     Call entry class
      $ beech {class}/{method}                       To Call class and method.
      $ beech {class}/{method}/{1}/{2}/{...}         To Using parameter(s) in the method.
    
     Make
      $ beech make:entry {Foobar}                    Create a new entry class
      $ beech make:controller {JobController}        Create a new controller class
      $ beech make:model {Job}                       Create a new model class
      $ beech make:view {job.view}                   Create a new view file
    

# #Development
Want to contribute or join for Great Job!. You can contact to me via E-mail nattapat.jquery@gmail.com or Facebook : [bombkiml](https://www.facebook.com/bombkiml)

----
# #License

PHP Beech Command line interface (CLI) by [bömb](https://www.facebook.com/bombkiml) it's licensed under the [MIT license.](https://opensource.org/licenses/MIT)