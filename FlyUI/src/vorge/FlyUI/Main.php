<?php

namespace vorge\FlyUI;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

class main extends PluginBase implements Listener {

    public function onEnable(){

    }

    public function onCommand(CommandSender $sender, Command $cmd, String $label, Arry $args) : bool {

        switch($cmd->getName()){
            case "fly"
            if($sender instanceof Player){
                if($sender->hasPermission("flyui.use")){
                    $this->openMyForm($sender);
                } else {
                    $sender->sendMessage("Hey you must purchase a rank from our store!");
                }
            }
        }
    return true;
    }

    public function openMyForm($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $player->setAllowFlight(true);
                    $player->sendMessage("§aFlight has been enabled!");
                break; 

                case 1:
                    $player->setAllowFlight(false);
                    $player->sendMessage("§cFlight has been disabled");
                break;
            }
        });
        $form->setTitle("§dFlyUI by VorgeRyan");
        $form->setContent("Enable flight or disable flight");
        $form->addButton("§aEnable");
        $form->addButton("§cDisable");
        $form->sendToPlayer($player);
        return $form;
    }
}