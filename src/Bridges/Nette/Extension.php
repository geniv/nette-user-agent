<?php declare(strict_types=1);

namespace UserAgent\Bridges\Nette;

use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use UserAgent\UserAgentString;


/**
 * Class Extension
 *
 * @author  geniv
 * @package UserAgent\Bridges\Nette
 */
class Extension extends CompilerExtension
{

    /**
     * Load configuration.
     */
    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();

        $builder->addDefinition($this->prefix('default'))
            ->setFactory(UserAgentString::class)
            ->setAutowired(true);
    }


    /**
     * After compile.
     *
     * @param ClassType $class
     */
    public function afterCompile(ClassType $class)
    {
        $initialize = $class->getMethod('initialize');
        $initialize->addBody('$this->getService(?);', [$this->prefix('default')]);  // global call for initialization
    }
}
