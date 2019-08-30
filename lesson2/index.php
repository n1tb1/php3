<?php
/**
 * Created by PhpStorm.
 * User: good
 * Date: 20/08/2019
 * Time: 14:02
 */

$prices = [
    [
        'price' => 21999,
        'shop_name' => 'Shop 1',
        'shop_link' => 'http://'
    ],
    [
        'price' => 21550,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://'
    ],
    [
        'price' => 21950,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://'
    ],
    [
        'price' => 21350,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://'
    ],
    [
        'price' => 21050,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://'
    ]
];


//За 7 шагов выполнена сортировка
//Сложность данного алгоритма N*(N*log(N))
function ShellSort($elements)
{
    $k = 0; //1
    $length = count($elements);//1
    $gap[0] = (int)($length / 2);//1

    while ($gap[$k] > 1) {//n
        $k++;//1
        $gap[$k] = (int)($gap[$k - 1] / 2);//1
    }

    for ($i = 0; $i <= $k; $i++) {//n
        $step = $gap[$i];//1

        for ($j = $step; $j < $length; $j++) {//n
            $temp = $elements[$j];//1
            $p = $j - $step;//1

            while ($p >= 0 && $temp['price'] < $elements[$p]['price']) {//n
                $elements[$p + $step] = $elements[$p];//1
                $p = $p - $step;//1
            }

            $elements[$p + $step] = $temp;//1
        }
    }

    return $elements;//1
}


//Recursive qucikSort
function quickSort($mas)
{
    $count = count($mas);
    if ($count <= 1) {
        return $mas;
    }

    $baseEl = $mas[0];

    $left = [];
    $right = [];

    for ($i = 1; $i < $count; $i++) {
        if ($mas[$i]['price'] <= $baseEl['price']) {
            $left[]	= $mas[$i];
        }
        else {
            $right[] = $mas[$i];
        }
    }

    $left = quickSort($left);

    $right = quickSort($right);

    return array_merge($left, [$baseEl], $right);
}


$startTime = microtime(true);
echo "<pre>";
print_r(quickSort($prices));

//sort($arr);
echo microtime(true) - $startTime;

$startTime = microtime(true);
print_r(ShellSort($prices));

//sort($arr);
echo microtime(true) - $startTime;