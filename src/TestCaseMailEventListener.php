<?php
namespace TijmenWierenga\LaravelMailTester;


use Swift_Events_EventListener;
use TestCase;

class TestCaseMailEventListener implements Swift_Events_EventListener
{
    protected $test;

    /**
     * @param TestCase $test
     */
    public function __construct(TestCase $test)
    {
        $this->test = $test;
    }

    /**
     * @param $event
     */
    public function beforeSendPerformed($event)
    {
        $this->test->addEmail($event->getMessage());
    }
}
