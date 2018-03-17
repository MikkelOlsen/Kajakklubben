<?php
    class Search extends Database
    {
        public static function SearchResults(string $SEARCH) : array
        {
            $searchArray['news'] = (new self)->query("SELECT * FROM `news` WHERE newsTitle LIKE CONCAT('%', :SEARCH, '%') OR newsContent LIKE CONCAT('%', :SEARCH, '%')", [':SEARCH' => $SEARCH])->fetchAll();
            $searchArray['events'] = (new self)->query("SELECT `eventsId`, `eventTitle`, `eventDescription`, `eventStartDate`, filename, filepath, mime FROM `events`
                                                        INNER JOIN media
                                                        ON events.eventCover = media.mediaId WHERE eventTitle LIKe CONCAT('%', :SEARCH, '%') OR eventDescription LIKE CONCAT('%', :SEARCH, '%')", [':SEARCH' => $SEARCH])->fetchAll();
            return $searchArray;
        }
    }
    
?>