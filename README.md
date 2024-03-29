# Beech command line interface (CLI)
[![beech-api release](https://img.shields.io/github/v/release/bombkiml/beech-cli)](https://github.com/bombkiml/beech-cli/releases/)
[![PyPI license](https://img.shields.io/pypi/l/ansicolortags.svg)](https://github.com/bombkiml/beech-api/blob/master/README.md)
###### [(by bömbkiml)](https://www.facebook.com/bombkiml)

[![N|Solid](https://i.ibb.co/RTVrZkq/beech-CLIx2.png)](https://github.com/bombkiml/beech-cli)

### # Support By
[PHP Beech framework (LTS)](https://github.com/bombkiml/phpbeech)

#
### # Environment Requirements
    
    PHP >= ^7.1

#
### # Installation
The Beech command line interface (CLI) use Composer to manage it's dependencies. So, before using Beech (CLI), make sure you have [Composer](https://getcomposer.org/) installed on your machine.
  - **Install with PHP Beech**
  
    ``
    $ composer require bombkiml/beech-cli
    ``
#

  - **Install without PHP beech** (for developer only using the ``entry``)
  
    ``  
    $ composer create-project bombkiml/beech-cli hello-world
    ``
    - **How ot using the ``entry``**
    
        It's very very easy for usage, You may use the beech-cli by 2 way like this:

        - **First choice:** point the beech-cli in ``.\vendor``

            ``$ php .\vendor\bombkiml\beech-cli\beech [command] [options] [arguments]``

        - **Second choice:** beautiful usage beech-cli by go to `` .\vendor\bombkiml\beech-cli `` then copy `` beech `` file to the root folder of your project. 

            ``$ php beech [commnad] [options] [arguments]``


:grey_question: Tips : With PHP Becch framework you can using ``beech`` right now! |
------------ |

#
### # Beech help
     
     Beech command line interface (CLI)

     Usage:
      $ php beech [command] [options] [arguments]

     Options:
      -?|-h, --help                                      Display this help message
      -v, --version                                      Display this application version
      -l, --list                                         Display all file in `entry` directory

     PHP development server
      $ php beech serve                                  PHP local development server 
                                                         start port 8000 custom by -p, --port

     The following commands are available for entry class:

     Initialize for usage `entry`
      $ php beech init                                   Initialize for usage the `entry`
      
     Call entry class
      $ php beech {class}/{method}                       To Call class and method.
      $ php beech {class}/{method}/{1}/{2}/{...}         To Using parameter(s) in the method.
      
     Beech make (entry)
      $ php beech make:entry {Foobar}                    Create a new entry class

     The following commands are available for PHP Beech framework (LTS):

     Beech make (PHP Beech framework supported)
      $ php beech make:controller {FoobarController}     Create a new controller class
      $ php beech make:model {Foobar}                    Create a new model class
      $ php beech make:view {foobar.view}                Create a new view file default blank view
                                                           - with HTML basic tag add arguments --html
                                                           - with HTML blog tag add arguments --blog

      * Tips: You may use the make with arguments -a, --all for generater all modules

#
### # Development
Want to contribute or join for Great Job!, You can contact to me via
  - GitHub: [bombkiml/beech-cli - issues](https://github.com/bombkiml/beech-cli/issues)
  - E-mail: nattapat.jquery@gmail.com 
  - Facebook: [https://www.facebook.com/bombkiml](https://www.facebook.com/bombkiml)
#
### # License
The Beech command line interface (CLI) is open-sourced software licensed under the [MIT license.](https://opensource.org/licenses/MIT)
