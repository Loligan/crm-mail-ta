<?php

class GetStepLine
{
    private static $json;

    public static function init($nameJson)
    {
        GetStepLine::$json = file_get_contents($nameJson);
        GetStepLine::$json = json_decode(GetStepLine::$json, true);
    }

    public static function parse($featureText, $stepText)
    {
        return self::getJSONValue($featureText, $stepText);
    }

    private static function equalsTextFeature($jsonText, $stepOutlineText)
    {
        if ($jsonText === $stepOutlineText) {
            return true;
        } else return false;
    }

    private static function getValuesTextFeature($jsonText, $stepOutlineText, $stepText)
    {
//        GET POSITIONS <value>
        $values = array();
        preg_match_all("/<.*>/U", $jsonText, $matches, PREG_OFFSET_CAPTURE);
        $positionsMatches = array(0);
        foreach ($matches[0] as $match) {
            array_push($positionsMatches, $match[1], $match[1] + mb_strlen($match[0]));
        }
//      GET THE TEXT NEXT TO <VALUE>
        $arrayTrash = array();
        for ($i = 0; $i < count($positionsMatches); $i++) {
            if ($i + 1 != count($positionsMatches)) {
                array_push($arrayTrash, trim(mb_substr($jsonText, $positionsMatches[$i], $positionsMatches[$i + 1] - $positionsMatches[$i])));
                $i++;
            } else {
//                $str = trim(mb_substr($jsonText, $positionsMatches[$i]));
                array_push($arrayTrash, mb_substr($jsonText, $positionsMatches[$i]));
            }
        }

//        GET VALUES
        for ($i = 0; $i < count($arrayTrash); $i++) {

            if ($arrayTrash[$i] != "" || $arrayTrash[$i] != null) {
                $firstPosition = stripos($stepText, $arrayTrash[$i]);
                $firstPosition = $firstPosition + mb_strlen($arrayTrash[$i]);
            } else {
                $firstPosition = stripos($stepText, $arrayTrash[$i - 1]) + mb_strlen($arrayTrash[$i - 1]);
            }

            if ($i + 1 != count($arrayTrash)) {
                $secondPosition = stripos($stepText, $arrayTrash[$i + 1]);
                if ($arrayTrash[$i + 1] == "" || $arrayTrash[$i + 1] == null) {
                    $secondPosition = mb_strlen($stepText);
                }
            } else {
                $secondPosition = mb_strlen($stepText);
            }
            $i++;
            array_push($values, trim(mb_substr($stepText, $firstPosition, $secondPosition - $firstPosition)));
        }
        return $values;

    }


    private static function getJSONValue($featureText, $stepText)
    {
        foreach (GetStepLine::$json["steps"] as $key => $value) {
            if (GetStepLine::equalsTextFeature($value["featureTextStep"], $featureText)) {
                $values = self::getValuesTextFeature($value["featureTextStep"], $featureText, $stepText);
                return self::getReadyReportLine($value["bugsReportTextLine"], $value["featureTextStep"], $values);
            }

        }
    }

    private static function getReadyReportLine($jsonReport, $jsonFeature, $values)
    {
        $stringReport = $jsonReport;
        preg_match_all("/<.*>/U", $jsonFeature, $matchesFeature, PREG_OFFSET_CAPTURE);
        preg_match_all("/<.*>/U", $jsonReport, $matchesReport, PREG_OFFSET_CAPTURE);
        for ($i = 0; $i < count($matchesFeature[0]); $i++) {
            foreach ($matchesReport[0] as $matchReport) {
                if ($matchesFeature[0][$i][0] == $matchReport[0]) {
                    $stringReport = str_replace($matchReport[0], $values[$i], $stringReport);
                }
            }
        }
        return $stringReport;
    }
}