# group-project-1.1

## Theme
[bootstrap theme](https://bootswatch.com)
*should find a good theme first

## Coding standards
[PSR-2](http://www.php-fig.org/psr/psr-2/) read important

*check PSR-1 too 

## Documentation
* [guide for documentation comments] (https://www.sitepoint.com/introduction-to-phpdoc/)
* for documentation we are using [phpDocumentor](https://docs.phpdoc.org/)

documentation is at /docs/

to generate documentation

run `php phpDocumentor.phar -f . -t docs/api` on root directory

phpDocumentor dependencies :
* [graphviz](http://graphviz.org/Download..php)
* PHP 5.3.3 (we are using php 7)
* [intl extension for PHP](http://sg2.php.net/manual/en/intl.installation.php)
  * on linux : sudo apt-get install php7.0-intl
  * on mac(brew) : brew install php70-intl
  * on windows : I have no idea cheack the link above


## IDE

recomended TextEditor (Sublime 3) packages:

install [Package Control first](https://packagecontrol.io/installation)

(ctr+shift+p => Package Controll: Install Packages)

* ["DocBlockr" to make write documentatoin comment easy](https://github.com/spadgos/sublime-jsdocs)
* ["TrailingSpaces" to indicate and remove trailing spaces](https://github.com/SublimeText/TrailingSpaces)
* ["BracketHighlighter" a better bracket highlighter](https://github.com/facelessuser/BracketHighlighter/)
* ["TerminalView" terminal on ur submlime can integrate with sublime build system](https://packagecontrol.io/packages/TerminalView)
* ["Xdebug" overkill would not recomend](https://packagecontrol.io/packages/Xdebug%20Client)


