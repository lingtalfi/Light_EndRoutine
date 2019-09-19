<?php


namespace Ling\Light_EndRoutine\Service;

use Ling\Light_EndRoutine\Handler\LightEndRoutineHandlerInterface;

/**
 * The Light_EndRoutineService class.
 */
class Light_EndRoutineService
{

    /**
     * This property holds the handlers for this instance.
     * It's an array of identifier => LightEndRoutineHandlerInterface
     *
     * @var LightEndRoutineHandlerInterface[]
     */
    protected $handlers;

    /**
     * Builds the Light_EndRoutineService instance.
     */
    public function __construct()
    {
        $this->handlers = [];
    }


    /**
     * Registers an end routine handler.
     *
     * @param string $identifier
     * @param LightEndRoutineHandlerInterface $handler
     */
    public function registerHandler(string $identifier, LightEndRoutineHandlerInterface $handler)
    {
        $this->handlers[$identifier] = $handler;
    }


    /**
     * Executes all registered end routines.
     *
     * The given route argument is either a @page(light route),
     * or an empty array otherwise (if no route was used).
     *
     *
     *
     * @param array $route
     */
    public function executeEndRoutines(array $route)
    {
        $isAjax = $route['is_ajax'] ?? false;
        if (false === $isAjax) {
            foreach ($this->handlers as $handler) {
                $handler->handle();
            }
        }
    }


}