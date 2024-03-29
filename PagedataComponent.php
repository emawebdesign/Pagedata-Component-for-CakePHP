<?php

App::uses('Component', 'Controller');

class PagedataComponent extends Component {
	
	public $components = array('Session','Cookie','RequestHandler');
	
	
	
	
	public function getTitle($url = NULL) {
		
		if ($this->checkResponse($url)) {
		
			$html = file_get_contents($url);
			
			if (strlen($html)>0) {
				
				$html = trim(preg_replace('/\s+/', ' ', $html));
				preg_match("/\<title\>(.*)\<\/title\>/i",$html,$title);
				
				if (isset($title[1])) return $title[1];
				else {
					
					$tags = get_meta_tags($url);
					
					if (isset($tags['title'])) return $tags['title'];
					else return(false);
					
				}
			
			}
			else return(false);
		
		}
		else return(false);
		
	}
	
	
	
	
	public function getMeta($url = NULL, $type = NULL) {
		
		$tags = get_meta_tags($url);
		
		if (isset($tags[$type])) return($tags[$type]);
		else return(false);
		
	}
	
	
	
	
	public function getOpenGraph($url = NULL, $type = NULL) {

		if ($this->checkResponse($url)) {
			
			$data = file_get_contents($url);
			$dom = new DomDocument;
			@$dom->loadHTML($data);
			 
			$xpath = new DOMXPath($dom);
			
			$metas = $xpath->query('//*/meta[starts-with(@property, \'og:\')]');
		
			$og = array();
		
			foreach($metas as $meta) {
				
				$property = str_replace('og:', '', $meta->getAttribute('property'));
	
				$content = $meta->getAttribute('content');
				$og[$property] = $content;
				
			}
		
			if (isset($og[$type])) return $og[$type];
			else return(false);
		
		}
		else return(false);
		
	}
	
	
	
	
	public function getBody($url = NULL, $allowed_html = NULL) {
		
		$allowedHtml = '<h1><h2><h3><h4><h5><h6><p><strong><a><br>';
		if ($allowed_html!==NULL) $allowedHtml = $allowed_html;
		
		if ($this->checkResponse($url)) {
			
			$html = file_get_contents($url);
			
			if (strlen($html)>0) {
				
				$html = trim(preg_replace('/\s+/', ' ', $html));
				preg_match("/<body.*\/body>/s", $html, $matches);
				
				if (isset($matches[0])) return(strip_tags($matches[0], $allowedHtml));
				else return(false);
			
			}
			else return(false);
		
		}
		else return(false);
		
	}
	
	
	
	
	public function getAllLinks($url = NULL) {
		
		if ($this->checkResponse($url)) {
	
			$html = @file_get_contents($url);
	
			$dom = new DOMDocument;
			
			@$dom->loadHTML($html);
			
			$links = $dom->getElementsByTagName('a');
			
			$arr = array();
			
			foreach ($links as $link) {
				
				$arr[] = array(
					'href' => $link->getAttribute('href'),
					'anchor' => $link->nodeValue
				);
				
			}
			
			return($arr);
		
		}
		else return(false);
		
	}
	
	
	
	
	public function getAllImages($url = NULL) {
		
		if ($this->checkResponse($url)) {
	
			$html = @file_get_contents($url);
	
			$dom = new DOMDocument;
			
			@$dom->loadHTML($html);
			
			$images = $dom->getElementsByTagName('img');
			
			$arr = array();
			
			foreach ($images as $image) {
				
				$arr[] = array(
					'src' => $image->getAttribute('src'),
					'alt' => $image->getAttribute('alt')
				);
				
			}
			
			return($arr);
		
		}
		else return(false);
		
	}
	
	
	
	
	public function getKeywords($url = NULL) {
		
		/*
		Returns:
		echo "Key: " .$arr["key"] ."<br>";
		echo "Count: " .$arr["val"] ."<br>";
		echo "Density: " .$arr["density"] ."%<br><br>";
		*/
		
		$arr = array();
		
		if ($this->checkResponse($url)) {
		
			$txt = strip_tags(file_get_contents($url));
	
			$words = str_word_count(strtolower($txt),1);
			$wcount = array_count_values($words);
			
			foreach ($wcount as $key=>$val) {
				
				$density = ($val/count($words))*100;
				
				if (strlen($key)>3) {
					
					$arr[] = array(
						'key' => $key,
						'val' => $val,
						'density' => number_format($density,2)
					);
					
				}
				
			}
			
			usort($arr, function($a, $b) {
				return $a['val'] - $b['val'];
			});
			
			$arr = array_reverse($arr, true);
			
			return $arr;
		
		}
		else return(false);
		
	}
	
	
	
	
	public function checkResponse($url = NULL) {
		
		stream_context_set_default( [
			'ssl' => [
				'verify_peer' => false,
				'verify_peer_name' => false,
			]
		]);
		
		if (@get_headers($url)) {
			$headers = @get_headers($url);
			if (strpos($headers[0], '200 OK') !== false) return(true);
			else return(false);
		}
		else return(false);
		
	}
	
	
	
	
}
