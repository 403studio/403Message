<?php
use Workerman\Worker;
use PHPSocketIO\SocketIO;

require_once './vendor/autoload.php';

// listen port 2021 for socket.io client
$io = new SocketIO(2021);
$io->on('connection', function($socket)use($io){
	$socket->on('chat message', function($msg)use($io){
    	$io->emit('chat message', $msg);
  	});
});

Worker::runAll();