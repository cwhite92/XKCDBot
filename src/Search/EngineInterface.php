<?php

namespace ChrisWhite\XkcdSlack\Search;

interface EngineInterface
{
    public function search($terms);
}