<?php

namespace Givecookie;

use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\utils\TextFormat;


class Main extends PluginBase implements Listener{
	public function onLoad() {
		$this->getLogger()->info(TextFormat::GRAY . "> " . TextFormat::GREEN . "Plugin being prepared...");
	        $this->getLogger()->info(TextFormat::GRAY . "> " . TextFormat::GREEN . "Plugin prepared.");

	}
	public function onEnable() {
	$this->getLogger()->info(TextFormat::GRAY . "> " . TextFormat::GREEN . "Plugin enabled.");
	$this->getLogger()->info(TextFormat::RED . "This plugin's license can be found at: https://github.com/organization/GiveCookie.");
	$this->getServer()->getPluginManager()->registerEvents($this,$this);
	}
	
	public function onDisable() {
	$this->getLogger()->info(TextFormat::GRAY . "> " . TextFormat::RED . "Plugin disabled.");
		}
	
	public function onPlayerMove(PlayerMoveEvent $event) {
		$player = $event->getPlayer();
		
		if ($player == null) return;
		if ($player->getLevel () == null) return;
		
		// under
		$x = ( int ) round ( $player->x - 0.5 );
		$y = ( int ) round ( $player->y - 1 );
		$z = ( int ) round ( $player->z - 0.5 );
		
		$id = $player->getLevel ()->getBlockIdAt ( $x, $y, $z );
		$data = $player->getLevel ()->getBlockDataAt ( $x, $y, $z );
		
		switch($id) {
			case 35:
				if($data == 1) {
					$player->getInventory()->addItem(new Item(ITEM::COOKIE, 0, 1));
					$player->sendPopup(TextFormat::GRAY . "GiveCookie:\n" . TextFormat::YELLOW . "> " . TextFormat::GREEN . "You've received a cookie!");
				}
				
				break;
			    default:
				break;
		}
	}
}
?>
