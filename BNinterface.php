<?php
  /**
   * BNinterface: Абстрактный класс конструктора запросов и обработчика ответов 
   * интерфейсов сервиса Binance API
   */  
  abstract class BNinterface {
     use CheckArrayElementsType;
     /**
      * @param  array    $arguments         Массив аргументов, переданных функции SendQuery()
      * @param  array    $urls              Пул доступных адресов конечных точек сервиса Binance API
      * @param  string   $errorStack        Стек сообщений о вызове исключения
      * @param  array    $used              Массив использованых индексов конечной точки, которые не обсепечивают
      *                                     достаточную производительность сервиса Binance API
      * @param  string   $url               Адрес сервиса Binance API
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      * @param  object   $curl              Экземпляр объекта класса CURLservice
      * @param  string   $headerLimit       Ключ заголовка, содержащего значение использованного
      *                                     лимита сервиса Binance API
      * @param  string   $limitKey          Идентификатор использованного лимита сервиса Binance API
      * @param  integer  $limitValue        Максимальное значение использованного лимита сервиса Binance API
      * @param  integer  $queryWeight       Значение веса запроса к сервису Binance API
      */
     static protected $arguments = array();
     protected $urls = array('https://api.binance.com',
                             'https://api1.binance.com',
                             'https://api2.binance.com',
                             'https://api3.binance.com');
     protected $errorStack;
     protected $used = array();
     protected $url;
     protected $path;
     protected $curl;
     protected $headerLimit;
     protected $limitKey;
     protected $limitValue;
     protected $queryWeight;
     /**
      * Функция отправки запроса и обработки ответа 
      *
      * @return array                       Массив полученных значений
      */
     abstract static public function SendQuery();
     /**
      * Служебная функция отправки запроса и обработки ответа 
      *
      * @return array                       Массив полученных значений
      */
     static protected function ExecuteSendQuery() {
        $instance = new static();
        $instance->CheckArguments();
        $instance->SelectUrl();
        $isPerformed = FALSE;
        while (!$isPerformed) {
           try {
              $output = $instance->ExecuteQuery();
              $isPerformed = TRUE;
           } catch (BNinterfacePerformanceException $e) {
              $instance->errorStack = '<p>=></p>' . $e->getMessage() . $instance->errorStack;
              $instance->SelectUrl();
           }
        }
        return $output;
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      */
     abstract static protected function SaveArguments();
     /**
      * Функция проверки аргументов, переданных функции SendQuery()
      */
     abstract protected function CheckArguments();
     /**
      * Функция получения веса текущего запроса, используемого для расчета лимитов Binance API
      */
     abstract protected function GetQueryWeight();
     /**
      * Функция определения индекса конечной точки в пуле доступных адресов,
      * обеспечивающей достаточную производительность сервиса Binance API
      */
     protected function SelectUrl() {
        for ($i = 0; $i < count($this->urls); $i++) {
           if (!in_array($i, $this->used)) {
              $this->used[] = $i;
              $this->url = $this->urls[$i];
              return;
           }
        }
        throw new BNinterfaceException(get_called_class(), 'Не удалось подключиться ни к одной из конечных точек сервиса Binance API.' . $this->errorStack);
     } 
     /**
      * Функция отправки запроса и обработки ответа 
      *
      * @return array                       Массив полученных значений
      */
     protected function ExecuteQuery() {
        $url = $this::ConstructRequest();
        $this::SetLimitBN();
        $this::CheckLimitBN();
        $this->curl = new CURLservice();
        $this::SetRequestHeaders();
        if (!is_array($url)) {
           $response = $this->curl->ExecuteQuery($url);
        } else {
           $response = $this->curl->ExecuteQuery($url['URL'], $url['PostData']);
        }
        $this::RefreshLimitCounter();
        $response = $this::ParseReponse($response);
        if ($this->curl->GetHttpCode() >= 400) {
           $this->CheckErrorsBN($response);
        } else {
           return $response;
        }
     }
     /**
      * Функция установки лимитов сервиса Binance API
      */
     abstract protected function SetLimitBN();
     /**
      * Функция контроля лимитов сервиса Binance API
      */
     protected function CheckLimitBN() {
        if (($this::GetQueryWeight() + BNlimitCounter::GetLimit($this->limitKey)) >= $this->limitValue) {
           throw new BNinterfaceException(get_called_class(), 'При выполнении запроса будет исчерпан ' . $this->limitKey . ' лимит сервиса Binance API.');
        }
     }
     /**
      * Функция переопределения массива HTTP-заголовков запроса cURL
      *
      */
     protected function SetRequestHeaders() {
     }
     /**
      * Функция обновления счетчика использованных лимитов сервиса Binance API
      */
     protected function RefreshLimitCounter() {
        $headers = $this->curl->GetResponseHeaders();
var_dump($headers);
        if (isset($headers[$this->headerLimit])) {
           BNlimitCounter::RefreshLimit($this->limitKey, $headers[$this->headerLimit]);
        }
     }
     /**
      * Конструктор запроса
      *
      * @return string                  URL для передачи запроса 
      */
     protected function ConstructRequest() {
        $output = $this::ConstructAbsolutePath();
        $queryString = ConstructHTTPqueryString::Execute($this::ConstructQueryString());
        if (!is_null($queryString)) {
           $output .= '?' . $queryString;
        }
var_dump($output);
        return $output;
     }
     /**
      * Конструктор абсолютного пути запроса
      *
      * @return string                  Абсолютный путь запроса 
      */
     protected function ConstructAbsolutePath() {
        return $this->url . $this->path;
     }
     /**
      * Конструктор строки запроса
      *
      * @return string                  Строка запроса 
      */
     protected function ConstructQueryString() {
        return self::$arguments;
     }
     /**
      * Функция контроля ошибок сервиса Binance API
      *
      * @param  string   $input             Ответ сервиса
      *
      */
     protected function CheckErrorsBN($input) {
        $parsed = BNerrorCodesParser::ParseCode($input);
        $code = $this->curl->GetHttpCode();
        $message = HTTPcodesBNparser::Parse($code) . ' Запрос выполнен с кодом ' . $input['code'] . ': ' . $parsed['message'];
        if (0 == $parsed['code']) {
           if (418 == $code || 429 == $code) {
              $headers = $this->curl->GetResponseHeaders();
              if (isset($headers['retry-after'])) {
                 $message .= '.</p><p> Подождите не менее ' . $headers['retry-after'] . ' секунд,';
                 if (418 == $code) {
                    $message .= ' пока закончится блокировка IP-адреса';
                 } else {
                    $message .= ' чтобы избежать блокировки IP-адреса';
                 }
              }
           }
           throw new BNinterfaceException(get_called_class(), $message);
        }
        if (10 == $parsed['code']) {
           throw new BNinterfacePerformanceException(get_called_class(),
                                                    'Проблемы с производительностью конечной точки ' . $this->url . ' сервиса Binance API.</p><p>' .
                                                     $message);
        }
     }
     /**
      * Обработчик ответа
      *
      * @param  string   $input             Ответ сервиса
      *
      * @return array                       Массив полученных значений
      */
     protected function ParseReponse($input) {
        if (is_array($input)) {
           return $input;
        }
        $output = json_decode($input, true);
        if (is_null($output)) {
           throw new BNinterfaceException(get_called_class(), 'Получен недопустимый ответ сервиса Binance API: ' . strval($input));
        }
        return $output;
     }
 }
?>