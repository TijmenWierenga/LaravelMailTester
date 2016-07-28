# LaravelMailTester

An extension to Laravel's TestCase which allows you to run unit tests on emails.

# Installation

``` bash
composer require tijmen-wierenga/laravel-mail-tester
```

Next, add the trait to the `TestCase` class located at `tests/TestCase`:

``` php
use TijmenWierenga\LaravelMailTester\TestsEmail;

class TestCase extends Laravel\Lumen\Testing\TestCase
{

    use TestsEmail;
    
    ...
    
}
```

# How it works

LaravelMailTester adds an event listener as a plugin when in a testing environment. It tracks when an email is sent, and stores all data in the test case. You can then perform assertions against it.

# Usage

``` php
class AuthenticationTest extends TestCase
{
  /**
  * @test
  */
  public function it_sends_an_email() {
    // Send an email
    Mail::raw('Wow, awesome email testing!', function($mail) {
      $mail->to('tijmen@floown.com');
      $mail->from('no-reply@floown.com');
      $mail->subject('Read this awesome email');
    }
    
    $this->assertEmailWasSent()
      ->assertEmailWasSentTo('tijmen@floown.com)
      ->assertEmailWasSentFrom('no-reply@floown.com')
      ->assertEmailBodyContains('awesome email testing')
  }
}
```

More assertions to come.

# License

The MIT License (MIT).
