<?php

namespace Imdb;

use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

class GraphQL
{
    /**
     * @var CacheInterface
     */
    private $cache;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * GraphQL constructor.
     * @param CacheInterface $cache
     * @param LoggerInterface $logger
     */
    public function __construct($cache, $logger)
    {
        $this->cache = $cache;
        $this->logger = $logger;
    }

    public function query($query, $qn = null, $variables = array())
    {
        $key = "gql.$qn." . ($variables ? json_encode($variables) : '') . md5($query) . ".json";
        $fromCache = $this->cache->get($key);

        if ($fromCache != null) {
            return json_decode($fromCache);
        }

        $result = $this->doRequest($query, $qn, $variables);

        $this->cache->set($key, json_encode($result));

        return $result;
    }

    /**
     * @param string $query
     * @param string|null $qn
     * @param array $variables
     * @return \stdClass
     */
    private function doRequest($query, $qn = null, $variables = array())
    {
        $opts = array(
            'http' => array(
                'method' => "POST",
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode([
                    'operationName' => $qn,
                    'query' => $query,
                    'variables' => $variables])
            )
        );
        // @TODO error handling
        // @TODO use request class? Try use config settings for language etc?
        // graphql docs say 'Affected by headers x-imdb-detected-country, x-imdb-user-country, x-imdb-user-language'
        $context = stream_context_create($opts);
        $res = file_get_contents('https://api.graphql.imdb.com/', false, $context);

        return json_decode($res)->data;
    }
}
