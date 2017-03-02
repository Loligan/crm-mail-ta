<?php

class GetTitle
{
    private static $json;

    private static function equalsTextTitle($jsonText, $stepOutlineText)
    {
        if ($jsonText === $stepOutlineText) {
            return true;
        } else return false;
    }

    private static function getTitle($featureText, $stepText)
    {

        foreach (GetTitle::$json["steps"] as $key => $value) {
            if (GetTitle::equalsTextTitle($value["featureTextStep"], $featureText)) {
//                $values = self::getValuesTextFeature($value["featureTextStep"], $featureText, $stepText);
//                return self::getReadyReportLine($value["bugsReportTextLine"], $value["featureTextStep"], $values);
            }

        }
    }
}