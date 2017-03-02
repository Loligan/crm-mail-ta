<?php

require_once "ScenarioGhost.php";

class RunnableTest
{

    private static $url = "http://127.0.0.1/redmine/";
    private static $login = "MrRobot";
    private static $password = "12345678";


    private static function buildScenariosDependent($x, $scenarioGhost = null)
    {
        $thisScenario = new ScenarioGhost($scenarioGhost, $x['tag'], $x['responsible']);
        while (true) {
            $countDep = count($x['dependent']);
            if ($countDep > 0) {
                for ($i = 0; $i < $countDep; $i++) {
                    $thisScenario->addScenarioDep(self::buildScenariosDependent($x['dependent'][$i], $thisScenario));
                }

            }
            return $thisScenario;
            break;
        }
    }

    /**
     * @param string $tag
     * @return bool
     */
    private static function callTestByTag($tag)
    {
        $execText = "./home/meldon/PhpstormProjects/crm-mail-ta/TestTime/RunnableTests/runnable.sh -t " . $tag;
        $resultExec = shell_exec($execText);
//        print $resultExec;
        if (stripos($resultExec, "Проваленные сценарии") === false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param ScenarioGhost $scenario
     * @return bool
     */
    private static function starScenarioTest($scenario)
    {
        $tag = $scenario->getTag();
        if (self::callTestByTag($tag)) {
            $countScenaries = count($scenario->getScenariosDep());
            for ($i = 0; $i < $countScenaries; $i++) {
                self::starScenarioTest($scenario->getScenariosDep()[$i]);
            }
            print "OK." . $scenario->getTag() . "\n";
            return true;
        } else {
            print "NO OK." . $scenario->getTag() . "\n";
            self::definitionOfResult($scenario);

            return false;
        }
    }

    /**
     * @param ScenarioGhost $scenario
     */
    private static function definitionOfResult($scenario)
    {
        $thisScenarioTag = $scenario->getTag();
        $lastScenarioTag = null;
        if (!is_null($scenario->getLastScenario())) {
            $lastScenarioTag = $scenario->getLastScenario()->getTag();
        }

        $thisResultScenario = self::callTestByTag($thisScenarioTag);
        $resultLastScenario = null;
        if (!is_null($scenario->getLastScenario())) {
            $resultLastScenario = self::callTestByTag($lastScenarioTag);
        }

        if (
            ($thisResultScenario == true && $resultLastScenario == true) ||
            ($thisResultScenario == true && $resultLastScenario == null)
        ) {
            print "BREAK\n";
            return;
        } elseif (
            ($thisResultScenario == false && $resultLastScenario == true) ||
            ($thisResultScenario == false && $resultLastScenario == null)
        ) {
            print "REPORT" . $thisScenarioTag . "\n";
//            TODO
            $execTextReport = "./home/meldon/PhpstormProjects/crm-mail-ta/TestTime/RunnableTests/record_scenario_by_tag.sh -t " . $thisScenarioTag;
            echo shell_exec($execTextReport);

        } elseif (
            ($thisResultScenario == false && $resultLastScenario == false) ||
            ($thisResultScenario == true && $resultLastScenario == false)
        ) {
            self::definitionOfResult($scenario->getLastScenario());
            print "defOfRes\n";
        }
    }

    static function run()
    {
        $file = file_get_contents("/home/meldon/PhpstormProjects/crm-mail-ta/TestTime/RunnableTests/tests.json");
        $evil_tree = json_decode($file, true);
        $scenario = self::buildScenariosDependent($evil_tree[0]);
        self::starScenarioTest($scenario);

    }


    /**
     * @param string $tag
     * @param ScenarioGhost $scenario
     * @return ScenarioGhost
     */
    private static function getScenarioByTag($tag, $scenario)
    {
        if ($scenario->getTag() !== $tag) {
            $depCount = count($scenario->getScenariosDep());
            if ($depCount > 0) {
                for ($i = 0; $i < $depCount; $i++) {
                    $result = self::getScenarioByTag($tag, $scenario->getScenariosDep()[$i]);
                    if ($result != null) {
                        return $result;
                    }
                }
            }
        } else {
            return $scenario;
        }
    }

    static function runByTag($tag)
    {
        $file = file_get_contents("/home/meldon/PhpstormProjects/crm-mail-ta/TestTime/RunnableTests/tests.json");
        $evil_tree = json_decode($file, true);
        $scenario = self::buildScenariosDependent($evil_tree[0]);
        $scenario = self::getScenarioByTag($tag, $scenario);
//        var_dump($scenario->getTag());
//        self::starScenarioTest($scenario);
        return self::callTestByTag($tag);
    }

    static function runByTagAndTitle($tag, $title)
    {
        $execText = "/home/meldon/PhpstormProjects/crm-mail-ta/TestTime/RunnableTests/runnable.sh -t " . $tag . " -g" . $title;
        $resultExec = shell_exec($execText);

        if (stripos($resultExec, "Проваленные сценарии") === false) {
            return true;
        } else {
            return false;
        }
    }

    static function runSmoke()
    {
        $file = file_get_contents("/home/meldon/PhpstormProjects/crm-mail-ta/TestTime/RunnableTests/tests.json");
        $evil_tree = json_decode($file, true);
        $scenario = self::buildSmokeScenariosDependent($evil_tree[0]);
//        var_dump($scenario);
        self::starScenarioTest($scenario);

    }


    private static function buildSmokeScenariosDependent($x, $scenarioGhost = null)
    {
        if ($x['isSmoke'] == true) {
            $thisScenario = new ScenarioGhost($scenarioGhost, $x['tag'], $x['responsible']);
            while (true) {
                $countDep = count($x['dependent']);
                if ($countDep > 0) {
                    for ($i = 0; $i < $countDep; $i++) {
                        $result = self::buildSmokeScenariosDependent($x['dependent'][$i], $thisScenario);
                        if($result!==null)
                        $thisScenario->addScenarioDep($result);
                    }
                }
                return $thisScenario;
                break;
            }
        }else{
            return null;
        }
    }
}