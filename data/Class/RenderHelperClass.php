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

        static function displayTemplate($templateName, $vars = false)
        {
            $temp = "";
            $template = file_get_contents("./views/$templateName.html");
            // Remplacer les %machin% par des variables
            if($vars) {
                foreach ($vars as $key => $value) {
                    $temp .= "<div>";
                    $temp .= "<ul>";
                    $temp .= "<li>Nom : " . $value->name . "</li>";
                    $temp .= "<li>Classe : " . get_class($value). "</li>";
                    $temp .= "<li>HP : " . $value->hp . "</li>";
                    $temp .= "<li>MP : " . $value->mp . "</li>";
                    $temp .= "</ul>";
                    $temp .= "</div>";
                }
            }

            var_dump($temp);
            echo $template;
        }
    }