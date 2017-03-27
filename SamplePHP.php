<?php

/**
 * @author Daniel Seitz <mail@daniel-seitz.com>
 * 
 * Sample PHP Code
 * Everything in one file
 * Obtains the Top 500 ranked players including Name, Rating, Rank and Ranked Games Won
 * API: a.scrollsguide.com
 *
 * The output from the API is in JSON format
 */

// we sleep for 1 second after each statistics request: 500 seconds (+ overhead)
ini_set('max_execution_time', 1000);

/**
 * Log
 * Helper to inform that the code is still doing something
 * Since we have a rate limit and there are no batch calls we just circumvent and sleep for a bit
 * the code will run for 50 minutes so inspecting the log we can see where we are at
 */
abstract class Log 
{
    /**
     * Appends a given message into a text file
     * 
     * @return void
     */
    public static function info($message) 
    {
        file_put_contents('log.txt', $message . PHP_EOL, FILE_APPEND);
    }
}

/**
 * ScrollsApi
 * Interacts with the Scrolls Guide Api
 */
abstract class ScrollsApi
{
    /** 
     * Base url for api calls
     * 
     * @var string 
     */
    private static $url = 'http://a.scrollsguide.com/';


    /**
     * Gets ranked players in 500 batches
     * Adjust $i in the forloop if more than 500 should be requested
     * 
     * @return array
     */
    public static function getRankedPlayers() 
    {
        $rankedPlayers = [];

        for($i = 0; $i < 1; $i++) {
            $endpoint = 'ranking?limit=500&start=' . $i * 500;

            $rankedPlayers = array_merge($rankedPlayers, self::callApi($endpoint));
        }

        return $rankedPlayers;
    }


    /**
     * Gets Statistics for the given ranked players
     * 
     * @param array $rankedPlayers
     * @return array
     */
    public static function getStatisticsForAll($rankedPlayers) 
    {
        $statistics = [];

        foreach($rankedPlayers as $player) {
            Log::info('Player: '. $player->name);

            $statistics[] = self::getStatisticsFor($player);
        }

        return $statistics;
    }


    /**
     * Gets Statistics for the one given player
     * 
     * @param object $player
     * @return object
     */
    public static function getStatisticsFor($player) 
    {
        $endpoint = 'player?fields=all&&fields=name,rating,rank,rankedwon&name=' . $player->name;

        return self::callApi($endpoint);
    }


    /**
     * Calls the specified endpoint
     * 
     * @param string $endpoint
     * @throws Exception When Api call has an result with an 'exception'
     * @return object
     */
    private static function callApi($endpoint) 
    {
        $ch = curl_init(self::$url . $endpoint);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $result = json_decode(curl_exec($ch));
        
        curl_close ($ch);

        if($result->msg == 'exception') throw new Exception($result->exception);

        sleep(1); // prevent rate limit

        return $result->data;
    }
}


// execute the code
try {
    // Get ranked players
    $rankedPlayers = ScrollsApi::getRankedPlayers();

    // get statistics for the ranked players
    $statistics = ScrollsApi::getStatisticsForAll($rankedPlayers);

    // save result
    file_put_contents('ranked_player_statistics.json', json_encode($statistics));

// in case of an exception
} catch(Exception $e) {
    echo 'Sorry, there was an error, find out more:';
    echo $e;
    exit;
}

echo 'i am finished, thank you.';
