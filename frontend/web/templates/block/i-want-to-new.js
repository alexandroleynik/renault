<div class="container">
    <div class="c_063-0" data-adobe-target-id="">
        <div class="grid-row">
            <div class="heading-group">
                <h2>{{i_want_to_text}}</h2>
            </div>
            <ul>
                {{#each buttons}}
                <li>
                    <a href="{{host}}{{url}}">
                        <img src="{{image}}"/>
                        <span class="label">{{{name}}}</span>
                    </a>
                </li>
                {{/each}}
            </ul>
        </div>
    </div>
</div>
