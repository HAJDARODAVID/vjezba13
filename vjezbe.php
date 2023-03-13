<?php

    //funkcija koja vraca array popisa polaznika iz polaznik.json datoteke
    function getAttendees(){
        $attendeesJson = file_get_contents('polaznici.json');
        $attendeesList = json_decode($attendeesJson,true);
        return $attendeesList;
    }

    //funkcija pomocu koje dodajemo novog polaznika; prosljeđujemo array koji se puni u polaznici.json
    function addAttendee($newAttendee){
        $attendeesJson = json_encode($newAttendee);
        file_put_contents('polaznici.json',$attendeesJson);
    }

    //funkcija koja kreira i vraca tablicu sa polaznicima prema podacima koje joj prosljeđujemo u varijabli $attendees
    function createTable($attendees){
        $table='
        <table border="1">
            <tr>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Godine</th>
                <th>Email</th>
                <th>Telefon</th>
            </tr>';
        foreach ($attendees as $attendee) {
            $table .= '
                <tr>
                    <td>' . $attendee['name'] . '</td>
                    <td>' . $attendee['surname'] . '</td>
                    <td>' . $attendee['age'] . '</td>
                    <td>' . $attendee['email'] . '</td>
                    <td>' . $attendee['tel'] . '</td>
                </tr>
            ';
        }
        $table .= '</table>';
        return $table;
    }

    $attendees =getAttendees();
    echo createTable($attendees);
    // dodajemo novog polaznika u array    
    $attendees[]=[
        "name"=>"David",
        "surname"=>"Hajdarovic",
        "age"=>30,
        "email"=>"hajdarovicdavid@gmail.com",
        "tel"=>"0986667775"
    ];
    echo '<br>';
    // dodajemo novog polaznika u json datoteku    
    addAttendee($attendees);
    echo createTable(getAttendees());
