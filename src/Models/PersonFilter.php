<?php
class   PersonFilter {
    public static function filter(array $people, array $filters) {
        return array_filter($people, function($person) use ($filters) {

            foreach ($filters as $key => $value) {
                if (in_array($key, ['faculty', 'chair', 'firstName', 'lastName', 'role', 'father']) && !empty($value)) {
                    $method = 'get' . ucfirst($key);
                    if (method_exists($person, $method) && stripos($person->$method(), $value) === false) {
                        return false;
                    }
                }
            }

            if (!empty($filters['dateBefore'])) {
                $dateBefore = DateTime::createFromFormat('Y-m-d', $filters['dateBefore']);
                $personDate = DateTime::createFromFormat('d M Y', $person->getTimeTenure());

                if ($personDate && $dateBefore && $personDate > $dateBefore) {
                    return false;
                }
            }

            if (!empty($filters['dateAfter'])) {
                $dateAfter = DateTime::createFromFormat('Y-m-d', $filters['dateAfter']);
                $personDate = DateTime::createFromFormat('d M Y', $person->getTimeTenure());

                if ($personDate && $dateAfter && $personDate < $dateAfter) {
                    return false;
                }
            }

            return true;
        });
    }
}
?>
