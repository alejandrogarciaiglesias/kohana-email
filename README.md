# Email Module For Kohana 3.x (with queue support!)

Factory-based email class. This class is a simple wrapper around [Swiftmailer](http://github.com/swiftmailer/swiftmailer).
This fork adds a queue system inspired by [Emailq](https://github.com/ivansf/Emailq).

## Usage

Create new messages using the `Email::factory($subject, $message)` method. Add recipients, add sender, send message:

    $email = Email::factory('Hello, World', 'This is my body, it is nice.')
        ->to('person@example.com')
        ->from('you@example.com', 'My Name')
        ->send();

You can also add HTML to your message:

    $email->message('<p>This is <em>my</em> body, it is <strong>nice</strong>.</p>', 'text/html');

Additional recipients can be added using the `to()`, `cc()`, and `bcc()` methods.

Additional senders can be added using the `from()` and `reply_to()` methods. If multiple sender addresses are specified, you need to set the actual sender of the message using the `sender()` method. Set the bounce recipient by using the `return_path()` method.

To access and modify the [Swiftmailer message](http://swiftmailer.org/docs/messages) directly, use the `raw_message()` method.

### Queue

To enqueue an email, use queue() instead of send():

    $email = Email::factory('Hello, World', 'This is my body, it is nice.')
        ->to('person@example.com')
        ->from('you@example.com', 'My Name')
        ->queue();

Then send all the emails in the queue, call the static method send_queued():

    $emails_sent = Email::send_queued();

It returns the emails it could actually send.

You can also label your emails...

    $email = Email::factory('Hello, World', 'This is my body, it is nice.')
        ->to('person@example.com')
        ->from('you@example.com', 'My Name')
        ->queue('mylabel');

...and then send all the emails from that single label:

    $emails_sent = Email::send_queued('mylabel');

...or just 25 emails from that single label:

    $emails_sent = Email::send_queued('mylabel');

## Configuration

Configuration is stored in `config/email.php`. Options are dependant upon transport method used. Consult the Swiftmailer documentation for options available to each transport.
