<?php
  /**
   * BNallCoinsInformation: Производный класс конструктора запросов и обработчика ответов 
   * интерфейса информации о монетах (доступных для ввода и вывода) для пользователя сервиса Binance API
   */  
  class BNallCoinsInformation extends BNinterfaceSAPI {
     use SignedGET;
     /**
      * @param  string   $path              Путь к интерфейсу сервиса Binance API
      */
     protected $path = '/sapi/v1/capital/config/getall';
     /**
      * Функция отправки запроса и обработки ответа 
      * Допустимые аргументы функции BNallCoinsInformation::SendQuery()
      *                              BNallCoinsInformation::SendQuery($recvWindow)
      *
      * @param  integer  $recvWindow        Период (в миллисекундах), в течении которого
      *                                     запрос действителен
      *
      * @return array                       Ассоциативный массив, ассоциативные массивы с информацей 
      *                                     о монетах, доступных для пользователя.
      *                                     Каждый из ассоциативных массивов содержит следующие элементы:
      *                                          string    coin                     Символ монеты.
      *                                          bool      depositAllEnable         Сообщение, возможен ли ввод монеты на аккаунт.
      *                                                                             TRUE - возможен. FALSE - не возможен.
      *                                          bool      withdrawAllEnable        Сообщение, возможен ли вывод монеты с аккаунта.
      *                                                                             TRUE - возможен. FALSE - не возможен.
      *                                          string    name                     Имя монеты.
      *                                          string    free                     Доступный объем средств на аккаунте, номинированный в монете.
      *                                          string    locked                   Объем средств на аккаунте, заблокированный из-за открытых ордеров.
      *                                          string    freeze                   Замороженный объем средств на аккаунте, номинированный в монете.
      *                                          string    withdrawing              Объем средств, выведенный с аккаунта.
      *                                          string    ipoing                   Объем средств на аккаунте, выпущеннный в рамках IPO.
      *                                          string    ipoable                  Объем средств на аккаунте, доступный для выпуска в рамках IPO.
      *                                          string    storage                  Объем средств, номинированный в монете, на хранении.
      *                                          bool      isLegalMoney             Сообщение, считается ли монета законной валютой.
      *                                                                             TRUE - считается. FALSE - не считается.
      *                                          bool      trading                  Сообщение, возможны ли торги монетой на бирже.
      *                                                                             TRUE - возможны. FALSE - не возможен.
      *                                          array     networkList              Массив, содержащий ассоциативные массивы  с информацией о сетях,
      *                                                                             в которых выпускается монета.
      *                                                                             Каждый из ассоциативных массивов содержит следующие элементы:
      *                                                                                  string       network                    Имя сети.
      *                                                                                  string       coin                       Символ монеты.
      *                                                                                  string       withdrawIntegerMultiple    Максимальная точность, с которой может быть
      *                                                                                                                          указан объем средств, номинированный в BTC,
      *                                                                                                                          выводимый с депозита.
      *                                                                                  bool         isDefault                  Сообщение, выводятся ли средства в эту сеть по умолчанию.
      *                                                                                                                          TRUE - выводятся. FALSE - не выводятся.
      *                                                                                  bool         depositEnable              Сообщение, возможен ли ввод монеты на депозит.
      *                                                                                                                          TRUE - возможен. FALSE - не возможен.
      *                                                                                  bool         withdrawEnable             Сообщение, возможен ли вывод монеты с депозита.
      *                                                                                                                          TRUE - возможен. FALSE - не возможен.
      *                                                                                  string       depositDesc                Сообщение о состоянии кошелька. Показывается только
      *                                                                                                                          тогда, когда невозможен ввод монеты на депозит.
      *                                                                                                                          (свойство 'depositEnable' = FALSE)
      *                                                                                  string       withdrawDesc               Сообщение о состоянии кошелька. Показывается только
      *                                                                                                                          тогда, когда невозможен вывод монеты с депозита.
      *                                                                                                                          (свойство 'withdrawEnable' = FALSE)
      *                                                                                  string       specialTips                Поле для дополнительного сообщения о вводе.
      *                                                                                  string       specialWithdrawTips        Поле для дополнительного сообщения о выводе.
      *                                                                                  string       name                       Имя токена, под которым монета выпускается в сети.
      *                                                                                  bool         resetAddressStatus         Сообщение, требуется ли перезагрузка адреса ввода.
      *                                                                                                                          TRUE - требуется. FALSE - не требуется.
      *                                                                                  string       addressRegex               Регулярное выражение для адреса ввода монеты.
      *                                                                                  string       addressRule                Правило для адреса ввода монеты.
      *                                                                                  string       memoRegex                  Регулярное выражение для MEMO.
      *                                                                                  string       withdrawFee                Значение комиссии за вывод.
      *                                                                                  string       withdrawMin                Минимальная сумма вывода.
      *                                                                                  string       withdrawMax                Максимальная сумма вывода.
      *                                                                                  integer      minConfirm                 Минимальное количество подтверждений для ввода.
      *                                                                                  integer      unLockConfirm              Минимальное количество для вывода.
      *                                                                                  bool         sameAddress                Сообщение, требуется ли MEMO для вывода.
      *                                                                                                                          TRUE - требуется. FALSE - не требуется.
      *                                                                                  integer      estimatedArrivalTime       Ожидаемое время вывода средств.
      *                                                                                  bool         busy                       Сообщение, перегружена ли сеть.
      *                                                                                                                          TRUE - перегружена. FALSE - не перегружена.
      *                                                                                  string       country                     Имя страны, в которой расположена сеть.
      */
     static public function SendQuery($recvWindow = NULL) {
        self::SaveArguments($recvWindow);
        return self::ExecuteSendQuery();
     }
     /**
      * Функция записи аргументов, переданных функции SendQuery()
      *
      * @param  integer  $recvWindow        Период (в миллисекундах), в течении которого
      *                                     запрос действителен
      */
     static protected function SaveArguments($recvWindow = NULL) {
        if (!is_null($recvWindow)) {
           self::$arguments['recvWindow'] = $recvWindow;
        }
     }
     /**
      * Функция проверки аргументов, переданных функции SendQuery()
      */
     protected function CheckArguments() {
        if (isset(self::$arguments['recvWindow']) && !is_integer(self::$arguments['recvWindow'])) {
              throw new BNinterfaceException(get_called_class(),
                                             'Недопустимый тип аргумента recvWindow, переданного функции SendQuery().');
        }
     }
     /**
      * Функция получения веса текущего запроса, используемого для расчета лимитов Binance API
      *
      * @return array                       Вес текущего запроса
      */
     protected function GetQueryWeight() {
        return 10;
     }
     /**
      * Конструктор строки запроса
      *
      * @return string                  Строка запроса 
      */
     protected function ConstructQueryString(){
        if (count(self::$arguments) > 0) {
           return self::$arguments;
        }
     }
 }
?>