<?php

declare(strict_types=1);

namespace nicholass003\DiscordChatBridge;

use pocketmine\scheduler\Task;

final class DiscordTask extends Task{

	public function __construct(
		protected readonly string $id,
		protected readonly string $auth
	){}

	public function onRun() : void{
		DiscordChatBridge::sendDiscordMessage($this->id, $this->auth);
	}
}
