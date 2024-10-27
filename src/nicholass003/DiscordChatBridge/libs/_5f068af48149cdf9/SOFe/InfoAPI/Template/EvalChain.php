<?php

declare(strict_types=1);

namespace nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\InfoAPI\Template;

use Closure;
use pocketmine\command\CommandSender;
use RuntimeException;
use Shared\SOFe\InfoAPI\Mapping;
use Shared\SOFe\InfoAPI\Parameter;
use nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\AwaitGenerator\Traverser;
use nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\InfoAPI\Ast;
use nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\InfoAPI\Ast\MappingCall;
use nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\InfoAPI\Pathfind;
use nicholass003\DiscordChatBridge\libs\_5f068af48149cdf9\SOFe\InfoAPI\ReadIndices;

use function array_keys;
use function array_map;
use function count;
use function implode;
use function json_decode;
use function range;
use function sprintf;


































































































































































































































































/**
 * @template R of RenderedElement
 */
interface EvalChain extends NestedEvalChain {
	/**
	 * Returns a RenderedElement that performs the steps executed in this chain so far.
	 *
	 * @return R
	 */
	public function getResultAsElement() : RenderedElement;
}