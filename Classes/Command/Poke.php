<?php
// Namespace
namespace Command;

/**
 * Sends the arguments to the channel, like say from a user.
 * arguments[0] == Channel or User to send Poke to.
 * arguments[1] == Poke Victim.
 *
 * @package IRCBot
 * @subpackage Command
 * @author Super3 <admin@wildphp.com>
 */
class Poke extends \Library\IRCCommand {
    /**
     * Sends the arguments to the channel, like say from a user.
     */
    public function command() {
            $this->IRCBot->sendDataToServer( 'PRIVMSG ' . $this->arguments[0] .
            ' :'. chr(1). 'ACTION pokes '.
            $this->arguments[1]. chr(1) );
    }
}
?>