# #PHP Beech Command line interface (CLI)
###### [(by bömbkiml)](https://www.facebook.com/bombkiml)

### #Support By
[![N|Solid](https://image.ibb.co/cyCpFe/beechcli_Plus_Beechx1.png)](https://github.com/bombkiml/beech-cli)

### # Environment Requirements
    
    PHP >= ^7.1

#
### # Installing
The Beech Command line interface (CLI) use Composer to manage it's dependencies. So, before using Beech (CLI), make sure you have [Composer](https://getcomposer.org/) installed on your machine. Download the Beech installer using Composer.
    
    $ composer require bombkiml/beech-cli

#
### # Usage
It's very very easy for usage, You may use the beech-cli by 2 way like this:

**First choice:** point the beech-cli in ``.\vendor``

      $ .\vendor\bombkiml\beech-cli\beech [command] [options] [arguments]
        
or 

**Second choice:** beautiful usage beech-cli by go to `` .\vendor\bombkiml\beech-cli `` then copy `` beech `` file to the root folder of your project. 

        $ beech [commnad] [options] [arguments]
    
Great!!
#
### # Beech help
    
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

#
# #Development
Want to contribute or join for Great Job!, You can contact to me via E-mail nattapat.jquery@gmail.com or Facebook : [bombkiml](https://www.facebook.com/bombkiml)
#
### # License
PHP Beech Command line interface (CLI) is open-sourced software licensed under the [MIT license.](https://opensource.org/licenses/MIT)
