<?php
  /**
   * AddSignature: Трейт, конструктора подписанной строки для запросов
   * сервиса Binance API
   */
  trait AddSignature {
     /**
      * @param  string       $algo          Имя алгоритма хеширования
      * @param  string       $secretKey     Имя алгоритма хеширования
      * @param  bool|integer $recvWindow    Период времени в милисекундах,
      *                                     в течении которого запрос действителен.
      *                                     FALSE - если значение параметра
      *                                     по умолчанию = 5000.
      */
     protected $algo = 'sha256';
     protected $secretKey = '5XWAfzU3nOBDQsQcCb6DJzMfOIVPmyc7eGBIDTABhjjUSc35lBuswSzWuUXhJe9T';
     protected $recvWindow = FALSE;
     /**
      * Функция переопределения параметра recvWindow
      *
      * @param  integer  $recvWindow        Новое значение параметра $recvWindow
      *                                     в милисекундах
      */
     protected function SetRecvWindow($recvWindow) {
        if ($recvWindow <= 0 || $recvWindow > 60000) {
           throw new BNinterfaceException(get_called_class(), 'Недопустимое значение параметра recvWindow.');
        }
        $this->recvWindow = $recvWindow;
     }
     /**
      * Функция подписи строки
      *
      * @param  string   $string            Строка для подписи
      *
      * @return string                      Подписанная строка
      */
     protected function SignString($string) {
        $output = $string . $this::AddTimestamp();
        $output .= '&signature=' . hash_hmac($this->algo, $output, $this->secretKey);
        return $output;
     }
     /**
      * Функция дополнения строки для подписи параметром timestamp
      *
      * @return string                      Строка с параметром timestamp
      */
     protected function AddTimestamp() {
        $output = '';
        if ($this::GetRecvWindow()) {
           $output .= '&recvWindow=' . $this::GetRecvWindow();
        }
        $output .= '&timestamp=' . ceil(microtime(true) * 1000);
        return $output;
     }
     /**
      * Функция получения параметра recvWindow
      *
      * @return bool|integer                Значение параметра $recvWindow
      */
     protected function GetRecvWindow() {
        return $this->recvWindow;
     }
  }
?>