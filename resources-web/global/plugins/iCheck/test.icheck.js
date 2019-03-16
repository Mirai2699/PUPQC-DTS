Online JavaScript Beautifier (v1.9.0-beta5)
Beautify, unpack or deobfuscate JavaScript and HTML, make JSON/JSONP readable, etc.

All of the source code is completely free and open, available on GitHub under MIT licence, 
and we have a command-line version, python library and a node package as well.



 
 
 

HTML <style>, <script> formatting:


Additional Settings (JSON):

{}
  End script and style with newline? 
 Support e4x/jsx syntax 
 Use comma-first list style? 
 Detect packers and obfuscators? 
 Preserve inline braces/code blocks? 
 Keep array indentation? 
 Break lines on chained methods? 
 Space before conditional: "if(x)" / "if (x)" 
 Unescape printable chars encoded as \xNN or \uNNNN? 
 Use JSLint-happy formatting tweaks? 
 Indent <head> and <body> sections? 
Use a simple textarea for code input?
Beautify Code (ctrl-enter)
96
    _indeterminate = "in" + _determinate;
97
    _update = "update";
98
    _type = "type";
99
    _click = "click";
100
    _touch = "touchbegin.i touchend.i";
101
    _add = "addClass";
102
    _remove = "removeClass";
103
    _callback = "trigger";
104
    _label = "label";
105
    _cursor = "cursor";
106
    _mobile = /ipad|iphone|ipod|android|blackberry|windows phone|opera mini|silk/i.test(navigator.userAgent);
107
    f.fn[m] = function(a, b) {
108
        var d = 'input[type="checkbox"], input[type="' + r + '"]',
109
            c = f(),
110
            g = function(a) {
111
                a.each(function() {
112
                    var a = f(this);
113
                    c = a.is(d) ? c.add(a) : c.add(a.find(d))
114
                })
115
            };
116
        if (/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(a)) return a = a.toLowerCase(), g(this), c.each(function() {
117
            var c =
118
                f(this);
119
            "destroy" == a ? E(c, "ifDestroyed") : A(c, !0, a);
120
            f.isFunction(b) && b()
121
        });
122
        if ("object" != typeof a && a) return this;
123
        var e = f.extend({
124
                checkedClass: k,
125
                disabledClass: n,
126
                indeterminateClass: _indeterminate,
127
                labelHover: !0
128
            }, a),
129
            l = e.handle,
130
            v = e.hoverClass || "hover",
131
            s = e.focusClass || "focus",
132
            t = e.activeClass || "active",
133
            B = !!e.labelHover,
134
            w = e.labelHoverClass || "hover",
135
            p = ("" + e.increaseArea).replace("%", "") | 0;
136
        if ("checkbox" == l || l == r) d = 'input[type="' + l + '"]'; - 50 > p && (p = -50);
137
        g(this);
138
        return c.each(function() {
139
            var a = f(this);
140
            E(a);
141
            var c = this,
142
                b = c.id,
143
                g = -p + "%",
144
                d = 100 + 2 * p + "%",
145
                d = {
146
                    position: "absolute",
147
                    top: g,
148
                    left: g,
149
                    display: "block",
150
                    width: d,
151
                    height: d,
152
                    margin: 0,
153
                    padding: 0,
154
                    background: "#fff",
155
                    border: 0,
156
                    opacity: 0
157
                },
158
                g = _mobile ? {
159
                    position: "absolute",
160
                    visibility: "hidden"
161
                } : p ? d : {
162
                    position: "absolute",
163
                    opacity: 0
164
                },
165
                l = "checkbox" == c[_type] ? e.checkboxClass || "icheckbox" : e.radioClass || "i" + r,
166
                z = f(_label + '[for="' + b + '"]').add(a.closest(_label)),
167
                u = !!e.aria,
168
                y = m + "-" + Math.random().toString(36).substr(2, 6),
169
                h = '<div class="' + l + '" ' + (u ? 'role="' + c[_type] + '" ' : "");
170
            u && z.each(function() {
171
                h +=
172
                    'aria-labelledby="';
173
                this.id ? h += this.id : (this.id = y, h += y);
174
                h += '"'
175
            });
176
            h = a.wrap(h + "/>")[_callback]("ifCreated").parent().append(e.insert);
177
            d = f('<ins class="' + C + '"/>').css(d).appendTo(h);
178
            a.data(m, {
179
                o: e,
180
                s: a.attr("style")
181
            }).css(g);
182
            e.inheritClass && h[_add](c.className || "");
183
            e.inheritID && b && h.attr("id", m + "-" + b);
184
            "static" == h.css("position") && h.css("position", "relative");
185
            A(a, !0, _update);
186
            if (z.length) z.on(_click + ".i mouseover.i mouseout.i " + _touch, function(b) {
187
                var d = b[_type],
188
                    e = f(this);
Beautify Code (ctrl-enter)
Your Selected Options (JSON):

{
  "indent_size": "4",
  "indent_char": " ",
  "max_preserve_newlines": "5",
  "preserve_newlines": true,
  "keep_array_indentation": false,
  "break_chained_methods": false,
  "indent_scripts": "normal",
  "brace_style": "collapse",
  "space_before_conditional": true,
  "unescape_strings": false,
  "jslint_happy": false,
  "end_with_newline": false,
  "wrap_line_length": "0",
  "indent_inner_html": false,
  "comma_first": false,
  "e4x": false
}
Not pretty enough for you?  Report an issue

Browser extensions and other uses
A bookmarklet (drag it to your bookmarks) by Ichiro Hiroshi to see all scripts used on the page,
Chrome, in case the built-in CSS and javascript formatting isn't enough for you:
— Quick source viewer by Tomi Mickelsson (github, blog),
— Javascript and CSS Code beautifier by c7sky,
— jsbeautify-for-chrome by Tom Rix (github),
— Pretty Beautiful JavaScript by Will McSweeney
— Stackoverflow Code Beautify by Making Odd Edit Studios (github).
Firefox: Javascript deminifier by Ben Murphy, to be used together with the firebug (github),
Safari: Safari extension by Sandro Padin,
Opera: Readable JavaScript (github) by Dither,
Opera: Source extension by Deathamns,
Sublime Text 2/3: CodeFormatter, a python plugin by Avtandil Kikabidze, supports HTML, CSS, JS and a bunch of other languages,
Sublime Text 2/3: HTMLPrettify, a javascript plugin by Victor Porof,
Sublime Text 2: JsFormat, a javascript formatting plugin for this nice editor by Davis Clark,
vim: sourcebeautify.vim, a plugin by michalliu (requires node.js, V8, SpiderMonkey or cscript js engine),
vim: vim-jsbeautify, a plugin by Maksim Ryzhikov (node.js or V8 required),
Emacs: Web-beautify formatting package by Yasuyuki Oka,
Komodo IDE: Beautify-js addon by Bob de Haas (github),
C#: ghost6991 ported the javascript formatter to C#,
Go: ditashi has ported the javascript formatter to golang,
Beautify plugin (github) by HookyQR for the Visual Studio Code IDE,
Fiddler proxy: JavaScript Formatter addon,
gEdit tips by Fabio Nagao,
Akelpad extension by Infocatcher,
Beautifier in Emacs write-up by Seth Mason,
Cloud9, a lovely IDE running in a browser, working in the node/cloud, uses jsbeautifier (github),
Devenir Hacker App, a non-free JavaScript packer for Mac,
REST Console, a request debugging tool for Chrome, beautifies JSON responses (github),
mitmproxy, a nifty SSL-capable HTTP proxy, provides pretty javascript responses (github).
wakanda, a neat IDE for web and mobile applications has a Beautifier extension (github).
Burp Suite now has a beautfier extension, thanks to Soroush Dalili,
Netbeans jsbeautify plugin by Drew Hamlett (github).
brackets-beautify-extension for Adobe Brackets by Drew Hamlett (github),
codecaddy.net, a collection of webdev-related tools, assembled by Darik Hall,
editey.com, an interesting and free Google-Drive oriented editor uses this beautifier,
a beautifier plugin for Grunt by Vishal Kadam,
SynWrite editor has a JsFormat plugin (rar, readme),
LIVEditor, a live-editing HTML/CSS/JS IDE (commercial, Windows-only) uses the library,
Doing anything interesting? Write us to team@beautifier.io so we can add your project to the list.

Written by Einar Lielmanis, maintained and evolved by Liam Newman.

We use the wonderful CodeMirror syntax highlighting editor, written by Marijn Haverbeke.

Made with a great help of Jason Diamond, Patrick Hof, Nochum Sossonko, Andreas Schneider, 
Dave Vasilevsky, Vital Batmanov, Ron Baldwin, Gabriel Harrison, Chris J. Shull, Mathias Bynens, 
Vittorio Gambaletta, Stefano Sanfilippo and Daniel Stockman.

Run the tests