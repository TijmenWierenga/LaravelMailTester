<?php
namespace TijmenWierenga\LaravelMailTester;

use Swift_Message;

trait TestsEmail
{
    /**
     * @var array
     */
    protected $emails = [];

    /**
     * @before
     */
    public function setMailPlugin()
    {
        app()->mailer
            ->getSwiftMailer()
            ->registerPlugin(new TestCaseMailEventListener($this));
    }

    /**
     * @param Swift_Message $email
     */
    public function addEmail(Swift_Message $email)
    {
        $this->emails[] = $email;

        return $this;
    }

    /**
     * Checks if an email was sent.
     *
     * @return bool
     */
    public function assertEmailWasSent()
    {
        $this->assertTrue(
            ! empty($this->emails),
            'Asserting that an email was sent while no email was sent.'
        );

        return $this;
    }

    /**
     * Checks if no emails were sent.
     *
     * @return mixed
     */
    public function assertNoEmailWasSent()
    {
        $this->assertTrue(
            empty($this->emails),
            'Asserting that no email was sent, while ' . count($this->emails) . ' email(s) was/were sent.'
        );

        return $this;
    }

    /**
     * Checks if email was sent to a specific email address
     *
     * @param $email
     * @return mixed
     */
    public function assertEmailWasSentTo($email)
    {
        $recipient = key($this->emails[0]->getTo());

        $this->assertEquals(
            $recipient, $email,
            'Excepted recipient of email to be "' . $email . '", actual recipient was "' . $recipient . '".'
        );

        return $this;
    }

    /**
     * Checks is email was sent from a specific email address
     *
     * @param $email
     * @return mixed
     */
    public function assertEmailWasSentFrom($email)
    {
        $sender = key($this->emails[0]->getFrom());

        $this->assertEquals(
            $sender, $email,
            'Excepted sender of email to be "' . $email . '", actual sender was "' . $sender . '".'
        );

        return $this;
    }

    /**
     * Checks if email contains a specified string.
     *
     * @param $string
     * @return mixed
     */
    public function assertEmailBodyContains($string)
    {
        $body = $this->emails[0]->getBody();

        $this->assertTrue(
            strpos($body, $string) !== false,
            'Asserted that "' . $string . '" was in the email body, but it was not."'
        );

        return $this;
    }
}
