<?php
  /**
   * SingletonPattern: Трейт, определяющий шаблон Singleton
   */
  trait SingletonPattern {
     /**
      * @param  object   $instance      Экземпляр объекта
      */
     static private $instance;
     /**
      * Функция инициализации и получения экземпляра объекта 
      *
      * @return object                  Экземпляр объекта
      */
     static public function GetInstance() {
        if (empty(self::$instance)) {
           self::$instance = new self(func_get_args());
        }
        return self::$instance;
     }
     /**
      * Конструктор
      *
      * @param array     $arguments     Массив аргументов конструктора  
      */
     private function __construct ($arguments) {
     }
     /**
      * Функция закрытия экземпляра объекта
      */
     static public function Delete() {
        if (!empty(self::$instance)) {
           self::$instance->ClosingProcedure();
           self::$instance = NULL;
        }
     }
     /**
      * Служебная функция, выполняемая при закрытии экземпляра объекта
      */
     private function ClosingProcedure () {
     }
  }
?>