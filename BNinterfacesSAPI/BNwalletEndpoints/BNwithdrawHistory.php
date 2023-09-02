<?php
  /**
   * BNwithdrawHistory: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса полученя историю вывода средств сервиса Binance API
   */  
  class BNwithdrawHistory extends BNinterfaceSAPI {
     use SignedGET;
     /**
      * Константы, определяющие тип второго или второго и третьего аргументов функции BNwithdrawHistory::SendQuery()
      */
     const TIME  = - 10;
     const LIMIT = - 20;
     const RECV  = - 30;
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/sapi/v1/capital/withdraw/history';
     /**
      * Допустимые аргументы функции BNwithdrawHistory::SendQuery()
      *                              BNwithdrawHistory::SendQuery($coin)
      *                              BNwithdrawHistory::SendQuery($type, $startTime, $endTime)
      *                              BNwithdrawHistory::SendQuery($type, $startTime, $endTime, $recvWindow)
      *                              BNwithdrawHistory::SendQuery($type, $startTime, $endTime, BNdailyAccountSnapshot::TIME)
      *                              BNwithdrawHistory::SendQuery($type, $startTime, $endTime, $recvWindow, BNdailyAccountSnapshot::TIME)
      *                              BNwithdrawHistory::SendQuery($type, $limit, BNdailyAccountSnapshot::LIMIT)
      *                              BNwithdrawHistory::SendQuery($type, $limit, $recvWindow, BNdailyAccountSnapshot::LIMIT)
      *                              BNwithdrawHistory::SendQuery($type, $recvWindow, BNdailyAccountSnapshot::RECV)
      *
      * @param  string   $coin               Символ монеты, в которой номинированы средства, о выводе которых запрашивается информация.
      * @param  string   $withdrawOrderId    Идентификатор клиента для вывода.
      * @param  integer  $status             Статус трансзакций вывода, о которых запрашивается информация.
      *                                      Возможные значения:
      *                                                          0 - отправлено уведомление.
      *                                                          1 - отменено.
      *                                                          2 - ожидается подтверджение.
      *                                                          3 - отклонено.
      *                                                          4 - находится в обработке.
      *                                                          5 - отказано.
      *                                                          6 - завершено.
      * @param  integer  $offset             Компенсация.
      * @param  integer  $limit              Количество транзакций, о которых возвращается информация. 
      *                                      Если параметр не указан - возвращается информация о 1000 транзакциях. 
      *                                      Максимальное количество транзакций - 1000.
      * @param  integer  $startTime          Стартовая временная метка в милисекундах, начиная с которой возвращается информация.
      *                                      Указывается любая временная метка первого дня интересующего периода от 00:00:00 до 23:59:59.
      *                                      Если параметр не указан - возвращается информация о 1000 сделках. 
      * @param  integer  $endTime            Конечная временная метка в милисекундах, по которую включительно возвращается информация.
      *                                      Указывается любая временная метка последнегого дня интересующего периода от 00:00:00 до 23:59:59.
      *                                      Если указаны параметры $startTime и $endTime, интервал между ними должен быть не более 90 дней.
      *                                      Если дополнительно указан параметр $withdrawOrderId, интервал между параметрами $startTime
      *                                      и $endTime должен быть менее 7 дней.
      *                                      Если указан параметр $withdrawOrderId, а параметры $startTime и $endTime не указаны,
      *                                      возвращаются данные за последние 7 дней. 
      * @param  integer  $recvWindow         Период (в миллисекундах), в течении которого запрос действителен
      *
      * Ответ, возвращаемый сервисом
      * array                               Массив, содержащий ассоциативные массивы с информацей 
      *                                     об транзакциях.
      *                                     Каждый из ассоциативных массивов содержит следующие элементы:
      *         string       id                      Идентификатор транзакции  в сервисе Binance.
      *         string       amount                  Объем средств, выведенный в трансзакции.
      *         string       transactionFee          Размер комиссии в транзакции.
      *         string       coin                    Символ монеты, в которой номинированы средства в транзакции.
      *         integer      status                  Статус транзакции.
      *                                              Возможные значения:
      *                                                                  0 - отправлено уведомление.
      *                                                                  1 - отменено.
      *                                                                  2 - ожидается подтверджение.
      *                                                                  3 - отклонено.
      *                                                                  4 - находится в обработке.
      *                                                                  5 - отказано.
      *                                                                  6 - завершено.
      *         string       address                 Адрес в сети, на который выводены средства.
      *         string       txId                    Идентификатор транзакции вывода средств.
      *         string       applyTime               Время транзакции в формате: 'Y-m-d H:i:s'
      *         string       network                 Имя сети, через выведены средства.
      *         integer      transferType            Тип транзакции.
      *                                              Возможные значения:
      *                                                                  0 - внешняя передача.
      *                                                                  1 - внутрення передача.
      *         string       withdrawOrderId         Возвращается, если в запросе указан параметр $withdrawOrderId.
      *         string       info                    Сообщение с причиной отказа в транзакции.
      *         integer      confirmNo               Время подтверждения запроса на вывод средств.
      *         integer      walletType              Статус транзакции.
      *                                              Возможные значения:
      *                                                                  0 - спотовый кошелек.
      *                                                                  1 - кошелек для финансирования.
      *         string       txKey                   Текстовый ключ.
      */

     /**
      * Функция проверки аргументов, переданных функции SendQuery()
      */
     protected function CheckArguments() {

     }
     /**
      * Функция получения веса текущего запроса, используемого для расчета лимитов Binance API
      *
      * @return array                       Вес текущего запроса
      */
     protected function GetQueryWeight() {
        return 1;
     }
     /**
      * Конструктор строки запроса
      *
      * @return string                  Строка запроса 
      */
     protected function ConstructQueryString() {
        $output['type'] = $this->arguments[0];
        if (1 == count($this->arguments)) {
           return $output;
        }
        if (in_array(self::LIMIT, $this->arguments)) {
           $output['limit'] = $this->arguments[1];
           if (isset($this->arguments[2])) {
              $this::SetRecvWindow($this->arguments[2]);
           }
           return $output;
        }
        if (in_array(self::RECV, $this->arguments)) {
           $this::SetRecvWindow($this->arguments[1]);
           return $output;
        }
        $output['startTime'] = $this->arguments[1];
        $output['endTime'] = $this->arguments[2];
        if (!in_array(self::TIME, $this->arguments)) {
           if (4 == count($this->arguments)) {
              $this::SetRecvWindow($this->arguments[3]);
           }
        } else {
           if (5 == count($this->arguments)) {
              $this::SetRecvWindow($this->arguments[3]);
           }
        }
        return $output;
     }
 }
?>