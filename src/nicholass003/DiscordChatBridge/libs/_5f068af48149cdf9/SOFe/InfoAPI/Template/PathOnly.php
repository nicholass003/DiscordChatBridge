<?php

declare(strict_types=1);

namespace nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\InfoAPI\Template;

use pocketmine\command\CommandSender;
use Shared\SOFe\InfoAPI\Display;
use nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\AwaitGenerator\Traverser;

use function count;
use function sprintf;



































































































































final class PathOnly implements CoalesceChoice {
	public function __construct(
		public ResolvedPath $path,
	) {
	}

	public function getPath() : ResolvedPath {
		return $this->path;
	}

	public function getDisplay() : ?Display {
		return null;
	}
}