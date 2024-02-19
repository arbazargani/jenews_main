{{--<select id="ajax_tag_handle" class="uk-select ajax_tag_handle form-control" name="postName[]" multiple></select>--}}
<select id="select-repo" class="repositories selectized" placeholder="Pick a repository..." tabindex="-1" multiple>
    <option value="" selected="selected"></option>
</select>

<script type="text/javascript" src="https://raw.githubusercontent.com/selectize/selectize.js/adc3a43bd6b509d7556197f72c8fd658a993f0cb/dist/js/standalone/selectize.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://raw.githubusercontent.com/selectize/selectize.js/adc3a43bd6b509d7556197f72c8fd658a993f0cb/dist/css/selectize.css" />
<script>
    $(function () {
        $("#ajax_tag_handle").selectize(options);
    });
</script>

<script>
    $("select-repo").selectize({
        valueField: "url",
        labelField: "name",
        searchField: "name",
        create: false,
        render: {
            option: function (item, escape) {
                return (
                    "<div>" +
                    '<span class="title">' +
                    '<span class="name"><i class="icon ' +
                    (item.fork ? "fork" : "source") +
                    '"></i>' +
                    escape(item.name) +
                    "</span>" +
                    '<span class="by">' +
                    escape(item.username) +
                    "</span>" +
                    "</span>" +
                    '<span class="description">' +
                    escape(item.description) +
                    "</span>" +
                    '<ul class="meta">' +
                    (item.language ? '<li class="language">' + escape(item.language) + "</li>" : "") +
                    '<li class="watchers"><span>' +
                    escape(item.watchers) +
                    "</span> watchers</li>" +
                    '<li class="forks"><span>' +
                    escape(item.forks) +
                    "</span> forks</li>" +
                    '<li class="stars"><span>' +
                    escape(item.followers) +
                    "</span> stars</li>" +
                    "</ul>" +
                    "</div>"
                );
            },
        },
        score: function (search) {
            var score = this.getScoreFunction(search);
            return function (item) {
                return score(item) * (1 + Math.min(item.watchers / 100, 1));
            };
        },
        load: function (query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: "https://api.github.com/legacy/repos/search/" + encodeURIComponent(query),
                type: "GET",
                error: function () {
                    callback();
                },
                success: function (res) {
                    callback(res.repositories.slice(0, 10));
                },
            });
        },
    });
</script>
