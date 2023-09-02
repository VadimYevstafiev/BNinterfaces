<?php
  /**
   * ParseHttpCode: Трейт функции обработки HTTP-заголовка ответа
   * сервиса Binance API
   */
  trait ParseHttpCode {
     /**
      * Обработчик ответа
      *
      * @param  string   $response          Ответ сервиса
      *
      * @return bool                        TRUE - если есть подключение
      *                                     FALSE - если нет подключения 
      */
     protected function ParseReponse($response) {
        return (200 == $this->curl->GetHttpCode()) ? TRUE : FALSE;
     }
  }
?>