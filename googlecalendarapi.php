<?php

/**
 *  Base code provided by Sarah Bailey.
 *  Case Western Reserve University, Cleveland OH.
 *
 *  Refactored by Cristian Sorescu christian139601@gmail.com
 *  Dynamic code, introduced get_upcoming_events function.
 */

// TO DEBUG UNCOMMENT THESE LINES
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

// GOOGLE API PHP CLIENT LIBRARY
// https://github.com/google/google-api-php-client
include(__DIR__.'/vendor/autoload.php');

/**
 * get_upcoming_events gets upcoing events from a google calendar by id.
 *
 * @param $_G_API GOOGLE PUBLIC API key (server),
 *        from DEVELOPERS.GOOGLE.COM for API.
 * @param $_calendarId The calendar id, found in calendar settings.
 *        If your calendar is through google apps
 *        you may need to change the central sharing settings.
 *        The calendar for this script must have all events viewable in
 *        sharing settings.
 * @param $_max_events maximum number of events to be requested, default (4).
 * @return html formatted event(s).
 */
function get_upcoming_events($_G_API, $_calendarId, $_max_events = 4) {
    // used in Greece, thus the timezone and locale
    date_default_timezone_set('Europe/Athens');
    setlocale(LC_TIME, 'el_GR.UTF-8');

    $result = '';

    // New Google client
    $client = new Google_Client();
    $client->setApplicationName("Calendar of Upcoming Events");
    $client->setDeveloperKey($_G_API);
    $cal = new Google_Service_Calendar($client);

    /*
       tell google how we want the events
       can't use time min without single events turned on,
       it says to treat recurring events as single events.
    */
    $params = array(
        'singleEvents' => true,
        'orderBy' => 'startTime',
        'timeMin' => date(DateTime::ATOM),
        'maxResults' => $_max_events
    );

    // save returned results
    $events = $cal->events->listEvents($_calendarId, $params);
    $calTimeZone = $events->timeZone;

    // iterate over the events
    foreach ($events->getItems() as $event) {
        $result .= '<div class="event-container">';

        // Store event's date as string 
        $eventDateStr = $event->start->dateTime;
        if(empty($eventDateStr)) {
            // it's an all day event
            $eventDateStr = $event->start->date;
        }

        $temp_timezone = $event->start->timeZone;

        if (!empty($temp_timezone)) {
            $timezone = new DateTimeZone($temp_timezone);
        } else {
            // Set your default timezone in case your events don't have one
            $timezone = new DateTimeZone($calTimeZone);
        }

        $link = $event->htmlLink;

        // add tz to event link
        // prevents google from displaying everything in gmt
        $TZlink = $link . "&ctz=" . $calTimeZone;

        // https://www.php.net/manual/en/function.strftime.php
        $month_name = strftime("%b", strtotime($eventDateStr));
        $day_num = strftime("%e", strtotime($eventDateStr));

        // format html output
        $result .= '<div class="eventDate">';
        $result .= '<span class="month">'.$month_name.'</span><br>';
        $result .= '<span class="day"><a href="'.$TZlink.'" target="_blank">'.$day_num.'</a></span>';
        $result .= '<span class="dayTrail"></span></div>';
        $result .= '<div class="eventBody">';
        $result .= '<p><a href="'.$TZlink.'" target="_blank">'.$event->summary.'</a></p>';
        $result .= '</div></div>';
    }

    return $result;
}

// Usage:
//$foo = get_upcoming_events("GOOGLE_API", "CALENDAR_ID", NUM_OF_EVENTS);
//echo $foo;

?>
