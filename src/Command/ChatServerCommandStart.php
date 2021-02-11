<?php
namespace App\Command;
 
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\ChatServer\ChatServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
 
class ChatServerCommandStart extends Command
{
    protected static $defaultName = "run:websocket-server";
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $port = 9000;
        $output->writeln("Starting server on port " . $port);
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new ChatServer()
                )
            ),
            $port
        );
        $server->run();
        return 0;
    }
}