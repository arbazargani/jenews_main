<div id="custom-setting-area"></div>
<div class="uk-inline" id="user-input">
    <div class="uk-background-muted" uk-grid>
        <div class="uk-width-1-2@m">
            <label for="option-type">نوع مقدار</label>
            <select class="uk-select" id="option-type">
                <option value="number">عدد</option>
                <option value="text">متن</option>
            </select>
        </div>
        <div class="uk-width-1-2@m">
            <label for="option-name">نام مقدار</label>
            <input class="uk-input" type="text" id="option-name">
        </div>
        <div class="uk-width-1-2@m">
            <label for="option-title">عنوان مقدار</label>
            <input class="uk-input" type="text" id="option-title">
        </div>
        <div class="uk-width-1-2@m">
            <label for="option-value">مقدار</label>
            <input class="uk-input" type="text" id="option-value">
        </div>
        <div>
            <a class="uk-button-text" onclick="addField();">افزودن مقدار</a>
        </div>
    </div>
</div>
<script>
    function addField() {
        var option_type  = document.getElementById('option-type').value;
        var option_name  = document.getElementById('option-name').value;
        var option_title = document.getElementById('option-title').value;
        var option_value = document.getElementById('option-value').value;

        document.getElementById('custom-setting-area').innerHTML += '<label for="' + option_name + '">' + option_title + '</label>' + '<input type="' + option_type + '" name="' + option_name + '" id="' + option_name + '" placeholder="' + option_title + '" class="uk-input form-control" value="' + option_value + '" required>'

    }
</script>
