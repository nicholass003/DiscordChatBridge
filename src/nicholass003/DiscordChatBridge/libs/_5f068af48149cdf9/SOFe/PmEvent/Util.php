<?php

declare(strict_types=1);

namespace nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\PmEvent;

use Closure;
use nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\AwaitGenerator\Await;
use nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\AwaitGenerator\Channel;
use nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\AwaitGenerator\Traverser;

final class Util {
	/**
	 * @template T
	 * @param Channel<T>[] $channels
	 * @param ?Closure(): void $finalize
	 * @return Traverser<T>
	 */
	public static function traverseChannels(array $channels, ?Closure $finalize = null) : Traverser {
		return Traverser::fromClosure(function() use ($channels, $finalize) {
			try {
				while (true) {
					[, $value] = yield from Await::safeRace(array_map(fn(Channel $channel) => $channel->receive(), $channels));
					yield $value => Traverser::VALUE;
				}
			} finally {
				if($finalize !== null) {
					$finalize();
				}
			}
		});
	}
}