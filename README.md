# No Longer Works Automatically
**Instagram has started blocking IP address ranges, you can no longer pull data automatically. A manual update option has been added.**

Manually Update Instructions

1. Upload Instaflow_updater.php to your server
2. **Change the access password**
3. Navigate to yourserver.com/Instaflow_updater.php
4. Use the JS command to copy the JSON from Instagram, paste it in the form and save
5. Your feed should now show on your website

---

# Instaflow
Super simple way to add Instagram photos to any website

![example](instaflow.png)

# How To Install
Download the PHP, Javascript and CSS, then include it in your HTML:
```html
<link rel="stylesheet" href="Instaflow.css" />
<script type="text/javascript" src="Instaflow.js"></script>
```
The PHP script acts as a cache so your requests dont overuse Instagrams servers.

# Usage
```php
$username = "instagram";
```

```js
Instaflow({
  target  : '.instagram',   // <div> class to insert
}).load();
```

# Demo
View a live demo here: http://codeeverywhere.ca/demos/instaflow/

# Change Log
1.1.2 (May 10, 2020)
- Manual update option added

1.1.1
- Updated obj paths

1.1
- Moved username server-side
- Fixed Regex

1.0
- Initial release

# License
MIT
