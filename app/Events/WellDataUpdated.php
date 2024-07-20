<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WellDataUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $wellId;
    public $data;

    public function __construct($wellId, $data)
    {
        $this->wellId = $wellId;
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return new Channel('well.' . $this->wellId);
    }

    public function broadcastAs()
    {
        return 'well-data-updated';
    }
}
