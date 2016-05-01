<?php

namespace ChrisWhite\XkcdSlack\Search\Sources;

interface SourceInterface
{
    public function search($terms);
}