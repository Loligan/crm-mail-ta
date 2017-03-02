<?php
class ScenarioGhost
{
    private $lastScenario;
    private $tag;
    private $responsible;
    private $scenariosDep;

    /**
     * ScenarioGhost constructor.
     * @param ScenarioGhost $lastScenario
     * @param string $tag
     * @param array $scenariosDep
     */
    public function __construct($lastScenario, $tag,$responsible)
    {
        $this->lastScenario = $lastScenario;
        $this->tag = $tag;
        $this->responsible = $responsible;
        $this->scenariosDep = array();
    }

    /**
     * @return mixed
     */
    public function getResponsible()
    {
        return $this->responsible;
    }

    /**
     * @param mixed $responsible
     */
    public function setResponsible($responsible)
    {
        $this->responsible = $responsible;
    }

    /**
     * @param ScenarioGhost $scenarioGhost
     */
    public function addScenarioDep($scenarioGhost){
        array_push($this->scenariosDep,$scenarioGhost);
    }

    /**
     * @return ScenarioGhost
     */
    public function getLastScenario()
    {
        return $this->lastScenario;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return array
     */
    public function getScenariosDep()
    {
        return $this->scenariosDep;
    }



}