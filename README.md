# Instaflow
Super simple way to add Instagram photos to any website

# How To Install
Download the PHP, Javascript and CSS, then include it in your HTML:
```html
<link rel="stylesheet" href="Instaflow.css" />
<script type="text/javascript" src="Instaflow.js"></script>
```
The PHP script acts as a cache so your requests dont overuse Instagrams servers.

# Usage
```js
Instaflow({
  target  : '.instagram',   // <div> class to insert
  user    : 'instagram'     // Your instagram username
}).load();
```

# Demo
View a live demo here: ...

# Change Log
1.0
- Initial release

# License
MIT
