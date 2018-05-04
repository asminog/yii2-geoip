<?php


namespace asminog\GeoIP;

/**
 * Class Result
 * @package asminog\GeoIP
 *
 * @property string|null city
 * @property string|null country
 * @property Location location
 */
class Result extends ResultBase {
    protected function getCity($data) {

        $lng = \Yii::$app->language;
        if (isset($data['city']['names'][$lng])) {
            return $data['city']['names'][$lng];
        }

        if (isset($data['city']['names']['en'])) {
            return $data['city']['names']['en'];
        }

        return null;
    }

    protected function getCountry($data) {
        $lng = \Yii::$app->language;

        if (isset($data['country']['names'][$lng])) {
            return $data['country']['names'][$lng];
        }

        if (isset($data['country']['names']['en'])) {
            return $data['country']['names']['en'];
        }

        return null;
    }

    protected function getLocation($data) {
        $value = new Location();

        if (isset($data['location'])) {
            $lat = $data['location']['latitude'];
            $lng = $data['location']['longitude'];
            $value = new Location($lat, $lng);
        }

        return $value;
    }

    protected function getIsoCode($data) {
        $value = null;

        if (isset($data['country']['iso_code'])) {
            $value = $data['country']['iso_code'];
        }

        return $value;
    }

    public function isDetected() {
        return ($this->location->lat !== null && $this->location->lng !== null);
    }
}
