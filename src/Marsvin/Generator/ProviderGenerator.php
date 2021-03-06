<?php
namespace Marsvin\Generator;

use Marsvin\Generator\Generator;
use SplFileObject;
use RuntimeException;

class ProviderGenerator extends Generator
{

    const SUFIX = 'Provider';

    public function __construct($namespace, $name)
    {
        parent::__construct(
            $namespace,
            $name,
            new SplFileObject(
                __DIR__ . DIRECTORY_SEPARATOR . 'Skeleton' . DIRECTORY_SEPARATOR . self::SUFIX . '.php'
            )
        );
    }

    public function generate()
    {
        $dir = $this->getDir();

        if (is_dir($dir)) {
            throw new RuntimeException(
                sprintf(
                    'It\'s not possible to generate the provider as the dir %s is not empty',
                    $dir
                )
            );
        }
        
        $parameters = array(
            'namespace' => $this->getNamespace(),
            'provider' => $this->getClassName() . self::SUFIX
        );

        $this->renderFile($parameters);
    }

}