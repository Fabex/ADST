<?php
class ThePirateBay {

	private static function my_file_get_contents ($url) {
		exec('curl '.$url, $output);
		return join("\n", $output);
	}

	public static function getTorrent($serie, $number) {
		$serie = preg_replace('/\(\d+\)/', '', $serie);
		return self::getBetterTorrent($serie.' '.$number);
	}
	
	public static function searchTorrent($episode) {
		return self::getBetterTorrent($episode);
	}
	
	static private function getBetterTorrent($data) {
		$data = urlencode($data);
		$url = 'http://thepiratebay.is/search/'.$data.'/0/7/0';
		$html = self::my_file_get_contents($url);
		$pattern = "/href=\"(magnet\:.*)\" title/U";
		$matches = array();
		$str = preg_match($pattern, $html, $matches);
		if($str) {
			return $matches[1];
		} else {
			return '';
		}
	}
}
