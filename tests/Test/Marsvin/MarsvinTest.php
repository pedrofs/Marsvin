<?php
namespace Test\Marsvin;

use Marsvin\Marsvin;

class MarsvinTest extends \PHPUnit_Framework_TestCase
{

    private $marsvin;

    protected function setup()
    {
        $this->event    = $this->getMock('Evenement\EventEmmiter');
        $this->process  = $this->getMock(
            'Spork\ProcessManager', 
            array(), 
            array(
                $this->getMock('Spork\EventDispatcher\EventDispatcher')
            )
        );
        $this->provider = $this->getMock(
            'Marsvin\Provider\Provider',
            array(),
            array(
                $this->getMock(
                    'Marsvin\Provider\Adapter\DefaultAdapter',
                    array(
                        
                    ),
                    array(
                        $this->event,
                        $this->process
                    )
                )
            )
        );
        $this->marsvin = new Marsvin($this->event, $this->process, $this->provider);
    }

    protected function tearDown()
    {
        $this->marsvin = null;
    }

    public function testBasicMethods()
    {
        $this->marsvin->request(function (RequesterInterface $request) {
            $data = $request->getAdapter()->request('http://google.com');

            return new Response($data);
        })->parse(function (ParserInterface $parser, ResponseInterface $response) {
            $data = $parse->getAdapter()->parse($response->get());

            return new Response($data);
        })->persist(function (PersisterInterface $persister, ResponseInterface $response) {
            $entities = $response->get();
            foreach ($entitis as $entity) {
                $persister->getAdapter()->persist($entity);
            }
            $persister->getAdapter()->flush();
        });
    }

}
