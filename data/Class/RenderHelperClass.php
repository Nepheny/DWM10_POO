<?php
    /*
        $tag = STRING
        $content = STRING
        $vars = Optional ARRAY
        $class = Optional STRING
    */
    class RenderHelperClass
    {
        static function simpleTag($tag, $content, $vars = false, $class = false)
        {
            if($vars && gettype($vars) == "array") {
                foreach ($vars as $key => $value) {
                    $content = str_replace("%$key%", $value, $content);
                }
            }
            echo "<$tag class='$class'>$content</$tag>";
        }

        static function noClosedTag($tag, $class = false)
        {
            echo "<$tag class='$class'/>";
        }

        static function displayTemplate($templateName)
        {
            $template = file_get_contents("./views/$templateName.html");
            echo $template;
        }
    }