<?php

/*
	WildPHP - a modular and easily extendable IRC bot written in PHP
	Copyright (C) 2015 WildPHP

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace WildPHP;

use WildPHP\EventManager\EventManager;
use WildPHP\IRC\ServerMessage;

class BaseModule
{
	/**
	 * The Bot object. Used to interact with the main thread.
	 * @var Bot
	 */
	protected $bot;

	/**
	 * The module directory.
	 * @var string
	 */
	private $dir;

	/**
	 * Set up the module.
	 * @param Bot $bot The Bot object.
	 */
	public function __construct(Bot $bot)
	{
		$this->bot = $bot;

		$dirname = explode('\\', get_class($this));
		$this->dir = WPHP_MODULE_DIR . '/' . end($dirname) . '/';

		if (method_exists($this, 'setup'))
			$this->setup();
	}

	/**
	 * Return the working directory of this module.
	 * @return string
	 */
	public function getWorkingDir()
	{
		return $this->dir;
	}

	/**
	 * Helper function for using the Event Manager.
	 * @return EventManager
	 */
	public function evman()
	{
		return $this->bot->getEventManager();
	}

	/**
	 * Helper function for using the Timer Manager.
	 * @return TimerManager
	 */
	public function timeman()
	{
		return $this->bot->getTimerManager();
	}

	/**
	 * Waits for and gets a reply from the server.
	 * THIS HALTS THE TIMERS FOR THE SPECIFIED TIME.
	 * @param int $lines The amount of lines to listen for.
	 * @param int $timeout Timeout for listening to data. Defaults to 3 seconds.
	 * @return ServerMessage[]
	 */
	public function waitReply($lines = 1, $timeout = 3)
	{
		return $this->bot->waitReply($lines, $timeout);
	}
}
