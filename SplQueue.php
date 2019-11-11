<?php
$splq = new SplQueue();

$splq->push(1);
$splq->push(2);
$splq->push(3);
$splq->push(4);
$splq->push(5);

$splq2 = serialize($splq);
echo $splq2;
echo '<br>';
var_dump(unserialize($splq2));
// $echoArr = [];
// $num = $splq->count();
// for ($i = 0; $i < $num; $i++) {

//     echo $splq->key();
//     echo $splq->next();
//     $echoArr[$splq->dequeue()] = $splq->isEmpty();
// }

// die(var_dump($echoArr));
