<?php

declare(strict_types=1);

namespace nicholass003\DiscordChatBridge;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\BulkCurlTask;
use pocketmine\scheduler\BulkCurlTaskOperation;
use pocketmine\Server;
use pocketmine\utils\InternetException;
use pocketmine\utils\InternetRequestResult;
use function json_decode;
use function json_encode;
use function str_contains;
use function str_replace;
use const CURLOPT_AUTOREFERER;
use const CURLOPT_FOLLOWLOCATION;
use const CURLOPT_HTTPHEADER;
use const CURLOPT_POST;
use const CURLOPT_POSTFIELDS;

final class DiscordChatBridge extends PluginBase implements Listener{

	private static array $discordData = [];
	private static array $timestamp = [];

	private const WEBHOOK_URL = 'webhook-url';
	private const CHANNEL_ID = 'channel-id';
	private const AUTHORIZATION = 'authorization';
	private const WEBHOOK_NAME = 'webhook-name';

	protected function onEnable() : void{
		self::$discordData = [
			self::WEBHOOK_URL => $this->getConfig()->get(self::WEBHOOK_URL),
			self::CHANNEL_ID => $this->getConfig()->get(self::CHANNEL_ID),
			self::AUTHORIZATION => $this->getConfig()->get(self::AUTHORIZATION),
			self::WEBHOOK_NAME => str_replace(" ", "_", $this->getConfig()->get(self::WEBHOOK_NAME))
		];

		$configured = true;
		foreach(self::$discordData as $key => $data){
			if(!str_contains($data, "here")){
				continue;
			}
			$this->getLogger()->warning("Please configure {$key} in config.yml");
			$configured = false;
		}
		if(!$configured){
			$this->getServer()->getPluginManager()->disablePlugin($this);
		}

		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getScheduler()->scheduleRepeatingTask(new DiscordTask(self::$discordData[self::CHANNEL_ID], self::$discordData[self::AUTHORIZATION]), (int) $this->getConfig()->get("tick", 20));
	}

	public function onPlayerChat(PlayerChatEvent $event) : void{
		$player = $event->getPlayer();
		self::sendLog($player->getName() . " : " . $event->getMessage());
	}

	public static function sendLog(string $message) : void{
		$data = [
			'content' => $message,
		];
		Server::getInstance()->getAsyncPool()->submitTask(new BulkCurlTask(
			[
				new BulkCurlTaskOperation(
					self::$discordData[self::WEBHOOK_URL],
					20,
					[],
					[
						CURLOPT_HTTPHEADER => [
							'Content-Type: application/json'
						],
						CURLOPT_POST => true,
						CURLOPT_POSTFIELDS => json_encode($data),
						CURLOPT_AUTOREFERER => false,
						CURLOPT_FOLLOWLOCATION => false
					]
				)
			], function(array $results) : void{
				$result = $results[0];
				/** @var InternetRequestResult|InternetException $result*/
				if($result instanceof InternetException){
					$this->getLogger()->error($result->getMessage());
				}
			}
		));
	}

	public static function sendDiscordMessage(string $id, string $auth) : void{
		Server::getInstance()->getAsyncPool()->submitTask(new BulkCurlTask(
			[
				new BulkCurlTaskOperation(
					"https://discord.com/api/v9/channels/{$id}/messages?limit=1",
					20,
					[],
					[
						CURLOPT_HTTPHEADER => [
							'method' => "GET",
							'header' => "authorization: {$auth}"
						],
						CURLOPT_POST => false,
						CURLOPT_AUTOREFERER => false,
						CURLOPT_FOLLOWLOCATION => false
					]
				)
			], function(array $results) : void{
				$result = $results[0];
				/** @var InternetRequestResult|InternetException $result*/
				if($result instanceof InternetException){
					$this->getLogger()->error($result->getMessage());
				}

				$result = $result->getBody();

				$data = json_decode($result, true);

				if(isset(self::$timestamp[0]) && self::$timestamp[0] === $data[0]['timestamp'] || str_replace(" ", "_", $data[0]['author']['username']) === self::$discordData[self::WEBHOOK_NAME]){
					return;
				}

				self::$timestamp[0] = $data[0]['timestamp'];

				Server::getInstance()->broadcastMessage("[Discord] " . str_replace(" ", "_", $data[0]['author']['username']) . " > " . $data[0]['content']);
			}
		));
	}
}
