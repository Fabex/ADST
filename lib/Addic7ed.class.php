<?php
class Addic7ed {

	private static function my_file_get_contents ($url) {
		exec('curl '.$url, $output);
		return join("\n", $output);
	}

	public static function getSrt($serie, $season, $number) {
		return self::getBetterSrt($serie, $season, $number);
	}
	
	static private function getBetterSrt($serie, $season, $episode) {
		$url = 'http://www.addic7ed.com/serie/'.urlencode($serie).'/'.urlencode($season).'/'.urlencode($episode).'/8';
		$html = self::my_file_get_contents($url);
		$pattern = "/class=\"buttonDownload\" href=\"(.*)\">/U";
		$matches = array();
		$str = preg_match($pattern, $html, $matches);
		if($str) {
			return 'http://www.addic7ed.com'.$matches[1];
		} else {
			return '';
		}
	}
}