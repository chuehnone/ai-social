<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

abstract class Test extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Dotenv::createImmutable(dirname(__DIR__))->load();
    }
}
