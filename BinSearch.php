const ROOT = dirname(__FILE__);

function binarySearchByKey($file, $find){
    $handle = fopen($file, "r");
    while (!feof($handle)) {
        $string = fgets($handle,4000);
        mb_convert_encoding($string, 'cp1251');
        $explodedstring = explode('\x0A', $string);
        array_pop($explodedstring);
        foreach ($explodedstring as $key => $value) {
            $arr[] = explode('\t', $value);
        }
        $first = 0;
        $last = count($arr)-1;
        while ($first <= $last) {
            $result = ceil(($first + $last) / 2);
            $strnatcmp = strnatcmp($arr[$result][0],$find);
            if ($strnatcmp > 0) {
                $last = $result - 1;
            } elseif ($strnatcmp < 0) {
                $first = $result + 1;
            } else {
                return $arr[$result][1];
            }
        }
    }
    return 'undef';
}
$find = 'ключ32';
$file = ROOT.'/keynumeric.txt';
echo binarySearchByKey($file, $find)."</br>";
echo "Если искомый ключ не существует в файле: ";
$find = 'ключ322';
echo binarySearchByKey($file, $find)."</br>";
