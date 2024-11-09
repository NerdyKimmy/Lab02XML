<?php
class PersonFilter {
    public static function filter(array $people, array $filters) {
        return array_filter($people, function($person) use ($filters) {
            foreach ($filters as $key => $value) {
                if (!empty($value) && stripos($person->$key, $value) === false) {
                    return false;
                }
            }
            return true;
        });
    }
}
?>
