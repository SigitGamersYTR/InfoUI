<?php

namespace InfoUI;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\utils\TextFormat as C;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
        $this->getLogger()->info(C::GREEN . "InfoUI by SigitGamers Aktif!");
       
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
   }
   
   public function onLoad(){
       $this->getLogger()->info(C::YELLOW . "Memuat...");
   }

   public function onDisable(){
       $this->getLogger()->info(C::RED . "InfoUI by SigitGamers Mati!");
   }

   public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
       switch($cmd->getName()) {
             case "infoui":
                 if($sender instanceof Player) {
                    $this->openInfoUI($sender);
                    return true;
                 }
       }
       return true;
   }
   
   public function openInfoUI($sender){ 
       $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
       $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
           $result = $data;
           if($result === null){
               return true;
           }             
           switch($result){
               case 0:
                   $this->getServer()->dispatchCommand($player, "rules");
               break;
               case 1:
                   $this->getServer()->dispatchCommand($player, "rank");
               break
               case 2:
                   $this->getServer()->dispatchCommand($player, "sui");
               break
               case 3:
                   $this->getServer()->dispatchCommand($player, "feature");
               break
               case 4:
                   $sender->addTitle("§l§aThank You After See!\n §eInfo in My Server..");
               break;
               
               }
           });
           $form->setTitle("§l§d•═•⊰❉⊱•═•⊰❉⊱ §bFeatu§9reUI §d⊰❉⊱•═•⊰❉⊱•═•");
           $form->addButton(" §l§eMinigames\n§dTap to See",0,"textures/ui/ps-x");
           $form->addButton(" §l§bAcid Island\n§dTap to See",0,"textures/ui/lock");
           $form->addButton(" §l§aSkyblock\n§dTap to See",0,"textures/ui/mashup_world");
           $form->addButton(" §l§6Survival\n§dTap to See",0,"textures/ui/lock");
           $form->addButton(" §l§cEXIT\n§rTap to Exit",0,"textures/ui/cancel");
           $form->sendToPlayer($sender);
           return $form;
   }
}
