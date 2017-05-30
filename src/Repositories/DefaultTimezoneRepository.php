<?php
namespace Laravolt\Epicentrum\Repositories;

use DateTime;
use DateTimeZone;

class DefaultTimezoneRepository implements TimezoneRepository
{

    public function lists()
    {
        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        $offsets = array();
        foreach ($timezones as $timezone) {
            $tz = new DateTimeZone($timezone);
            $offsets[$timezone] = $tz->getOffset(new DateTime);
        }

        // sort timezone by offset
        asort($offsets);

        $lists = array();
        foreach ($offsets as $timezone => $offset) {
            $offset_prefix = $offset < 0 ? '-' : '+';
            $offset_formatted = gmdate('H:i', abs($offset));

            $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

            $lists[$timezone] = "(${pretty_offset}) $timezone";
        }

        return $lists;
    }
}
