<?php

$arr = array(1, 5, 3, 6, 8, 2, 4, 10);
$len = count($arr);
$num = 0;
for ($i = 0; $i < $len; $i++) {
    for ($j=$len-1;$j>$i;$j--){
        if($arr[$i] < $arr[$j]){
            $x = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $x;
        }
        $num++;
    }
}
printf("数组长度%d,冒泡次数%d %d(%d-1)/2",$len,$num,$len,$len);
var_dump($arr);