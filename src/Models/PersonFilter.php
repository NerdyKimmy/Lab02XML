<?php
class PersonFilter {
    public static function filter(array $people, array $filters) {
        return array_filter($people, function($person) use ($filters) {

            foreach ($filters as $key => $value) {
                if (in_array($key, ['faculty', 'chair', 'firstName', 'lastName', 'role', 'father']) && !empty($value)) {
                    if (stripos($person->$key, $value) === false) {
                        return false;
                    }
                }
            }


            if (!empty($filters['dateBefore'])) {
                $dateBefore = DateTime::createFromFormat('Y-m-d', $filters['dateBefore']);
                $personDate = DateTime::createFromFormat('d M Y', $person->timeTenure);


                if ($personDate && $dateBefore && $personDate > $dateBefore) {
                    return false;
                }
            }

            if (!empty($filters['dateAfter'])) {
                $dateAfter = DateTime::createFromFormat('Y-m-d', $filters['dateAfter']);
                $personDate = DateTime::createFromFormat('d M Y', $person->timeTenure);


                if ($personDate && $dateAfter && $personDate < $dateAfter) {
                    return false;
                }
            }

            return true;
        });
    }
}
?>
