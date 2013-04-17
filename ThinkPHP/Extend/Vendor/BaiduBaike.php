<?php
class BaiduBaike{
	public static function getSummary($keyWord){
		vendor('phpQuery');
		$url = 'http://baike.baidu.com/search/word?word='.urlencode($keyWord).'&pic=1&sug=1&enc=utf8';
		$header = get_headers($url);
		foreach ($header as $k=>$v)
			if (strpos( $v , 'Location:')!==false)
			$baikeUrl = 'http://baike.baidu.com'.trim(str_replace('Location:', '', $v));
		$html = file_get_contents($baikeUrl);
		phpQuery::newDocumentHTML($html);
		$title = htmlspecialchars_decode(pq('h1.title:first')->html());
		$summary = htmlspecialchars_decode(strip_tags(pq('.card-summary-content:first')->html()));
		if (!$summary) $summary = htmlspecialchars_decode(strip_tags(pq('div.para:first')->html()));
		$img = pq('img.card-image:first')->attr('src');
		if (!$img) $img = pq('img.editorImg:first')->attr('data-src');
		return $title ? array(
				'title'=>$title,
				'summary'=>$summary,
				'img'=>$img,
				'baikeUrl'=>$baikeUrl) : false;
	}
}
