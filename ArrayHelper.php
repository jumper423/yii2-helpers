<?php

namespace jumper423;

class ArrayHelper extends \yii\helpers\ArrayHelper
{
    /**
     * Indexes an array according to a specified key.
     * The input array should be multidimensional or an array of objects.
     *
     * The key can be a key name of the sub-array, a property name of object, or an anonymous
     * function which returns the key value given an array element.
     *
     * If a key value is null, the corresponding array element will be discarded and not put in the result.
     *
     * For example,
     *
     * ~~~
     * $array = [
     *     ['id' => '123', 'data' => 'abc'],
     *     ['id' => '123', 'data' => '456'],
     *     ['id' => '345', 'data' => 'def'],
     * ];
     * $result = ArrayHelper::index($array, 'id');
     * // the result is:
     * // [
     *        '123' => [
     *                      [
     *                        'id' => '123', 'data' => 'abc',
     *                      ],
     *                      [
     *                        'id' => '123', 'data' => '456',
     *                      ],
     *                  ],
     *        '345' => [
     *                      [
     *                         'id' => '345', 'data' => 'def'
     *                      ]
     *                  ],
     * // ]
     *
     * // using anonymous function
     * $result = ArrayHelper::index($array, function ($element) {
     *     return $element['id'];
     * });
     * ~~~
     *
     * @param array $array the array that needs to be indexed
     * @param string|\Closure $key the column name or anonymous function whose result will be used to index the array
     * @return array the indexed array
     */
    public static function indexUnderArray($array, $key)
    {
        $result = [];
        foreach ($array as $element) {
            $value = static::getValue($element, $key);
            if (!isset($result[$value])) {
                $result[$value] = [];
            }
            $result[$value][] = $element;
        }

        return $result;
    }

    public static function inMultiArray($elem, $array, $field)
    {
        $top = sizeof($array) - 1;
        $bottom = 0;
        while ($bottom <= $top) {
            if ($array[$bottom][$field] == $elem)
                return true;
            /*else
                if(is_array($array[$bottom][$field]))
                    if(static::inMultiArray($elem, ($array[$bottom][$field])))
                        return true;*/

            $bottom++;
        }
        return false;
    }
}
