<?php
  /**
   * BNinterfaceException: Пользовательский класс исключений классов
   * запросов и обработчиков ответов интерфейсов сервиса Binance API
   */
  class BNinterfaceException extends Exception {
     /**
      * Конструктор
      *
      * @param  string   $callingClassName  Имя класса, в котором произошло исключение
      * @param  string   $message           Текст сообщения об исключении
      * @param  string   $code              Пользовательский код исключения
      * @param  object   $previous          Экземпляр предыдущего исключения
      *
      * @return object                      Экземпляр исключения
      */
     public function __construct ($callingClassName, $message, $code = 0, Throwable $previous = null) {
        $message = '<p>Ошибка класса ' .  $callingClassName . ':</p><p>' . $message . '</p>';
        if (!empty($previous)) {
           $message .= '<p>=></p><p>' . $previous->getMessage() . '</p>';
        }
        parent::__construct($message, $code, $previous);
     }
  }
?>