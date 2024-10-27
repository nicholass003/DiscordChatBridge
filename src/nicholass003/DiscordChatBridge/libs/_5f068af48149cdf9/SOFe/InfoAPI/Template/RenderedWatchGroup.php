<?php

declare(strict_types=1);

namespace nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\InfoAPI\Template;

use Closure;
use Generator;
use RuntimeException;
use nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\AwaitGenerator\Await;
use nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\AwaitGenerator\Traverser;

use function count;
use function implode;
use function is_string;


































































































































final class RenderedWatchGroup implements RenderedGroup {
	/**
	 * @param RenderedWatchElement[] $elements
	 */
	public function __construct(private array $elements) {
	}

	/**
	 * @return Traverser<string>
	 */
	public function watch() : Traverser {
		return Traverser::fromClosure(function() {
			$traversers = [];
			try {
				foreach ($this->elements as $element) {
					$traversers[] = $element->watch();
				}

				/** @var array<int, string> $strings */
				$strings = [];
				while (true) {
					/** @var Generator<mixed, mixed, mixed, bool>[] $racers */
					$racers = [];
					foreach ($traversers as $k => $traverser) {
						if ($traverser !== null) {
							$racers[$k] = $traverser->next($strings[$k]);
						}
					}
					if(count($racers) === 0) {
						// the entire template is static
						break;
					}

					[$k, $running] = yield from Await::safeRace($racers);
					if (!$running) {
						// no more updates in this traverser (currently unreachable, but let's support this case anyway)
						unset($traversers[$k]);
						continue;
					}

					if (count($strings) === count($this->elements)) {
						yield implode("", $strings) => Traverser::VALUE;
					}
				}
			} finally {
				foreach ($traversers as $traverser) {
					yield from $traverser->interrupt();
				}
			}
		});
	}
}