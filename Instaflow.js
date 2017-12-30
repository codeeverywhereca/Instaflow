/*
 * Instaflow.js (Dec 30 2017)
 * https://github.com/codeeverywhereca/Instaflow
 * Copyright 2017, http://codeeverywhere.ca
 * Licensed under the MIT license.
 */

(function(document, window) {
	var Instaflow = function(args) {
		
		// Get Data from PHP cache ( Instaflow.php )
		this.getData = function() {			
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				if( this.readyState == 4 && this.status == 200 ) {
					
					// Wait for <div> to exist
					var interval = setInterval(function() {						
						var selector = document.querySelector(args.target);
						if( selector != null ) {
							clearInterval(interval);
							this.draw(xhr.responseText);			
						}
					}, 750)
				}		
			}
			xhr.open("GET", "Instaflow.php?user=" + args.user, true);
			xhr.send();
		};
	
		// Draw divs on page
		this.draw = function(json) {
			var buffer = '', json = JSON.parse(json);
			for( var index = 0; index < json.media.nodes.length && index < 15; index++ ) {
				
				var
					node = json.media.nodes[index],
					d = new Date(node.date * 1000).toString(),
					date = d.substr(4,6) + ', ' + d.substr(16,5); date.substr(0,10),
					likes = node.likes.count,
					link = `https://www.instagram.com/p/${node.code}/`
				;
				
				// shorten like count
				if( likes > 1000000 )
					likes = (likes/1000000).toFixed(2) + ' M'
				else if( likes > 1000 )
					likes = (likes/1000).toFixed(2) + ' K'
				
				var template = `<a href="${link}">
					<div class="title">${likes} Likes <span class="grey">${date}</span></div>
					<div class="image" style="background-image:url(${node.thumbnail_resources[3].src})"></div>
					<div class="text">${node.caption}</div>
				</a>`;
				buffer += template;
			}
			document.querySelector(args.target).className += ' Instaflow'
		    document.querySelector(args.target).innerHTML = buffer;
		};
		this.load = function() {
			getData();
		};
		return this;
	};
	window.Instaflow = Instaflow;
})(document, window);
