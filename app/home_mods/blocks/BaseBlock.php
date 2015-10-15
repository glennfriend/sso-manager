<?php

namespace blocks;

class BaseBlock
{

    /**
     *  output value
     */
    protected $value = '';

    /**
     *
     */
    public function __construct()
    {
        // please rewrite
    }

    /**
     *  quick output
     */
    public function __toString()
    {
        return $this->getTemplate();
    }

    /* --------------------------------------------------------------------------------
        
    -------------------------------------------------------------------------------- */

    /**
     *  讀取 template.php
     */
    protected function getTemplate()
    {
        $className = get_class($this);
        $classNames = explode('\\', $className);
        if ( !isset($classNames[1]) ) {
            return null;
        }

        $blockName = $classNames[1];
        $basePath = \Config::get('home.base.path');
        $file = $basePath . '/app/'. APP_PORTAL .'_mods/blocks/'. $blockName . '/template.php';
        if ( !file_exists($file) ) {
            return null;
        }

        try {

            ob_start();
                include($file);
                $tmp = ob_get_contents();
            ob_end_clean();
            return $tmp;

        }
        catch( \Exception $e ) {

            $traces = $e->getTrace();
            $errorMessage = "Block Error - {$traces[0]['file']}:{$traces[0]['line']} - {$e->getMessage()}";
            \LogBrg::error($errorMessage);

            if (\SessionBrg::get('is_debug')) {
                echo $errorMessage;
            }
            else {
                echo $e->getMessage();
            }
            exit;

        }

    }

    /**
     *  output
     */
    public function toHtml()
    {
        return $this->value;
    }

}