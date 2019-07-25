<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class StringsFunctionsComponent extends Component
{
    public function generateRandomString($length = 10)
    {
        $alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $alphabet_length = strlen($alphabet);
        if($length > $alphabet_length)        {
            $new_alphabet = $alphabet;
            for($i = 0; $i < intval($length/$alphabet_length); $i++)
            {
                $new_alphabet .= $alphabet;
            }
            $alphabet = $new_alphabet;
        }
        $shuffled_string = str_shuffle($alphabet);

        return substr($shuffled_string, 0, $length);

    }

    public function CDStoArray($string, $keys = 'numeric')
    {
        $return = [];
        $string = is_null($string) ? '' : trim($string);
        if(strpos($string, ',') === false)  {
            $parts = [$string];
        } else {
            $parts = explode(',', $string);
        }


        foreach($parts as $p){
            $p = trim($p);
            if(strlen($p)) {
                switch ($keys) {
                    case 'values':
                        $return[$p] = $p;
                        break;

                    case 'numeric':
                    default:
                        $return[] = $p;
                        break;
                }
            }
        }
        return $return;
    }

    public function LineSearchByKeyword($file, $keyword)
    {
        $matches =[];

        $handle = @fopen($file, "r");
        if ($handle) {
            while (!feof($handle)) {
                $buffer = fgets($handle);
                if(strpos($buffer, $keyword) !== FALSE)
                    $matches[] = $buffer;
            }
            fclose($handle);
        }

        return $matches;
    }

    public function getActionNameFromLines($actionlines, $ignore_list = [])
    {
        $actions = [];
        if(!is_array($actionlines)) {
            return $actions;
        }
        foreach($actionlines as $ac) {
            if(strpos($ac, 'public') === false) {
                continue;
            }
            $a_parts = explode('function', $ac);
            if(isset($a_parts[1])) {
                $a_parts = explode('(', trim($a_parts[1]));
                $a = trim($a_parts[0]);
                if(!in_array($a, $ignore_list)) {
                    $actions[] = $a;
                }
            } else {
                echo 'cannot process this line: ' . $ac . '<br />';
            }
        }
        //die();
        return $actions;
    }
}
