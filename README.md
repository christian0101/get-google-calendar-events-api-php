# Get Google Calendar Events Api PHP

This api/function gets upcoming events from a Google calendar by id using Google’s API v3.

Posted [initially](https://spunmonkey.com/display-contents-google-calendar-php/) by Sarah Bailey.

## Usage

```
include ('googlecalendarapi.php');

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
get_upcoming_events("GOOGLE_API", "CALENDAR_ID", NUM_OF_EVENTS);
```
