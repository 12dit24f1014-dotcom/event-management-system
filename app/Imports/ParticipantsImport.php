<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel, WithHeadingRow
{
    protected $event_id;

    public function __construct($event_id)
    {
        $this->event_id = $event_id;
    }

    public function model(array $row)
    {
        return new Participant([
            'event_id' => $this->event_id,
            'participant_name' => $row['participant_name'] ?? '',
            'email' => $row['email'] ?? '',
            'phone' => $row['phone'] ?? '',
        ]);
    }
}