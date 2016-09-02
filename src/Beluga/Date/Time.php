<?php
/**
 * In this file the class '\Beluga\Date\Time' is defined.
 *
 * @author         SagittariusX <unikado+sag@gmail.com>
 * @copyright  (c) 2016, SagittariusX
 * @package        Beluga
 * @since          2016-08-21
 * @subpackage     Date
 * @version        0.2.0
 */


declare( strict_types = 1 );


namespace Beluga\Date;


use \Beluga\ArgumentError;


/**
 * This class defines a object for better time handling.
 *
 * If the class is casted to a string, the {@see \Beluga\Date\DateTimeFormat::RFC822} format is used.
 *
 * @property      integer       $hour            The hours of current time.
 * @property      integer       $minute          The minutes of current time.
 * @property      integer       $seconds         The seconds of current time.
 * @property      integer       $secondsAbsolute The seconds that represents hours + minutes + seconds as seconds :-)
 * @since         v0.1.0
 */
class Time
{


   // <editor-fold desc="// = = = =   P R O T E C T E D   F I E L D S   = = = = = = = = = = = = = = = = = = = = = = =">

   /**
    * Holds the internal properties hour, minute, second. They are accessible as dynamic properties.
    *
    * @var array
    */
   protected $properties = [
      'hour'   => 0,
      'minute' => 0,
      'second' => 0
   ];

   // </editor-fold>


   // <editor-fold desc="// = = = =   P U B L I C   C O N S T R U C T O R   = = = = = = = = = = = = = = = = = = = = =">

   /**
    * Init's a new instance.
    *
    * @param integer $hour   The hour (0-23) If null is defined, the current hour will be used.
    * @param integer $minute The minute (0-59) If null is defined, the current minute will be used.
    * @param integer $second The second (0-59) If null is defined, the current second will be used.
    */
   public function __construct( int $hour = null, int $minute = null, int $second = null )
   {

      if ( \is_null( $hour ) )
      {
         $hour = static::CurrentHour();
      }

      if ( \is_null( $minute ) )
      {
         $minute = static::CurrentMinute();
      }

      if ( \is_null( $second ) )
      {
         $second = static::CurrentSecond();
      }

      $this->properties = array(
         'hour'   => \intval( $hour ),
         'minute' => \intval( $minute ),
         'second' => \intval( $second )
      );

   }

   // </editor-fold>


   // <editor-fold desc="// = = = =   P U B L I C   M E T H O D S   = = = = = = = = = = = = = = = = = = = = = = = = =">


   // <editor-fold desc="// - - -   G E T T E R   - - - - - - - - - - - - - - - - - - - - - -">

   /**
    * Returns the hour.
    *
    * @return integer
    */
   public function getHour() : int
   {

      return $this->properties[ 'hour' ];

   }

   /**
    * Returns the minute.
    *
    * @return integer
    */
   public function getMinute() : int
   {

      return $this->properties[ 'minute' ];

   }

   /**
    * Returns the second.
    *
    * @return integer
    */
   public function getSecond() : int
   {

      return $this->properties[ 'second' ];

   }

   /**
    * Get a value in seconds that represents the hour + minutes + seconds as seconds :-)
    * (e.g. 60 = 00:01:00)
    *
    * @return integer
    */
   public function getSecondsAbsolute() : int
   {
      return
         ( $this->properties[ 'hour' ] * 60 * 60 )
         +
         ( $this->properties[ 'minute' ] * 60 )
         +
         $this->properties[ 'second' ];
   }

   public function __get( $name )
   {

      switch ( \strtolower( $name ) )
      {

         case 'hour'  : case 'hours'  : return $this->properties[ 'hour' ];
         case 'minute': case 'minutes': return $this->properties[ 'minute' ];
         case 'second': case 'seconds': return $this->properties[ 'second' ];
         case 'secondsabsolute':        return $this->getSecondsAbsolute();

      }

      throw new \LogicException( 'can not access unknown Time property "' . $name . '"!' );

   }

   // </editor-fold>


   // <editor-fold desc="// - - -   S E T T E R   - - - - - - - - - - - - - - - - - - - - - -">

   /**
    * Sets the hour.
    *
    * @param  int $value The hour (0-23 or NULL if current hour should be used)
    * @return \Beluga\Date\Time
    */
   public function setHour( int $value = null ) : Time
   {

      if ( \is_null( $value ) )
      {
         $this->properties[ 'hour' ] = static::CurrentHour();
         return $this;
      }

      $intValue = \intval( $value );

      if ( $intValue < 0 )
      {
         $this->properties[ 'hour' ] = 0;
      }
      else if ( $intValue > 23 )
      {
         $this->properties[ 'hour' ] = $intValue % 24;
      }
      else
      {
         $this->properties[ 'hour' ] = $intValue;
      }

      return $this;

   }

   /**
    * Sets the minute.
    *
    * @param  integer $value The minute (0-59 or NULL if current minute should be used)
    * @return \Beluga\Date\Time
    */
   public function setMinute( int $value = null ) : Time
   {

      if ( \is_null( $value ) )
      {
         $this->properties[ 'minute' ] = static::CurrentMinute();
         return $this;
      }

      $intValue = \intval( $value );

      if ( $intValue < 0 )
      {
         $this->properties[ 'minute' ] = 0;
      }
      else if ( $intValue > 59 )
      {
         $this->properties[ 'minute' ] = $intValue % 60;
      }
      else
      {
         $this->properties[ 'minute' ] = $intValue;
      }

      return $this;

   }

   /**
    * Sets the second.
    *
    * @param  int|NULL $value The second (0-59 or NULL if current second should be used)
    * @return \Beluga\Date\Time
    */
   public function setSecond( int $value = null ) : Time
   {

      if ( \is_null( $value ) )
      {
         $this->properties[ 'second' ] = static::CurrentSecond();
         return $this;
      }

      $intValue = \intval( $value );

      if ( $intValue < 0 )
      {
         $this->properties[ 'second' ] = 0;
      }
      else if ( $intValue > 59 )
      {
         $this->properties[ 'second' ] = $intValue % 60;
      }
      else
      {
         $this->properties[ 'second' ] = $intValue;
      }

      return $this;

   }

   /**
    * Sets a value in seconds that represents the hour + minutes + seconds as seconds :-)
    *
    * @param  integer $value The absolute seconds, representing the time. (e.g. 60 = 00:01:00)
    * @return \Beluga\Date\Time
    * @throws \Beluga\ArgumentError If $value is lower than 0 or bigger than 86399.
    */
   public function setSecondsAbsolute( int $value ) : Time
   {

      if ( $value < 0 )
      {
         throw new ArgumentError( 'Core', 'An absolute-seconds time value can not be lower that 0!');
      }

      if ( $value > 86399 )
      {
         throw new ArgumentError(
            'Core',
            'An absolute-seconds time value can not be higher than 86399! (23:59:59)'
         );
      }

      if ( $value < 60 )
      {
         // $value is lower than a minute (0-59 seconds)
         $this->properties[ 'hour'   ] = 0;
         $this->properties[ 'minute' ] = 0;
         $this->properties[ 'second' ] = $value;
         return $this;
      }

      // extract the seconds part
      $this->properties[ 'second' ] = $value % 60;
      // and remove the seconds part
      $value -= $this->properties[ 'second' ];

      if ( $value < 3600 )
      {
         // The rest of $value is not a full hour.
         // Getting the minutes (0-59)
         $this->properties[ 'hour'   ] = 0;
         $this->properties[ 'minute' ] = $value / 60;
         return $this;
      }

      // value is 3600 or higher (1 hour or more)

      // extract the minutes part
      $this->properties[ 'minute' ] = ( $value % 3600 ) / 60;
      // and remove the minutes part
      $value -= ( $this->properties[ 'minute' ] * 60 );

      // value is now 3600 or a multiple of it.
      $this->properties[ 'hour' ] = $value / 3600;

      return $this;

   }

   public function __set( $name, $value )
   {

      switch ( \strtolower( $name ) )
      {

         case 'hour'  : case 'hours'  :
            if ( \is_null( $value ) ) { return $this->setHour(); }
            return $this->setHour( \intval( $value ) );

         case 'minute': case 'minutes':
            if ( \is_null( $value ) ) { return $this->setMinute(); }
            return $this->setMinute( \intval( $value ) );

         case 'second': case 'seconds':
            if ( \is_null( $value ) ) { return $this->setSecond(); }
            return $this->setSecond( \intval( $value ) );

         case 'secondsabsolute':
            return $this->setSecondsAbsolute( \intval( $value ) );

      }

      throw new \LogicException( 'can not access unknown Time property "' . $name . '"!' );

   }

   // </editor-fold>


   // <editor-fold desc="// - - -   O T H E R   M E T H O D S   - - - - - - - - - - - - - - -">

   /**
    * Returns the time with format H:i:s.
    *
    * @return string
    */
   public function __toString()
   {

      return \sprintf(
         "%'.02d:%'.02d:%'.02d",
         $this->properties[ 'hour' ],
         $this->properties[ 'minute' ],
         $this->properties[ 'second' ]
      );

   }

   /**
    * @inherit-doc
    *
    * @return \Beluga\Date\Time
    */
   public function __clone()
   {

      return new Time(
         $this->properties[ 'hour' ],
         $this->properties[ 'minute' ],
         $this->properties[ 'second' ]
      );

   }

   /**
    * Returns if the current time points to the day end (23:59:59).
    *
    * @return boolean
    * @see    \Beluga\Date\Time::isStartOfDay()
    */
   public final function isEndOfDay() : bool
   {

      return
         $this->properties[ 'hour' ] === 23
         &&
         $this->properties[ 'minute' ] === 59
         &&
         $this->properties[ 'second' ] === 59;

   }

   /**
    * Returns if the current time points to the day start (00:00:00).
    *
    * @return boolean
    * @see    \Beluga\Date\Time::isEndOfDay()
    */
   public final function isStartOfDay() : bool
   {

      return
         $this->properties[ 'hour' ] === 0
         &&
         $this->properties[ 'minute' ] === 0
         &&
         $this->properties[ 'second' ] === 0;

   }

   /**
    * Returns if the current Time is inside the AM range. (Otherwise it will be a part of the PM range)
    *
    * @return boolean
    * @see    \Beluga\Date\Time::isPostMeridiem()
    */
   public final function isAnteMeridiem() : bool
   {

      return $this->properties[ 'hour' ] > 0
             &&
             $this->properties[ 'hour' ] < 13;

   }

   /**
    * Returns if the current Time is inside the PM range. (Otherwise it will be a part of the AM range)
    *
    * @return boolean
    * @see    \Beluga\Date\Time::isAnteMeridiem()
    */
   public final function isPostMeridiem() : bool
   {

      return ! $this->isAnteMeridiem();

   }

   /**
    * Adds or removes (negative values) the defined number of seconds. If the resulting time is out of the
    * allowed time range (0-86399 seconds absolute) only the usable seconds are added or removed!
    *
    * @param  integer $seconds The seconds to add|remove (use a negative value to subtract/remove the seconds)
    * @return \Beluga\Date\Time Returns the current changed instance.
    */
   public final function addSeconds( int $seconds = 1 ) : Time
   {

      if ( $seconds == 0
           || ( $seconds > 0 && $this->isEndOfDay() )
           || ( $seconds < 0 && $this->isStartOfDay() ) )
      {
         // There is nothing to do
         return $this;
      }

      // Getting the currently absolute seconds
      $absSeconds = $this->getSecondsAbsolute();

      // Calculate the new absolute seconds
      $tmp = $absSeconds + $seconds;

      if ( $tmp > 86399 )
      {
         // Ensure $tmp is not bigger than 23:59:59
         $tmp = 86399;
      }
      if ( $tmp < 0 )
      {
         // Ensure $tmp is not lower than 00:00:00
         $tmp = 0;
      }

      // Setting the new time
      $this->setSecondsAbsolute( $tmp );

      return $this;

   }

   /**
    * Adds or removes (negative values) the defined number of full minutes. If the resulting time is out of the
    * allowed time range only the usable minutes + seconds are added or removed!
    *
    * @param  integer $minutes The full minutes to add|remove (use a negative value to subtract/remove the minutes)
    * @return \Beluga\Date\Time Returns the current changed instance.
    */
   public final function addMinutes( int $minutes = 1 ) : Time
   {

      return $this->addSeconds( $minutes * 60 );

   }

   /**
    * Adds or removes (negative values) the defined number of hours. If the resulting time is out of the
    * allowed time range only the usable hours + minutes + seconds are added or removed!
    *
    * @param  integer $hours The hours to add|remove (use a negative value to subtract/remove the hours)
    * @return \Beluga\Date\Time Returns the current changed instance.
    */
   public final function addHours( int $hours = 1 ) : Time
   {

      return $this->addSeconds( $hours * 3600 );

   }

   /**
    * Formats the current time and returns it as an string.
    *
    * The following format parameters are parsed:
    *
    * - <b>a</b> (am or pm): Lower case Ante meridiem (01:00:00 - 12:59:59) and Post meridiem (13:00:00 - 00:59:59)
    * - <b>A</b> (AM or PM): Upper case Ante meridiem (01:00:00 - 12:59:59) and Post meridiem (13:00:00 - 00:59:59)
    * - <b>g</b> (1 - 12): The hour with 12h format without leading zero
    * - <b>G</b> (0 - 23): The hour with 24h format without leading zero
    * - <b>h</b> (01 - 12): The hour with 12h format with leading zero
    * - <b>H</b> (00 - 23): The hour with 24h format with leading zero
    * - <b>i</b> (00 - 59): The minute with leading zero
    * - <b>s</b> (00 - 59): The second with leading zero
    *
    * If you will use one of this characters not meaning a format marker, you have to escape it with a leading
    * backslash!
    *
    * @param  string $formatString The Time formatting string. e.g.: H:i:s for 04:02:01
    * @return string
    */
   public final function format( string $formatString ) : string
   {

      // Handle often used directly

      if ( $formatString == TimeFormat::FULL_12H )
      {  // h:i:s A
         return \sprintf(
            "%'.02d:%'.02d:%'.02d %s",
            $this->get12hHour(),
            $this->properties[ 'minute' ],
            $this->properties[ 'second' ],
            $this->getMeridiem()
         );
      }

      if ( $formatString == TimeFormat::SHORT_12H )
      {
         return \sprintf(
            "%'.02d:%'.02d %s",
            $this->get12hHour(),
            $this->properties[ 'minute' ],
            $this->getMeridiem()
         );
      }

      if ( $formatString == TimeFormat::FULL_24H )
      {
         return \sprintf(
            "%'.02d:%'.02d:%'.02d",
            $this->properties[ 'hour' ],
            $this->properties[ 'minute' ],
            $this->properties[ 'second' ]
         );
      }

      if ( $formatString == TimeFormat::SHORT_24H )
      {
         return \sprintf(
            "%'.02d:%'.02d",
            $this->properties[ 'hour' ],
            $this->properties[ 'minute' ]
         );
      }

      $formatChars    = [ 'a', 'A', 'g', 'G', 'h', 'H', 'i', 's' ];
      $backslashCount = 0;
      $result         = '';

      for ( $i = 0, $c = \strlen( $formatString ); $i < $c; ++$i )
      {
         // Handle each single character
         $char = $formatString[ $i ];
         if ( \in_array( $char, $formatChars ) )
         {
            // The current char is a format char that should be replaced in normal cases.
            if ( $backslashCount > 0 )
            {
               // But there was a backslash before so it should be used as it
               if ( $backslashCount > 1 )
               {
                  // Append the unsaved backslashes if there are more than 1 (the last will be ignored)
                  $result .= \str_repeat( '\\', $backslashCount - 1 );
               }
               // Append the current char as it
               $result .= $char;
               // empty the $backslashCount
               $backslashCount = 0;
               // Goto next char
               continue;
            }
            switch ( $char )
            {
               case 'a':
                  $result .= $this->getMeridiem( true );
                  break;
               case 'A':
                  $result .= $this->getMeridiem();
                  break;
               case 'g':
                  $result .= \strval( $this->get12hHour() );
                  break;
               case 'G':
                  $result .= \strval( $this->properties[ 'hour' ] );
                  break;
               case 'h':
                  $result .= \sprintf( "%'.02d",  $this->get12hHour() );
                  break;
               case 'H':
                  $result .= \sprintf( "%'.02d",  $this->properties[ 'hour' ] );
                  break;
               case 'i':
                  $result .= \sprintf( "%'.02d",  $this->properties[ 'minute' ] );
                  break;
               case 's':
                  $result .= \sprintf( "%'.02d",  $this->properties[ 'second' ] );
                  break;
            }
            continue;
         }
         if ( $char == '\\' )
         {
            ++$backslashCount;
            continue;
         }
         // Not a special meaning char
         if ( $backslashCount > 0 )
         {
            $result .= \str_repeat( '\\', $backslashCount );
            $backslashCount = 0;
         }
         $result .= $char;
      }

      return $result;

   }

   /**
    * Compares the current instance with the defined. It returns -1, if $value is higher (newer) than current one,
    * 0 if both times are equal, or 1, if current is higher (newer) than $value.
    *
    * @param  mixed $value
    * @return int|bool -1, 0, 1 oder (bool)FALSE if comparing fails because $value is of a unusable type
    */
   public function compare( $value )
   {

      if ( ! ( $value instanceof Time ) )
      {
         if ( false === ( $value = Time::Parse( $value ) ) )
         {
            return false;
         }
      }

      $val = $value->getSecondsAbsolute();
      $thi = $this->getSecondsAbsolute();

      return ( ( $val > $thi ) ? -1 : ( ( $val < $thi ) ? 1 : 0 ) );

   }

   /**
    * Checks if current instance is equal to permitted $value.
    *
    * If $strict is set to TRUE it returns FALSE, if $value is not of type {@see \Beluga\Time}.
    *
    * If $strict is set to FALSE $value can also be:
    *
    * - a integer (Unix timestamp)
    * - a \DateTime instance
    * - a \Beluga\DateTime instance
    * - a date time string like '2015-04-02 12:00:01' or something other valid format
    * - a time string like '12:00:01' or something other valid format
    *
    * @param  mixed   $value  The value to compare with.
    * @param  boolean $strict The value must be of type {@see \Beluga\Time}? (default=false)
    * @return boolean         Returns TRUE if $value is equal to current instance, FALSE otherwise.
    */
   public function equals( $value, bool $strict = false ) : bool
   {

      if ( $value instanceof Time )
      {
         // Strict: The time stamp must be equal
         return $value->getSecondsAbsolute() === $this->getSecondsAbsolute();
      }

      if ( $strict )
      {
         // Strict + $value is no \Beluga\Time instance returns FALSE
         return false;
      }

      if ( false === ( $t = Time::Parse( $value ) ) )
      {
         return false;
      }

      return $t->getSecondsAbsolute() === $this->getSecondsAbsolute();

   }

   // </editor-fold>


   // </editor-fold>


   // <editor-fold desc="// = = = =   P U B L I C   S T A T I C   M E T H O D S   = = = = = = = = = = = = = = = = = =">

   /**
    * Parses a time definition to a \Beluga\Date\Time instance.
    *
    * @param  mixed $timeDefinition The value to parse as Time. It can be a (date) time string, a unix timestamp, a
    *                               object of type \Beluga\DateTime or \DateTime or something that can be converted, by
    *                               a string cast, to a valid time string.
    * @return \Beluga\Date\Time|bool  Returns the created \Beluga\Date\Time instance, or boolean FALSE if parsing fails.
    */
   public static function Parse( $timeDefinition )
   {

      if ( $timeDefinition instanceof Time )
      {
         // No converting needed! Return as it.
         return $timeDefinition;
      }

      if ( $timeDefinition instanceof DateTime )
      {
         return $timeDefinition->getTime();
      }

      if ( $timeDefinition instanceof \DateTime )
      {
         return ( new DateTime( $timeDefinition ) )->getTime();
      }

      if ( false !== ( $dt = DateTime::Parse( $timeDefinition ) ) )
      {
         return $dt->getTime();
      }

      return false;

   }

   /**
    * Tries to parse a time definition to a \Beluga\Time instance.
    *
    * @param  mixed $timeDefinition The value to parse as Time. It can be a (date) time string, a unix timestamp, a
    *                               object of type \Beluga\DateTime or \DateTime or something that can be converted, by
    *                               a string cast, to a valid time string.
    * @param  Time  $refTime        Returns the new Time instance if the method returns TRUE
    * @return bool                  Returns if the parsing was successful.
    */
   public static function TryParse( $timeDefinition, Time &$refTime )
      : bool
   {

      if ( $timeDefinition instanceof Time )
      {
         // No converting needed! Return as it.
         $refTime = $timeDefinition;
         return true;
      }

      if ( $timeDefinition instanceof DateTime )
      {
         $refTime = $timeDefinition->getTime();
         return true;
      }

      if ( $timeDefinition instanceof \DateTime )
      {
         $refTime = ( new DateTime( $timeDefinition ) )->getTime();
         return true;
      }

      if ( false !== ( $dt = DateTime::Parse( $timeDefinition ) ) )
      {
         $refTime = $dt->getTime();
         return true;
      }

      return false;

   }

   /**
    * Returns the current hour.
    *
    * @return integer
    */
   public static function CurrentHour() : int
   {

      return \intval( \strftime( '%h' ) );

   }

   /**
    * Returns the current minute.
    *
    * @return integer
    */
   public static function CurrentMinute() : int
   {

      return \intval( \strftime( '%M' ) );

   }

   /**
    * Returns the current second.
    *
    * @return integer
    */
   public static function CurrentSecond() : int
   {

      return \intval( \strftime( '%S' ) );

   }

   // </editor-fold>


   // <editor-fold desc="// = = = =   P R O T E C T E D   M E T H O D S   = = = = = = = = = = = = = = = = = = = = = =">

   /**
    * Returns the hour in 12 hour format. (e.g. 13:00 is 01:00 etc.)
    *
    * @return integer
    */
   protected function get12hHour() : int
   {

      if ( $this->isAnteMeridiem() )
      {
         return $this->getHour();
      }

      if ( $this->properties[ 'hour' ] == 0 )
      {
         return 12;
      }

      if ( $this->properties[ 'hour' ] > 12 )
      {
         return $this->properties[ 'hour' ] - 12;
      }

      return $this->properties[ 'hour' ];

   }

   /**
    * Returns the current meridiem (in lower case am|pm or in upper case AM|PM)
    *
    * @param  boolean $lowercase Return in lower case?
    * @return string
    */
   protected function getMeridiem( bool $lowercase = false ) : string
   {

      if ( $this->properties[ 'hour' ] > 0 &&
           $this->properties[ 'hour' ] < 13 )
      {
         return $lowercase ? 'am' : 'AM';
      }

      return $lowercase ? 'pm' : 'PM';

   }

   // </editor-fold>


}

