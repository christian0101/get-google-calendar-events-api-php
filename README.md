# Get Google Calendar Events Api PHP

Api/Function that retrieves upcoming events from a Google calendar by id using Google’s API v3, written in PHP.

Posted [initially](https://spunmonkey.com/display-contents-google-calendar-php/) by Sarah Bailey.

## Usage

```
include ('googlecalendarapi.php');

/**
 * get_upcoming_events gets upcoing events from a google calendar by id.
 *
 * @param "GOOGLE_API" GOOGLE PUBLIC API key (server),
 *        from DEVELOPERS.GOOGLE.COM for API.
 * @param "CALENDAR_ID" The calendar id, found in calendar settings.
 *        If your calendar is through google apps
 *        you may need to change the central sharing settings.
 *        The calendar for this script must have all events viewable in
 *        sharing settings.
 * @param NUM_OF_EVENTS maximum number of events to be requested, default (4).
 */
$upcomingEvents = get_upcoming_events("GOOGLE_API", "CALENDAR_ID", NUM_OF_EVENTS);
```
