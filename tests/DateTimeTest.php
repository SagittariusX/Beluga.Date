<?php


use \Beluga\Date\DateTime;
use \Beluga\Date\Time;
use \Beluga\Translation\Locale;


/**
 * @author         SagittariusX <unikado+sag@gmail.com>
 * @copyright  (c) 2016, SagittariusX
 * @since          2016-08-29
 * @version        0.1.0
 */
class DateTimeTest extends PHPUnit_Framework_TestCase
{

   /**
    * @var \Beluga\Date\DateTime
    */
   private $dt;
   /**
    * @var \Beluga\Date\DateTime
    */
   private $dt2;
   /**
    * @var \Beluga\Date\DateTime
    */
   private $dt3;

   public function setUp()
   {

      if ( ! ( $this->dt instanceof DateTime ) )
      {

         // Ensure the german locale is used for this tests
         ( new Locale( 'de', 'DE', 'UTF-8' ) )->registerAsGlobalInstance();

      }

      $this->dt = DateTime::Parse( '2016-06-24 13:15:00', new \DateTimeZone( 'Europe/Berlin' ) );
      $this->dt2 = DateTime::Parse( '1942-03-21 12:05:44', new \DateTimeZone( 'Europe/Berlin' ) );
      $this->dt3 = DateTime::Parse( '2016-03-20 12:24:32', new \DateTimeZone( 'Europe/Berlin' ) );

   }

   public function testGetYear()
   {

      $this->assertSame( 2016, $this->dt->year );
      $this->assertSame( 2016, $this->dt->getYear() );
      $this->assertSame( 1942, $this->dt2->year );
      $this->assertSame( 1942, $this->dt2->getYear() );

   }

   public function testGetMonth()
   {

      $this->assertSame( 6, $this->dt->month );
      $this->assertSame( 6, $this->dt->getMonth() );
      $this->assertSame( 3, $this->dt2->month );
      $this->assertSame( 3, $this->dt2->getMonth() );

   }

   public function testGetDay()
   {

      $this->assertSame( 24, $this->dt->day );
      $this->assertSame( 24, $this->dt->getDay() );
      $this->assertSame( 21, $this->dt2->day );
      $this->assertSame( 21, $this->dt2->getDay() );

   }

   public function testGetHour()
   {

      $this->assertSame( 13, $this->dt->hour );
      $this->assertSame( 13, $this->dt->getHour() );
      $this->assertSame( 12, $this->dt2->hour );
      $this->assertSame( 12, $this->dt2->getHour() );

   }

   public function testGetMinute()
   {

      $this->assertSame( 15, $this->dt->minute );
      $this->assertSame( 15, $this->dt->getMinute() );
      $this->assertSame( 5, $this->dt2->minute );
      $this->assertSame( 5, $this->dt2->getMinute() );

   }

   public function testGetSecond()
   {

      $this->assertSame( 0, $this->dt->second );
      $this->assertSame( 0, $this->dt->getSecond() );
      $this->assertSame( 44, $this->dt2->second );
      $this->assertSame( 44, $this->dt2->getSecond() );

   }

   public function testGetDayNumberOfWeek()
   {

      $this->assertSame( 5, $this->dt->dayOfWeek );
      $this->assertSame( 5, $this->dt->getDayNumberOfWeek() );

   }

   public function testGetISO8601DayNumberOfWeek()
   {

      $this->assertSame( 5, $this->dt->getISO8601DayNumberOfWeek() );

   }

   public function testGetQuarter()
   {

      $this->assertSame( 2, $this->dt->quarter );
      $this->assertSame( 2, $this->dt->getQuarter() );
      $this->assertSame( 1, $this->dt2->quarter );
      $this->assertSame( 1, $this->dt2->getQuarter() );

   }

   public function testGetDifferenceYears()
   {

      $this->assertSame( 74, $this->dt->getDifferenceYears( $this->dt2, true ) );

   }

   public function testGetTimezoneOffsetRFC822()
   {

      $this->assertSame( '+0200', $this->dt->getTimezoneOffsetRFC822(), 'testGetTimezoneOffsetRFC822 1' );
      $this->assertSame( '+0200', $this->dt2->getTimezoneOffsetRFC822(), 'testGetTimezoneOffsetRFC822 2' );

   }

   public function testGetTimezoneOffsetGMT()
   {

      $this->assertSame( '+02:00', $this->dt->getTimezoneOffsetGMT(), 'getTimezoneOffsetGMT 1' );
      $this->assertSame( '+02:00', $this->dt2->getTimezoneOffsetGMT(), 'getTimezoneOffsetGMT 2' );

   }

   public function testGetTimezoneName()
   {

      $this->assertSame( 'Europe/Berlin', $this->dt->getTimezoneName(), 'getTimezoneName 1' );
      $this->assertSame( 'Europe/Berlin', $this->dt2->getTimezoneName(), 'getTimezoneName 2' );

   }

   public function testGetTimezoneNameShort()
   {

      $this->assertSame( 'CEST', $this->dt->getTimezoneNameShort(), 'getTimezoneNameShort 1' );
      $this->assertSame( 'CEST', $this->dt2->getTimezoneNameShort(), 'getTimezoneNameShort 2' );

   }

   public function testGetTime()
   {

      $this->assertSame( '13:15:00', (string) $this->dt->getTime(), 'getTime 1' );
      $this->assertSame( '12:05:44', (string) $this->dt2->getTime(), 'getTime 2' );

   }

   public function testGetIsLeapYear()
   {

      $this->assertTrue ( $this->dt->getIsLeapYear(), 'getIsLeapYear 1' );
      $this->assertFalse( $this->dt2->isLeapYear, 'getIsLeapYear 2' );

   }

   public function testGetDaysOfYear()
   {

      $this->assertSame( 366, $this->dt->getDaysOfYear(), 'getDaysOfYear 1' );
      $this->assertSame( 365, $this->dt2->daysOfYear, 'getDaysOfYear 2' );

   }

   public function testGetDaysOfMonth()
   {

      $this->assertSame( 30, $this->dt->getDaysOfMonth(), 'getDaysOfMonth 1' );
      $this->assertSame( 31, $this->dt2->daysInMonth, 'getDaysOfMonth 2' );

   }

   public function testGetDayOfYear()
   {

      $this->assertSame( 175, $this->dt->getDayOfYear(), 'getDayOfYear 1' );
      $this->assertSame( 79, $this->dt2->dayOfYear, 'getDayOfYear 2' );

   }

   public function testGetISO8601WeekNumber()
   {

      $this->assertSame( 25, $this->dt->getISO8601WeekNumber(), 'getISO8601WeekNumber 1' );
      $this->assertSame( 12, $this->dt2->getISO8601WeekNumber(), 'getISO8601WeekNumber 2' );

   }

   public function testGetDate()
   {

      $this->assertSame( '2016-06-24 00:00:00', $this->dt->getDate()->format( 'Y-m-d H:i:s' ), 'getDate 1' );
      $this->assertSame( '1942-03-21 00:00:00', $this->dt2->getDate()->format( 'Y-m-d H:i:s' ), 'getDate 2' );

   }

   public function testGetMonthName()
   {

      $this->assertSame( 'Juni', $this->dt->getMonthName(), 'getMonthName 1' );
      $this->assertSame( 'März', $this->dt2->getMonthName(), 'getMonthName 2' );

   }

   public function testGetShortMonthName()
   {

      $this->assertSame( 'Jun.', $this->dt->getShortMonthName(), 'getShortMonthName 1' );
      $this->assertSame( 'Mär.', $this->dt2->getShortMonthName(), 'getShortMonthName 2' );

   }

   public function testGetWeekDayName()
   {

      $this->assertSame( 'Freitag', $this->dt->getWeekDayName(), 'getWeekDayName 1' );

   }

   public function testGetShortWeekDayName()
   {

      $this->assertSame( 'Fr', $this->dt->getShortWeekDayName(), 'getShortWeekDayName 1' );

   }

   public function testGetWeekOfMonth()
   {

      $this->assertSame( 4, $this->dt->getWeekOfMonth(), 'getWeekOfMonth 1' );
      $this->assertSame( 3, $this->dt2->getWeekOfMonth(), 'getWeekOfMonth 2' );

   }

   public function testGetAge()
   {

      $this->assertTrue( $this->dt->getAge() === 0, 'getAge 1' );
      $this->assertSame( 74, $this->dt2->getAge(), 'getAge 2' );

   }

   /**
    * @covers \Beluga\Date\DateTime::__get
    */
   public function testDynamicProperties()
   {

      $this->assertSame( 24, $this->dt->day, 'day' );
      $this->assertSame( 4,  $this->dt->weekOfMonth, 'weekOfMonth' );
      $this->assertSame( 74, $this->dt2->age, 'age' );
      $this->assertSame( false, $this->dt2->foo, 'foo' );

   }

   public function testSetTimeParts()
   {

      $this->dt->setTimeParts( 1, 2, 3 );
      $this->assertSame( 1, $this->dt->hour, 'setTimeParts 1' );
      $this->assertSame( 2, $this->dt->minute, 'setTimeParts 2' );
      $this->assertSame( 3, $this->dt->second, 'setTimeParts 3' );

      // 12:05:44 => 05:05:44
      $this->dt2->setTimeParts( 5 );
      $this->assertSame( 5, $this->dt2->hour, 'setTimeParts 4' );
      $this->assertSame( 5, $this->dt2->minute, 'setTimeParts 5' );
      $this->assertSame( 44, $this->dt2->second, 'setTimeParts 6' );


      // 12:24:32 => 12:24:06
      $this->dt3->setTimeParts( null, null, 6 );
      $this->assertSame( 12, $this->dt3->hour, 'setTimeParts 4' );
      $this->assertSame( 24, $this->dt3->minute, 'setTimeParts 5' );
      $this->assertSame( 6, $this->dt3->second, 'setTimeParts 6' );

      // 12:24:32 => 12:24:06
      $this->dt3->setTimeParts( [ 9, 14, 4 ] );
      $this->assertSame( 9, $this->dt3->hour, 'setTimeParts 7' );
      $this->assertSame( 14, $this->dt3->minute, 'setTimeParts 8' );
      $this->assertSame( 4, $this->dt3->second, 'setTimeParts 9' );

      // 12:24:32 => 12:24:06
      $this->dt3->setTimeParts( [ 'hour' => 14, 'minute' => 1, 'second' => 33 ] );
      $this->assertSame( 14, $this->dt3->hour, 'setTimeParts 10' );
      $this->assertSame( 1, $this->dt3->minute, 'setTimeParts 11' );
      $this->assertSame( 33, $this->dt3->second, 'setTimeParts 12' );


      $this->assertTrue( $this->dt->getAge() === 0, 'getAge 1' );
      $this->assertSame( 74, $this->dt2->getAge(), 'getAge 2' );

   }

   public function testChangeTime()
   {

      $this->dt->changeTime( new Time( 14, 22, 11 ) );
      $this->assertSame( 14, $this->dt->hour, 'changeTime 1' );
      $this->assertSame( 22, $this->dt->minute, 'changeTime 2' );
      $this->assertSame( 11, $this->dt->second, 'changeTime 3' );

   }

   public function testSetDateParts()
   {

      $this->dt->setDateParts( 1, 2, 3 );
      $this->assertSame( 1, $this->dt->year, 'setDateParts 1' );
      $this->assertSame( 2, $this->dt->month, 'setDateParts 2' );
      $this->assertSame( 3, $this->dt->day, 'setDateParts 3' );

      // 1942-03-21 => 5-03-21
      $this->dt2->setDateParts( 5 );
      $this->assertSame( 5, $this->dt2->year, 'setDateParts 4' );
      $this->assertSame( 3, $this->dt2->month, 'setDateParts 5' );
      $this->assertSame( 21, $this->dt2->day, 'setDateParts 6' );


      // 2016-03-20 => 2016-03-06
      $this->dt3->setDateParts( null, null, 6 );
      $this->assertSame( 2016, $this->dt3->year, 'setDateParts 7' );
      $this->assertSame( 3, $this->dt3->month, 'setDateParts 8' );
      $this->assertSame( 6, $this->dt3->day, 'setDateParts 9' );

   }

   public function testSetISODate()
   {

      $this->dt->setISODate( 2016, 5, 3 );
      $this->assertSame( 2016, $this->dt->year, 'setISODate 1' );
      $this->assertSame( 2, $this->dt->month, 'setISODate 2' );
      $this->assertSame( 3, $this->dt->day, 'setISODate 3' );

   }

   public function testSetYear()
   {

      $this->assertSame( DateTime::CurrentYear(), $this->dt2->setYear()->year, 'setYear 1' );
      $this->assertSame( 2, $this->dt->setYear( 2 )->year, 'setYear 2' );

   }

   public function testSetMonth()
   {

      $this->assertSame( DateTime::CurrentMonth(), $this->dt2->setMonth()->month, 'setMonth 1' );
      $this->assertSame( 11, $this->dt->setMonth( 11 )->month, 'setMonth 2' );

   }

   public function testSetDay()
   {

      $this->assertSame( DateTime::CurrentDay(), $this->dt2->setDay()->day, 'setDay 1' );
      $this->assertSame( 29, $this->dt->setDay( 29 )->day, 'setDay 2' );

   }

   public function testSetHour()
   {

      $this->assertSame( DateTime::CurrentHour(), $this->dt2->setHour()->hour, 'setHour 1' );
      $this->assertSame( 23, $this->dt->setHour( 23 )->hour, 'setHour 2' );

   }

   public function testSetMinute()
   {

      $this->assertSame( DateTime::CurrentMinute(), $this->dt2->setMinute()->minute, 'setMinute 1' );
      $this->assertSame( 57, $this->dt->setMinute( 57 )->minute, 'setMinute 2' );

   }

   public function testSetSecond()
   {

      $this->assertSame( DateTime::CurrentSecond(), $this->dt->setSecond()->second, 'setSecond 1' );
      $this->assertSame( 17, $this->dt->setSecond( 17 )->second, 'setSecond 2' );

   }

   public function testSetTimestamp()
   {

      $this->assertSame(
         $this->dt2->getTimestamp(),
         $this->dt->setTimestamp( $this->dt2->getTimestamp() )->getTimestamp(),
         'setTimestamp 1' );

   }

   public function testSetTimezone()
   {

      $this->assertSame(
         'Africa/Kinshasa',
         $this->dt->setTimezone( new DateTimeZone( 'Africa/Kinshasa' ) )->getTimezoneName(),
         'setTimezone 1' );

   }

   public function testAddSeconds()
   {

      // 2016-06-24 13:15:00
      // 1942-03-21 12:05:44
      // 2016-03-20 12:24:32
      $this->setUp();

      $this->assertSame( 1, $this->dt->addSeconds()->second, 'addSeconds 1' );
      $this->assertSame( 2, $this->dt->moveSeconds( 1 )->second, 'addSeconds 2' );
      $this->assertSame( 0, $this->dt->addSeconds( 58 )->second, 'addSeconds 3' );

   }

   public function testAddMinutes()
   {

      // 2016-06-24 13:15:00
      // 1942-03-21 12:05:44
      // 2016-03-20 12:24:32
      $this->dt = DateTime::Parse( '2016-06-24 13:15:00', new \DateTimeZone( 'Europe/Berlin' ) );

      $this->assertSame( 16, $this->dt->addMinutes()->minute, 'addMinutes 1' );
      $this->assertSame( 17, $this->dt->moveMinutes( 1 )->minute, 'addMinutes 2' );
      $this->assertSame( 15, $this->dt->addMinutes( 58 )->minute, 'addMinutes 3' );
      $this->assertSame( 14, $this->dt->hour, 'addMinutes 4' );

   }

   public function testAddHours()
   {

      // 2016-06-24 13:15:00
      // 1942-03-21 12:05:44
      // 2016-03-20 12:24:32
      $this->dt = DateTime::Parse( '2016-06-24 13:15:00', new \DateTimeZone( 'Europe/Berlin' ) );

      $this->assertSame( 14, $this->dt->addHours()->hour, 'addHours 1' );
      $this->assertSame( 15, $this->dt->addHours( 1 )->hour, 'addHours 2' );
      $this->assertSame( 13, $this->dt->addHours( 22 )->hour, 'addHours 3' );
      $this->assertSame( 25, $this->dt->day, 'addHours 4' );

   }

   public function testAddDays()
   {

      // 2016-06-24 13:15:00
      // 1942-03-21 12:05:44
      // 2016-03-20 12:24:32
      $this->dt = DateTime::Parse( '2016-06-24 13:15:00', new \DateTimeZone( 'Europe/Berlin' ) );

      $this->assertSame( 25, $this->dt->addDays()->day, 'addDays 1' );
      $this->assertSame( 26, $this->dt->addDays( 1 )->day, 'addDays 2' );
      $this->assertSame( 1, $this->dt->addDays( 5 )->day, 'addDays 3' );
      $this->assertSame( 7, $this->dt->month, 'addDays 4' );

   }

   public function testAddWeeks()
   {

      // 2016-06-24 13:15:00
      // 1942-03-21 12:05:44
      // 2016-03-20 12:24:32
      $this->dt = DateTime::Parse( '2016-06-24 13:15:00', new \DateTimeZone( 'Europe/Berlin' ) );

      $this->assertSame( 1, $this->dt->addWeeks()->day, 'addWeeks 1' );
      $this->assertSame( 7, $this->dt->month, 'addWeeks 2' );
      $this->assertSame( 22, $this->dt->addWeeks( 3 )->day, 'addWeeks 3' );
      $this->assertSame( 7, $this->dt->month, 'addWeeks 4' );

   }

   public function testMoveToEndOfDay()
   {

      // 2016-06-24 13:15:00
      // 1942-03-21 12:05:44
      // 2016-03-20 12:24:32
      $this->dt = DateTime::Parse( '2016-06-24 13:15:00', new \DateTimeZone( 'Europe/Berlin' ) );

      $this->assertSame( 23, $this->dt->moveToEndOfDay()->hour, 'moveToEndOfDay 1' );
      $this->assertSame( 59, $this->dt->minute, 'moveToEndOfDay 2' );
      $this->assertSame( 59, $this->dt->second, 'moveToEndOfDay 3' );

   }

   public function testFormatSqlDateTime()
   {

      $this->setUp();

      $this->assertSame( '2016-06-24 13:15:00', $this->dt->formatSqlDateTime(), 'formatSqlDateTime 1' );
      $this->assertSame( '1942-03-21 12:05:44', $this->dt2->formatSqlDateTime(), 'formatSqlDateTime 2' );
      $this->assertSame( '2016-03-20 12:24:32', $this->dt3->formatSqlDateTime(), 'formatSqlDateTime 3' );

   }

   public function testFormatSqlDate()
   {

      $this->assertSame( '2016-06-24', $this->dt->formatSqlDate(), 'formatSqlDateTime 1' );
      $this->assertSame( '1942-03-21', $this->dt2->formatSqlDate(), 'formatSqlDateTime 2' );
      $this->assertSame( '2016-03-20', $this->dt3->formatSqlDate(), 'formatSqlDateTime 3' );

   }

   public function testFormatNamedDate()
   {

      $this->assertSame( 'Freitag, 24. Juni 2016', $this->dt->formatNamedDate(), 'formatNamedDate 1' );
      $this->assertSame( 'Fr., 24. Jun. 2016', $this->dt->formatNamedDate( true ), 'formatNamedDate 2' );

   }

   public function testFormatNamedDateTime()
   {

      $this->assertSame( 'Freitag, 24. Juni 2016 13:15:00', $this->dt->formatNamedDateTime(), 'formatNamedDateTime 1' );
      $this->assertSame( 'Fr., 24. Jun. 2016 13:15', $this->dt->formatNamedDateTime( true ), 'formatNamedDateTime 2' );

   }

   public function testFormat()
   {

      // 2016-06-24 13:15:00
      // 1942-03-21 12:05:44
      // 2016-03-20 12:24:32
      $this->dt = DateTime::Parse( '2016-06-24 13:15:00', new \DateTimeZone( 'Europe/Berlin' ) );

      $this->assertSame(
         '2016-06-24T13:15:00+02:00',
         $this->dt->format( \Beluga\Date\DateTimeFormat::ATOM ),
         'format 1'
      );

      $this->assertSame(
         'Friday, 24-Jun-2016 13:15:00 CEST',
         $this->dt->format( \Beluga\Date\DateTimeFormat::COOKIE ),
         'format 2'
      );

      $this->assertSame(
         '2016-06-24',
         $this->dt->format( \Beluga\Date\DateTimeFormat::DATE ),
         'format 3'
      );

      $this->assertSame(
         '2016-06-24T13:15:00+0200',
         $this->dt->format( \Beluga\Date\DateTimeFormat::ISO8601 ),
         'format 4'
      );

      $this->assertSame(
         'Fri, 24 Jun 16 13:15:00 +0200',
         $this->dt->format( \Beluga\Date\DateTimeFormat::RFC822 ),
         'format 5'
      );

      $this->assertSame(
         'Friday, 24-Jun-16 13:15:00 CEST',
         $this->dt->format( \Beluga\Date\DateTimeFormat::RFC850 ),
         'format 6'
      );

      $this->assertSame(
         'Fri, 24 Jun 16 13:15:00 +0200',
         $this->dt->format( \Beluga\Date\DateTimeFormat::RFC1036 ),
         'format 7'
      );

      $this->assertSame(
         'Fri, 24 Jun 2016 13:15:00 +0200',
         $this->dt->format( \Beluga\Date\DateTimeFormat::RFC2822 ),
         'format 8'
      );

      $this->assertSame(
         '2016-06-24T13:15:00+02:00',
         $this->dt->format( \Beluga\Date\DateTimeFormat::RFC3339 ),
         'format 9'
      );

      $this->assertSame(
         '2016-06-24 13:15:00',
         $this->dt->format( \Beluga\Date\DateTimeFormat::SQL ),
         'format 10'
      );

      $this->assertSame(
         '2016-06-24',
         $this->dt->format( \Beluga\Date\DateTimeFormat::SQL_DATE ),
         'format 11'
      );

      $this->assertSame(
         '13:15:00',
         $this->dt->format( \Beluga\Date\DateTimeFormat::SQL_TIME ),
         'format 12'
      );

      $this->assertSame(
         '2016-06-24 13:15:00 CEST',
         $this->dt->format( \Beluga\Date\DateTimeFormat::SQL_TZ ),
         'format 13'
      );

      $this->assertSame(
         'Fri, 24 Jun 2016 13:15:00 +0200',
         $this->dt->format( \Beluga\Date\DateTimeFormat::RSS ),
         'format 14'
      );

      $this->assertSame(
         '2016-06-24T13:15:00+02:00',
         $this->dt->format( \Beluga\Date\DateTimeFormat::W3C ),
         'format 15'
      );

      $this->assertSame(
         '13:15:00',
         $this->dt->format( \Beluga\Date\DateTimeFormat::TIME ),
         'format 16'
      );

   }

   public function testToString()
   {

      // D, d M y H:i:s O
      // 2016-06-24 13:15:00
      // 1942-03-21 12:05:44
      // 2016-03-20 12:24:32

      $this->assertSame(
         ( new \DateTime( '2016-06-24 13:15:00', $this->dt->getTimezone() ) )->format( DateTime::RFC822 ),
         (string) $this->dt,
         '__toString 1' );

      $this->assertSame(
         ( new \DateTime( '1942-03-21 12:05:44', $this->dt2->getTimezone() ) )->format( DateTime::RFC822 ),
         (string) $this->dt2,
         '__toString 2' );

      $this->assertSame(
         ( new \DateTime( '2016-03-20 12:24:32', $this->dt3->getTimezone() ) )->format( DateTime::RFC822 ),
         (string) $this->dt3,
         '__toString 3' );

   }

   public function testIsset()
   {

      $this->assertTrue(
         isset( $this->dt->year ),
         'isset 1' );

      $this->assertFalse(
         isset( $this->dt->foo ),
         'isset 2' );

   }

   public function testEquals()
   {

      $this->assertTrue(
         $this->dt->equals( '2016-06-24 13:15:00' ),
         'equals 1' );
      $this->assertFalse(
         $this->dt->equals( '2016-06-24 13:15:00', true ),
         'equals 2' );
      $this->assertTrue(
         $this->dt->equals( new \DateTime( '2016-06-24 13:15:00', new \DateTimeZone( 'Europe/Berlin' ) ) ),
         'equals 3' );

   }

   public function testCompare()
   {

      $this->assertSame(
         1,
         $this->dt->compare( $this->dt2 ),
         'compare 1' );
      $this->assertSame(
         -1,
         $this->dt2->compare( '2016-06-24 13:15:00' ),
         'compare 2' );
      $this->assertSame(
         0,
         $this->dt2->compare( $this->dt2 ),
         'compare 3' );
      $this->assertFalse(
         $this->dt2->compare( 'unknown date time format' ),
         'compare 4' );

   }

   public function testFromDateTime()
   {

      $this->dt = DateTime::FromDateTime( new \DateTime( '2016-06-24 13:15:00' ) );
      $this->assertSame( 2016, $this->dt->year, 'FromDateTime 1' );
      $this->assertSame( 6, $this->dt->month, 'FromDateTime 2' );
      $this->assertSame( 24, $this->dt->day, 'FromDateTime 3' );
      $this->assertSame( 13, $this->dt->hour, 'FromDateTime 4' );
      $this->assertSame( 15, $this->dt->minute, 'FromDateTime 5' );
      $this->assertSame( 0, $this->dt->second, 'FromDateTime 6' );
      $this->dt2 = DateTime::FromDateTime( new \DateTime( '1942-03-21 12:05:44' ) );
      $this->assertSame( 1942, $this->dt2->year, 'FromDateTime 7' );
      $this->assertSame( 3, $this->dt2->month, 'FromDateTime 8' );
      $this->assertSame( 21, $this->dt2->day, 'FromDateTime 9' );
      $this->assertSame( 12, $this->dt2->hour, 'FromDateTime 10' );
      $this->assertSame( 5, $this->dt2->minute, 'FromDateTime 11' );
      $this->assertSame( 44, $this->dt2->second, 'FromDateTime 12' );

   }

   public function testFromTimestamp()
   {

      $this->dt = DateTime::FromTimestamp( $this->dt->getTimestamp(), $this->dt->getTimezone() );
      $this->assertSame( 2016, $this->dt->year, 'FromTimestamp 1' );
      $this->assertSame( 6, $this->dt->month, 'FromTimestamp 2' );
      $this->assertSame( 24, $this->dt->day, 'FromTimestamp 3' );
      $this->assertSame( 13, $this->dt->hour, 'FromTimestamp 4' );
      $this->assertSame( 15, $this->dt->minute, 'FromTimestamp 5' );
      $this->assertSame( 0, $this->dt->second, 'FromTimestamp 6' );

   }

   public function testFromFormat()
   {

      # 1942-03-21 12:05:44
      $this->dt = DateTime::FromFormat( 'Y:d:m __ H-i-s', $this->dt2->format( 'Y:d:m __ H-i-s' ), $this->dt->getTimezone() );
      $this->assertSame( 1942, $this->dt->year, 'FromFormat 1' );
      $this->assertSame( 3, $this->dt->month, 'FromFormat 2' );
      $this->assertSame( 21, $this->dt->day, 'FromFormat 3' );
      $this->assertSame( 12, $this->dt->hour, 'FromFormat 4' );
      $this->assertSame( 5, $this->dt->minute, 'FromFormat 5' );
      $this->assertSame( 44, $this->dt->second, 'FromFormat 6' );

   }

   public function testOther()
   {

      $this->assertTrue(
         DateTime::CurrentSecond() > -1,
         'CurrentSecond 1' );

      $this->assertTrue(
         DateTime::CurrentMicroSecond() > -1,
         'CurrentMicroSecond 1' );

      $this->assertTrue(
         ! is_null( DateTime::FromFile( __FILE__ ) ),
         'FromFile 1' );

      $this->assertSame(
         29,
         DateTime::GetDaysInMonth( 2016, 2 ),
         'GetDaysInMonth 1' );
      $this->assertSame(
         28,
         DateTime::GetDaysInMonth( 2015, 2 ),
         'GetDaysInMonth 1' );

      $this->assertTrue(
         DateTime::MaxValue() instanceof \Beluga\Date\DateTime,
         'MaxValue 1' );
      $this->assertTrue(
         DateTime::MinValue() instanceof \Beluga\Date\DateTime,
         'MinValue 1' );

      $this->assertFalse(
         DateTime::Parse( null ),
         'Parse 1' );

      $this->assertTrue(
         DateTime::Parse( new DateTime() ) instanceof \Beluga\Date\DateTime,
         'Parse 2' );

      $this->assertTrue(
         DateTime::Parse( new \DateTime() ) instanceof \Beluga\Date\DateTime,
         'Parse 3' );

      $this->assertFalse(
         DateTime::Parse( array() ),
         'Parse 4' );

      $this->assertTrue(
         DateTime::Parse( new Time() ) instanceof \Beluga\Date\DateTime,
         'Parse 5' );

      $cls = new stdClass();
      $cls->foo = 1;
      $cls->bar = 'BAR';

      $this->assertFalse(
         DateTime::Parse( $cls ) instanceof \Beluga\Date\DateTime,
         'Parse 6' );

   }


}
