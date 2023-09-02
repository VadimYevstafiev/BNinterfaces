<?php
  /**
   * CheckArrayElementsType: Трейт, определяющий служебную функцию проверки типа елементов массива
   */
  trait CheckArrayElementsType {
     /**
      * служебная функция проверки типа елементов массива
      *
      * @param array   $array          Массив, элементы которого надо проверить
      * @param string  $type           Наименование типа, к которому должны относиться
      *                                элементы массива
      *
      * @return bool                   TRUE  - если все элементы, относятся к указанному типу
      *                                FALSE - если не все элементы, относятся к указанному типу
      */
     protected function CheckArrayElementsType($array, $type) {
        foreach ($array as $value) {
           if (gettype($value) != $type) {
              return FALSE;
           }
        }
        return TRUE;
     }
  }
?>