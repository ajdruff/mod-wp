#RandomLib


RandomLib is a library for generating random numbers and strings.


https://github.com/ircmaxell/RandomLib


#Installation

**Download**

    wget -qO- https://github.com/ircmaxell/RandomLib/archive/master.tar.gz | tar zx

if error, make sure you are in cygwin environment.

**installation**

must be in git windows shell for this : 

    php "c:/ProgramData/ComposerSetup/bin/composer.phar" install

**remove unnecessary code**

remove everything in the root directory except the lib and vendor directories

remove everything in the vendor directory except the composer, ircmaxell and autoload.php.

this will bring the code down from over 30mb to 350k.

#Code

    require_once $this->INSTALLER_DIRECTORY . '/libs/RandomLib/vendor/autoload.php';

    $factory = new RandomLib\Factory;
    $generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));

    $passwordLength = 8; // Or more
    $randomPassword = $generator->generateString($passwordLength);
    die( $randomPassword);





