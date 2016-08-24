<?php
/**
 * @author         SagittariusX <unikado+sag@gmail.com>
 * @copyright  (c) 2016, SagittariusX
 * @package        Beluga
 * @since          2016-08-21
 * @subpackage     Date
 * @version        0.1.0
 */


namespace Beluga\Date;


/**
 * The Beluga\Date\TimeFormat enumeration.
 *
 * @since v0.1.0
 */
interface TimeFormat
{

   /**
    * 24 hour format 'H:i:s' e.g.: '21:24:00'
    */
   const FULL_24H  = 'H:i:s';

   /**
    * 24 hour short format 'H:i' e.g: '21:24'
    */
   const SHORT_24H = 'H:i';

   /**
    * 12 hour format 'h:i:s A' e.g.: '09:24:00 AM'
    */
   const FULL_12H  = 'h:i:s A';

   /**
    * 12 hour short format 'h:i A' e.g: '09:24 PM'
    */
   const SHORT_12H = 'H:i A';

}

