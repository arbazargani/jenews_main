<disqus-thread>

    <div id="disqus_thread" class="uk-background-secondary uk-padding uk-border-rounded"></div>
    <script>
    var disqus_config = function () {
    this.page.url = '{{ urldecode(url()->current()) }}';  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = '{{ route('Article > Single', $article[0]->slug) }}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    this.language = "fa";
    };

    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://arbazargani.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

    <script>
        // to make it easy to comment!
        document.getElementByName("tos").checked = true;
        document.getElementByName("privacy-policy").checked = true;
        document.getElementByName("data-sharing").checked = true;
        document.getElementByName("author-guest").checked = true;
    </script>

</disqus-thread>