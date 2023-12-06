<?php

namespace App\Enums;

enum TicketStatus: string{

    case OPEN = 'open';
    case RESLVED = 'resolved';
    case REJECTED = 'rejected';
}

?>