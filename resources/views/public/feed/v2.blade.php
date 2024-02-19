<?xml version="1.0" encoding="utf-8"?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" version="2.0">
<channel>
<atom:link href="{{ route('RssV2') }}" rel="self" type="application/rss+xml" />
<title><![CDATA[صنعت معدن تجارت - روزنامه صمت]]></title>
<link>{{ route('Home') }}</link>
<description><![CDATA[وب سایت رسمی روزنامه صمت (صنعت معدن تجارت) نخستین روزنامه صبح ایران با مدیرمسئولی ناصر بزرگمهر و سردبیری عاطفه خسروی]]></description>
<pubDate><?php echo gmdate(DATE_RSS, strtotime($lastModified->updated_at)); ?></pubDate>
<generator>Zend_Feed</generator>
<docs>http://blogs.law.harvard.edu/tech/rss</docs>
@foreach($articles as $article)
<item>
<title><![CDATA[{{ $article->title }}]]></title>
<link>{{ route('Article > Single', $article->slug) }}</link>
<guid isPermaLink="false">/{{ urlencode($article->slug) }}</guid>
<description><![CDATA[<div>{{ $article->meta_description }}</div>]]></description>
<pubDate><?php echo gmdate(DATE_RSS, strtotime($article->created_at)); ?></pubDate>
</item>
@endforeach

</channel>
</rss>