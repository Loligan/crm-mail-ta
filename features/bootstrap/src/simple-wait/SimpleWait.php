<?php

use Facebook\WebDriver\WebDriverBy;

require_once "/home/meldon/PhpstormProjects/crm-mail-ta/vendor/autoload.php";
class SimpleWait
{
    private static $xpathBuf;
    private static $elementBuf;

    /**
     * @param Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $xpath
     */
    public static function waitShowByCSSSelector($webDriver, $xpath){
        SimpleWait::$xpathBuf = $xpath;
        $webDriver->wait(20,20)->until(function ($driver){
            return $driver->findElement(WebDriverBy::cssSelector(SimpleWait::$xpathBuf))->isDisplayed()===true && $driver->findElement(WebDriverBy::cssSelector(SimpleWait::$xpathBuf))->isEnabled()===true;
        } );
    }

    /**
     * @param Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $xpath
     * @throws Exception
     */
    public static function waitShow($webDriver, $xpath){
        SimpleWait::$xpathBuf = $xpath;
        try{
        $webDriver->wait(20,20)->until(function ($driver){
            return $driver->findElement(WebDriverBy::xpath(SimpleWait::$xpathBuf))->isDisplayed()===true && $driver->findElement(WebDriverBy::xpath(SimpleWait::$xpathBuf))->isEnabled()===true;
        } );
        }catch (Exception $e){
            throw new Exception("File not be show with xpath:".$xpath." \nby url: ".$webDriver->getCurrentURL());
        }
    }

    /**
     * @param Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $xpath
     * @throws Exception
     */
    public static function waitHide($webDriver, $xpath){
        SimpleWait::$xpathBuf = $xpath;
        try{
        $webDriver->wait(20,20)->until(function ($driver){
            $gg = false;
            if(count($driver->findElements(WebDriverBy::xpath(SimpleWait::$xpathBuf)))<1){
                $gg=true;
            }
            return $gg===true;
        } );
        }catch (Exception $e){
            throw new Exception("File not be hide with xpath:".$xpath." \nby url: ".$webDriver->getCurrentURL());
        }
    }

    /**
     * @param Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param string $title
     * @throws Exception
     */
    public static function waitTitleHide($webDriver, $title){
        SimpleWait::$xpathBuf = $title;
        try{
        $webDriver->wait(180,20)->until(function ($driver){
            $gg = false;
            if($driver->getTitle()!==SimpleWait::$xpathBuf){
                $gg=true;
            }
            return $gg===true;
        } );
        }catch (Exception $e){
            throw new Exception("Page not redirect to ".$title."\n .Actual title: ".$webDriver->getTitle(). "\n and url".$webDriver->getCurrentURL());
        }
    }

    /**
     * @param Facebook\WebDriver\Remote\RemoteWebDriver $webDriver
     * @param Facebook\WebDriver\WebDriverElement $element
     * @throws Exception
     */
    public static function waitingOfClick($webDriver, $element){
        SimpleWait::$elementBuf = $element;
       try{
        $webDriver->wait(20,20)->until(function ($driver){
            $gg=false;
            try {
                SimpleWait::$elementBuf->click();
                $gg=true;
            }catch(Exception $e){
            }
            return $gg===true;
        } );
       }catch (Exception $e){
           throw new Exception("Object not be clickable");
       }
    }
}